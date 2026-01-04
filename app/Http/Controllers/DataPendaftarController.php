<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;

class DataPendaftarController extends Controller
{
    public function index()
    {
        return view('dashboard.pendaftar.index', [
            'users'     => Auth::user(),
            'lowongans' => Lowongan::paginate(5)
        ]);
    }

    // Untuk menampilkan Data Pelamar
    public function pendaftar(Lowongan $lowongan)
    {
        return view('dashboard.pendaftar.list', [
            'users'     => Auth::user(),
            'lowongan'  => $lowongan,
            'lamarans'  => $lowongan->lamarans()->paginate(5)
        ]);
    }
}
