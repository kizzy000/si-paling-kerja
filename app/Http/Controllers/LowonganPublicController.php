<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;

class LowonganPublicController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::orderBy('id')->paginate(6);
        return view('lowongan.index', [
            'lowongans' => $lowongans
        ]);
    }

    public function show($slug)
    {
        $lowongan = Lowongan::where('slug', $slug)->firstOrFail();
        return view('lowongan.show', [
            'lowongan' => $lowongan
        ]);
    }
}
