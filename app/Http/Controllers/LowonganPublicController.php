<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;

class LowonganPublicController extends Controller
{
    public function index(Request $request)
    {
        $lowongans = Lowongan::searchJudul($request->search_judul)
            ->orderBy('id')
            ->paginate(6)
            ->appends($request->query());

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
