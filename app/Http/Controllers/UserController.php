<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['perusahaan', 'pendaftar'])->latest()->paginate(5);
        return view('dashboard.users.index', [
            'user' => Auth::user(),
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('dashboard.users.create', [
            'user' => Auth::user()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,perusahaan,pendaftar',
        ],
        [
            'name.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min'   => 'Password minimal 8 karakter.',
            'role.required'  => 'Role wajib diisi.',
            'role.in'        => 'Role tidak valid.',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('dashboard.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('dashboard.users.index')->with('success', 'User berhasil dihapus');
    }
}
