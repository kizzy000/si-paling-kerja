<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Lamaran;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];

        if (auth()->user()->isPerusahaan()) {
            $data['totalLowongan'] = Lowongan::where('user_id', auth()->id())->count();
            $data['totalLamaran'] = Lamaran::whereHas('lowongan', function($q) {
                $q->where('user_id', auth()->id());
            })->count();
            $data['pendingLamaran'] = Lamaran::whereHas('lowongan', function($q) {
                $q->where('user_id', auth()->id());
            })->where('status', 'pending')->count();
        }

        return view('dashboard.index', $data);
    }
}
