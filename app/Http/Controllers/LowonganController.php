<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::with('user')->get();
        return view('dashboard.lowongan.index', compact('lowongans'));
    }

    public function create()
    {
        return view('dashboard.lowongan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'persyaratan' => 'required|string',
            'batas_waktu' => 'required|date|after:today',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['judul', 'perusahaan', 'posisi', 'persyaratan', 'batas_waktu']);
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('lowongan', 'public');
        }

        Lowongan::create($data);
        return redirect()->route('dashboard.lowongan.index')->with('success', 'Lowongan berhasil ditambahkan');
    }

    public function show($id)
    {
        $lowongan = Lowongan::with('user', 'lamarans.user')->findOrFail($id);
        return view('dashboard.lowongan.show', compact('lowongan'));
    }

    public function edit($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        return view('dashboard.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'persyaratan' => 'required|string',
            'batas_waktu' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $lowongan = Lowongan::findOrFail($id);
        $data = $request->only(['judul', 'perusahaan', 'posisi', 'persyaratan', 'batas_waktu']);
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($lowongan->gambar && file_exists(storage_path('app/public/' . $lowongan->gambar))) {
                unlink(storage_path('app/public/' . $lowongan->gambar));
            }
            $data['gambar'] = $request->file('gambar')->store('lowongan', 'public');
        }

        $lowongan->update($data);
        return redirect()->route('dashboard.lowongan.index')->with('success', 'Lowongan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        // Hapus gambar jika ada
        if ($lowongan->gambar && file_exists(storage_path('app/public/' . $lowongan->gambar))) {
            unlink(storage_path('app/public/' . $lowongan->gambar));
        }
        $lowongan->delete();
        return redirect()->route('dashboard.lowongan.index')->with('success', 'Lowongan berhasil dihapus');
    }
}
