<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Lamaran;
use Illuminate\Support\Facades\Auth;

class LowonganTersediaController extends Controller
{
    public function index()
    {
        $lowongan = Lowongan::where('batas_waktu', '>=', now())->get();
        return view('dashboard.lowongan-tersedia.index', compact('lowongan'));
    }

    public function daftar($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        return view('dashboard.lowongan-tersedia.daftar', compact('lowongan'));
    }

    public function store(Request $request, $id)
    {
        // $lowongan = Lowongan::findOrFail($id);
        $existing = Lamaran::where('user_id', Auth::id())->where('lowongan_id', $id)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah melamar lowongan ini');
        }

        // Lamaran::create([
        //     'user_id' => Auth::id(),
        //     'lowongan_id' => $id,
        //     'status' => 'pendaftar',
        // ]);
        $validated = $request->validate([
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required',
            'jurusan'        => 'required',
            'asal_sekolah'   => 'required',
            'kuliah'         => 'required',
            'jenis_kelamin'  => 'required|in:laki-laki,perempuan',
            'no_telepon'     => 'required|numeric',
            'lowongan_id'    => 'required'
        ],
        [
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'alamat.required'        => 'Alamat wajib diisi.',
            'jurusan.required'       => 'Jurusan wajib diisi.',
            'asal_sekolah.required'  => 'Asal sekolah wajib diisi.',
            'kuliah.required'        => 'Perguruan tinggi wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'no_telepon.required'    => 'Nomor telepon wajib diisi.',
            'no_telepon.numeric'     => 'Nomor telepon harus berupa angka.',
        ]);

        $validated['user_id'] = auth()->user()->id;

        $kodePendaftaran = strtoupper(substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5));
        $validated['kode_pendaftaran'] = $kodePendaftaran;

        Lamaran::create($validated);
        return redirect()->route('dashboard.lowongan-tersedia.index')->with('success', 'Lamaran berhasil dikirim');
    }
}
