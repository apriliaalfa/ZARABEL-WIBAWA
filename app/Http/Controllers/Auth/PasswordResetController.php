<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        $code = '1234'; // Default 4-digit verification code for demo / prototype
        $request->session()->put('reset_email', $request->input('email'));
        $request->session()->put('reset_code', $code);

        return redirect()->route('password.confirm')->with('status', 'Kode konfirmasi telah dikirim ke email Anda. (Gunakan kode: 1234)');
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

