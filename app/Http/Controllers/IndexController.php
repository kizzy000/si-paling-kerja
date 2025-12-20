<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Informasi;

class IndexController extends Controller
{
    public function index()
    {
        // $lowongans = Lowongan::where('deadline', '>=', now())->orderBy('created_at', 'desc')->take(5)->get();
        // $informasis = Informasi::orderBy('created_at', 'desc')->take(3)->get();
        // return view('index', compact('lowongans', 'informasis'));
        return view('index');
    }
}
