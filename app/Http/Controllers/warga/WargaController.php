<?php

namespace App\Http\Controllers\warga;

use App\Http\Controllers\Controller;
use App\Models\DataKematian;
use App\Models\MutasiKeluar;
use App\Models\MutasiMAsuk;
use App\Models\ProfilDesa;
use App\Models\SuratKetKelahiran;
use App\Models\User;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        return view('wargaDashboard.index', [
            'title' => 'Dashboard Warga',
            'jumlahMasyarakat' => User::all()->count(),
            
        ]);
    }
}    