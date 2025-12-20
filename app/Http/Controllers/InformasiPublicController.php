<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class InformasiPublicController extends Controller
{
    public function index()
    {
        $informasis = Informasi::paginate(6);
        return view('informasi.index', [
            'informasis' => $informasis
        ]);
    }

    public function show($slug)
    {
        $informasi = Informasi::where('slug', $slug)->firstOrFail();
        return view('informasi.show', [
            'informasi' => $informasi
        ]);
    }
}
