<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;

class DataPendaftarController extends Controller
{
    public function index(Request $request)
    {
        $lowongans = Lowongan::searchPerusahaan($request->search_perusahaan)
            ->paginate(5)
            ->appends($request->query());

        return view('dashboard.pendaftar.index', [
            'users'     => Auth::user(),
            'lowongans' => $lowongans
        ]);
    }

    // Untuk menampilkan Data Pelamar
    public function pendaftar(Request $request, Lowongan $lowongan)
    {
        $lamarans = $lowongan->lamarans()
            ->with('user')
            ->filter([
                'jenis_kelamin' => $request->jenis_kelamin,
                'search_nama' => $request->search_nama,
            ])
            ->paginate(5)
            ->appends($request->query());

        return view('dashboard.pendaftar.list', [
            'users'     => Auth::user(),
            'lowongan'  => $lowongan,
            'lamarans'  => $lamarans
        ]);
    }
}
