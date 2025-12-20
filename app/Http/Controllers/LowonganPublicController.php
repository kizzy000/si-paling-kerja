<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;

class LowonganPublicController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::where('deadline', '>=', now())->paginate(10);
        return view('lowongan.index', compact('lowongans'));
    }
}
