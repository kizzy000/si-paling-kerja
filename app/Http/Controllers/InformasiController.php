<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InformasiController extends Controller
{
    public function index()
    {
        $informasis = Informasi::all();
        return view('dashboard.informasi.index', [
            'informasis' => $informasis
        ]);
    }

    public function create()
    {
        return view('dashboard.informasi.create');
    }

    public function show($slug)
    {

        // $informasi = Informasi::with('user')->findOrFail($id);
        $informasi = Informasi::where('slug', $slug)->firstOrFail();
        return view('dashboard.informasi.show', [
            'informasi' => $informasi
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ],
        [
            'judul.required' => 'Judul wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'file.file' => 'File harus berupa dokumen atau gambar.',
        ]);

        $data = $request->only(['judul', 'deskripsi']);
        $data['user_id'] = Auth::id();
        $data['slug'] = \Str::slug($request->judul);
        $data['excerpt'] = \Str::limit(strip_tags($request->deskripsi), 100);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('informasi', 'public');
        }

        Informasi::create($data);
        return redirect()->route('dashboard.informasi.index')->with('success', 'Informasi berhasil ditambahkan');
    }

    public function edit($slug)
    {
        // $informasi = Informasi::findOrFail($id);
        $informasi = Informasi::where('slug', $slug)->firstOrFail();
        return view('dashboard.informasi.edit', [
            'informasi' => $informasi
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ],
        [
            'judul.required' => 'Judul wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'file.file' => 'File harus berupa dokumen atau gambar.',
        ]);

        $informasi = Informasi::findOrFail($id);
        $data = $request->only(['judul', 'deskripsi']);
        $data['slug'] = \Str::slug($request->judul);
        $data['excerpt'] = \Str::limit(strip_tags($request->deskripsi), 100);

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($informasi->file && file_exists(storage_path('app/public/' . $informasi->file))) {
                unlink(storage_path('app/public/' . $informasi->file));
            }
            $data['file'] = $request->file('file')->store('informasi', 'public');
        }

        $informasi->update($data);
        return redirect()->route('dashboard.informasi.index')->with('success', 'Informasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);
        $informasi->delete();
        return redirect()->route('dashboard.informasi.index')->with('success', 'Informasi berhasil dihapus');
    }
}
