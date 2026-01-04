<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lamaran;
use Illuminate\Support\Facades\Auth;

class LamaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin melihat semua lamaran
            $lamaran = Lamaran::latest()->paginate(10);
        } elseif ($user->role === 'perusahaan') {
            // Perusahaan melihat lamaran pada lowongan mereka
            $lamaran = Lamaran::whereHas('lowongan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->latest()->paginate(10);
        } else {
            // Pendaftar melihat lamaran sendiri
            $lamaran = Lamaran::where('user_id', $user->id)->latest()->paginate(5);
        }

        return view('dashboard.lamaran.index', [
            'user' => Auth::user(),
            'lamaran' => $lamaran
        ]);
    }

    //perusahaan route edit
    public function editPerusahaan($id)
    {
        $lamaran = Lamaran::findOrFail($id);
        return view('dashboard.lamaran.edit-perusahaan', [
            'user' => Auth::user(),
            'lamaran' => $lamaran,
            'lowongan' => $lamaran->lowongan
        ]);
    }

    //update status pelamaran oleh perusahaan
    public function updateStatuslamaran(Request $request, $id)
    {
        $validate = $request->validate(
            [
                'status' => 'required|in:pending,accepted,rejected',
            ],
            [
                'status.required' => 'Status wajib diisi.',
            ]
        );

        $lamaran = Lamaran::findOrFail($id);
        $lamaran->update($validate);
        return redirect()->route('dashboard.lamaran.index')->with('success', 'Status lamaran berhasil diperbarui');
    }


    public function edit($id)
    {
        $lamaran = Lamaran::findOrFail($id);
        return view('dashboard.lamaran.edit', [
            'user' => Auth::user(),
            'lamaran' => $lamaran,
            'lowongan' => $lamaran->lowongan
        ]);
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate(
            [
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string|max:500',
                'jurusan' => 'required|string|max:255',
                'asal_sekolah' => 'required|string|max:255',
                'kuliah' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'no_telepon' => 'required|string|max:20',
            ],
            [
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
                'alamat.required' => 'Alamat wajib diisi.',
                'jurusan.required' => 'Jurusan wajib diisi.',
                'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
                'kuliah.required' => 'Perguruan tinggi wajib diisi.',
                'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
                'no_telepon.required' => 'Nomor telepon wajib diisi.',
            ]
        );

        $lamaran = Lamaran::findOrFail($id);
        // $kodePendaftaran = $lamaran->kode_pendaftaran;
        // $lamaran->kode_pendaftaran = $kodePendaftaran;
        $lamaran->update($validate);
        return redirect()->route('dashboard.lamaran.index')->with('success', 'Lamaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $lamaran = Lamaran::findOrFail($id);
        $lamaran->delete();
        return redirect()->route('dashboard.lamaran.index')->with('success', 'Lamaran berhasil dihapus');
    }
}
