<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load(['lamarans.lowongan', 'informasis', 'lowongans']);
        return view('dashboard.profil.index', [
            'user' => $user
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profil.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'name.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan.',
            'password.min'   => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'foto.image'     => 'File harus berupa gambar.',
        ]);

        $data = $request->only(['name', 'email']);
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if (Auth::user()->foto && file_exists(storage_path('app/public/' . Auth::user()->foto))) {
                unlink(storage_path('app/public/' . Auth::user()->foto));
            }
            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('profil', 'public');
        }

        Auth::user()->update($data);
        return redirect()->route('dashboard.profil.index')->with('success', 'Profil berhasil diperbarui');
    }
}
