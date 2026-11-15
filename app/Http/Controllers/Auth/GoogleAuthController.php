<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(Request $request): RedirectResponse
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');

        // Check if user explicitly asked for simulation or credentials are not yet configured in .env
        if ($request->has('mock') || empty($clientId) || empty($clientSecret) || $clientId === 'your-google-client-id') {
            return $this->handleMockGoogleLogin($request);
        }

        try {
            return Socialite::driver('google')->redirect();
        } catch (\Throwable $e) {
            return redirect()->route('login')->withErrors([
                'google' => 'Gagal menghubungkan ke Google: ' . $e->getMessage() . '. Pastikan kredensial di .env sudah benar, atau gunakan Simulasi Google untuk uji coba.',
            ]);
        }
    }

    /**
     * Obtain the user information from Google and log them in.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            /** @var \Laravel\Socialite\Two\User $googleUser */
            $googleUser = Socialite::driver('google')->user();

            $email = $googleUser->getEmail();
            $name = $googleUser->getName() ?? $googleUser->getNickname() ?? 'Pengguna Google';
            $googleId = $googleUser->getId();
            $avatar = $googleUser->getAvatar();

            $user = User::where('google_id', $googleId)
                ->orWhere('email', $email)
                ->first();

            if ($user) {
                // Jangan timpa avatar custom yang sudah pernah diupload pengguna
                $updateData = [
                    'google_id' => $user->google_id ?: $googleId,
                ];
                if (empty($user->avatar)) {
                    $updateData['avatar'] = $avatar;
                }
                $user->update($updateData);
            } else {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'google_id' => $googleId,
                    'avatar' => $avatar,
                    'password' => null,
                    'email_verified_at' => now(),
                ]);
            }

            Auth::login($user, true);
            request()->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
            }
            return redirect()->route('homepage2')->with('success', 'Berhasil masuk dengan akun Google! Selamat datang, ' . $user->name . '.');
        } catch (\Throwable $e) {
            return redirect()->route('login')->withErrors([
                'google' => 'Gagal autentikasi dengan Google: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Mock/Demo Google Login for quick local testing without needing immediate Google Cloud Console API credentials.
     */
    protected function handleMockGoogleLogin(Request $request): RedirectResponse
    {
        $mockEmail = $request->input('email', 'google.user@example.com');
        $mockName = $request->input('name', 'Google Zarabel User');
        $mockGoogleId = 'mock_google_' . md5($mockEmail);

        $user = User::where('google_id', $mockGoogleId)
            ->orWhere('email', $mockEmail)
            ->first();

        if (!$user) {
            $user = User::create([
                'name' => $mockName,
                'email' => $mockEmail,
                'google_id' => $mockGoogleId,
                'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($mockName) . '&background=69481B&color=fff',
                'password' => null,
                'email_verified_at' => now(),
            ]);
        } else {
            $user->update([
                'google_id' => $user->google_id ?: $mockGoogleId,
            ]);
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
        }
        return redirect()->route('homepage2')->with('success', 'Login dengan akun Google berhasil! (Simulasi Google)');
    }
}

