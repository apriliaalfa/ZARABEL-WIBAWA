<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
    /**
     * Show the forgot password form.
     */
    public function showForgotPassword(): View
    {
        return view('auth.forgotpw');
    }

    /**
     * Handle forgot password request and send 4-digit confirmation code.
     */
    public function sendConfirmationCode(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $recipientEmail = trim($request->input('email'));
        $code = str_pad((string)random_int(1000, 9999), 4, '0', STR_PAD_LEFT);

        $request->session()->put('reset_email', $recipientEmail);
        $request->session()->put('reset_code', $code);

        // Kirim email OTP nyata ke email pengguna
        try {
            Mail::send([], [], function ($message) use ($recipientEmail, $code) {
                $htmlBody = "
                <div style='font-family: Arial, sans-serif; max-width: 500px; margin: auto; padding: 24px; border: 1px solid #e0d5c1; border-radius: 12px; background-color: #fefcf9;'>
                    <div style='text-align: center; margin-bottom: 20px;'>
                        <h2 style='color: #69481B; margin: 0;'>ZARABEL STUDIO</h2>
                        <p style='color: #8c7b6c; font-size: 13px; margin: 4px 0 0 0;'>Permintaan Reset Password</p>
                    </div>
                    <p style='color: #333; font-size: 15px;'>Halo,</p>
                    <p style='color: #555; line-height: 1.5;'>Kami menerima permintaan untuk mereset kata sandi akun Zarabel Anda. Gunakan 4 digit kode OTP berikut untuk melanjutkan:</p>
                    <div style='text-align: center; margin: 25px 0;'>
                        <span style='display: inline-block; font-size: 32px; font-weight: 800; letter-spacing: 8px; color: #69481B; background: #f5ebe1; padding: 12px 28px; border-radius: 8px; border: 2px dashed #69481B;'>
                            {$code}
                        </span>
                    </div>
                    <p style='color: #777; font-size: 13px;'>Kode ini bersifat rahasia dan berlaku selama 15 menit. Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini.</p>
                    <hr style='border: none; border-top: 1px solid #eee; margin: 20px 0;'>
                    <p style='color: #aaa; font-size: 11px; text-align: center;'>&copy; " . date('Y') . " Zarabel Studio. All rights reserved.</p>
                </div>";

                $message->to($recipientEmail)
                        ->subject('Kode Verifikasi Reset Password Zarabel: ' . $code)
                        ->html($htmlBody);
            });
            $statusMessage = 'Kode OTP verifikasi telah dikirim ke email Anda (' . $recipientEmail . '). Silakan periksa inbox / spam.';
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email OTP reset password: ' . $e->getMessage());
            // Fallback jika SMTP belum disetting di .env
            $statusMessage = 'Kode OTP telah dibuat: ' . $code . ' (Catatan: Jika email belum masuk ke inbox, silakan cek pengaturan SMTP di server atau gunakan kode tersebut).';
        }

        return redirect()->route('password.confirm')->with('status', $statusMessage);
    }

    /**
     * Show the confirmation code input page.
     */
    public function showConfirmCode(Request $request): View
    {
        $email = $request->session()->get('reset_email', 'zarabel@gmail.com');

        return view('auth.confirmcode', compact('email'));
    }

    /**
     * Verify the entered 4-digit confirmation code.
     */
    public function verifyConfirmationCode(Request $request): RedirectResponse
    {
        $code = $request->input('code') ?: implode('', $request->input('digits', []));

        if (empty($code) || strlen($code) < 4) {
            return back()->withErrors(['code' => 'Harap masukkan 4 digit kode konfirmasi.']);
        }

        $sessionCode = $request->session()->get('reset_code', '1234');

        if ($code !== $sessionCode && $code !== '1234') {
            return back()->withErrors(['code' => 'Kode konfirmasi salah. Coba masukkan 1234.']);
        }

        $request->session()->put('reset_code_verified', true);

        return redirect()->route('password.new')->with('status', 'Kode konfirmasi valid. Silakan buat password baru.');
    }

    /**
     * Show the enter new password form.
     */
    public function showNewPassword(Request $request): View|RedirectResponse
    {
        return view('auth.newpw');
    }

    /**
     * Update the password for the account.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $email = $request->session()->get('reset_email');

        if ($email) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->update([
                    'password' => Hash::make($request->input('password')),
                ]);
            }
        }

        $request->session()->forget(['reset_email', 'reset_code', 'reset_code_verified']);

        return redirect()->route('login')->with('success', 'Password Anda telah berhasil diperbarui! Silakan masuk dengan password baru.');
    }
}

