<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    /**
     * Redirect ke Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Cek apakah user sudah ada berdasarkan Google ID
            $user = User::where('google_id', $googleUser->id)->first();
            
            if ($user) {
                // User sudah ada, langsung login
                Auth::login($user);
                return redirect()->route('dashboard')->with('success', 'Berhasil login dengan Google!');
            }
            
            // Cek apakah email sudah terdaftar
            $existingUser = User::where('email', $googleUser->email)->first();
            
            if ($existingUser) {
                // Email sudah ada, link dengan Google account
                $existingUser->update([
                    'google_id' => $googleUser->id,
                    'provider' => 'google',
                    'avatar' => $this->saveGoogleAvatar($googleUser->avatar),
                    'email_verified_at' => now(),
                ]);
                
                Auth::login($existingUser);
                return redirect()->route('dashboard')->with('success', 'Akun berhasil dihubungkan dengan Google!');
            }
            
            // User baru, buat akun baru
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'provider' => 'google',
                'avatar' => $this->saveGoogleAvatar($googleUser->avatar),
                'password' => Hash::make(Str::random(24)), // Random password
                'role' => 'wartawan', // Default role untuk user baru
                'email_verified_at' => now(),
                'bio' => 'Bergabung melalui Google OAuth',
            ]);
            
            Auth::login($newUser);
            
            return redirect()->route('dashboard')->with('success', 
                'Selamat datang! Akun Anda berhasil dibuat dengan Google. Role default: Wartawan.');
            
        } catch (\Exception $e) {
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            
            return redirect()->route('login')->with('error', 
                'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }

    /**
     * Save Google avatar to local storage
     */
    private function saveGoogleAvatar($avatarUrl)
    {
        if (!$avatarUrl) {
            return null;
        }

        try {
            // Create avatars directory if not exists
            $avatarDir = public_path('uploads/avatars');
            if (!file_exists($avatarDir)) {
                mkdir($avatarDir, 0755, true);
            }

            // Download and save avatar
            $avatarContent = file_get_contents($avatarUrl);
            $avatarName = 'google_' . time() . '_' . Str::random(10) . '.jpg';
            $avatarPath = $avatarDir . '/' . $avatarName;
            
            file_put_contents($avatarPath, $avatarContent);
            
            return $avatarName;
        } catch (\Exception $e) {
            \Log::error('Avatar download error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Unlink Google account
     */
    public function unlinkGoogle()
    {
        $user = auth()->user();
        
        if (!$user->google_id) {
            return back()->with('error', 'Akun Anda tidak terhubung dengan Google.');
        }

        // Pastikan user punya password untuk login manual
        if (!$user->password || $user->provider === 'google') {
            return back()->with('error', 
                'Silakan set password terlebih dahulu sebelum memutus koneksi Google.');
        }

        $user->update([
            'google_id' => null,
            'provider' => null,
        ]);

        return back()->with('success', 'Koneksi Google berhasil diputus.');
    }
}
