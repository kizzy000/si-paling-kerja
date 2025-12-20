<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class InformasiPublicController extends Controller
{
    public function index()
    {
        $informasis = Informasi::paginate(10);
        return view('informasi.index', compact('informasis'));
    }
}
