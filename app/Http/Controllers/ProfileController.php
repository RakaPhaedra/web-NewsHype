<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.']);
            }
            $data['password'] = Hash::make($request->password);
        }

        // Upload avatar jika ada
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama
            if ($user->avatar && file_exists(public_path('uploads/avatars/' . $user->avatar))) {
                unlink(public_path('uploads/avatars/' . $user->avatar));
            }

            $avatar = $request->file('avatar');
            $namaAvatar = time() . '_' . $avatar->getClientOriginalName();
            $avatar->move(public_path('uploads/avatars'), $namaAvatar);
            $data['avatar'] = $namaAvatar;
        }

        $user->update($data);

        return redirect()->route('profile.edit')->with('success', 'Profile berhasil diupdate!');
    }
}
