<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AccountSettingsController extends Controller
{
    public function index(Request $request): View
    {
        return view('account-settings', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'current_password' => ['nullable', 'required_with:password', 'current_password'],
            'password' => ['nullable', 'confirmed', 'min:8', Rule::when($request->filled('current_password'), ['different:current_password'])],
        ], [
            'name.required' => 'Username wajib diisi.',
            'avatar.image' => 'Foto profil harus berupa gambar.',
            'avatar.mimes' => 'Foto profil hanya mendukung JPG, JPEG, PNG, atau WEBP.',
            'avatar.max' => 'Ukuran foto profil maksimal 2MB.',
            'current_password.required_with' => 'Password lama wajib diisi untuk mengganti password.',
            'current_password.current_password' => 'Password lama tidak sesuai.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.different' => 'Password baru harus berbeda dari password lama.',
        ]);

        $user->name = $validated['name'];

        if ($request->hasFile('avatar')) {
            $oldAvatar = $user->avatar;
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = asset('storage/' . $avatarPath);

            $storageUrl = asset('storage/');
            if ($oldAvatar && str_starts_with($oldAvatar, $storageUrl)) {
                $oldPath = ltrim(str_replace($storageUrl, '', $oldAvatar), '/');
                Storage::disk('public')->delete($oldPath);
            }
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
