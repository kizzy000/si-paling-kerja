<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Informasi;
use App\Models\Lamaran;

class IndexController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::orderBy('created_at', 'desc')->take(3)->get();
        $informasis = Informasi::orderBy('created_at', 'desc')->take(3)->get();
        $total_lowongan = Lowongan::count();
        $total_lamaran = Lamaran::count();
        return view('index', [
            'lowongans' => $lowongans,
            'informasis' => $informasis,
            'total_lowongan' => $total_lowongan,
            'total_lamaran' => $total_lamaran
        ]);
        // return view('index');
    }
}
