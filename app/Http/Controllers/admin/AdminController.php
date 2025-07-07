<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DataKematian;
use App\Models\MutasiKeluar;
use App\Models\MutasiMAsuk;
use App\Models\Penduduk;
use App\Models\ProfilDesa;
use App\Models\SuratKeterangan;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('adminDashboard.index', [
            'title' => 'Dashboard',
            'jumlahMasyarakat' => Penduduk::where('sts_penduduk', 'Tinggal')->count(),
            'jumlahS' => SuratKeterangan::all()->count(),
            'jumlahPengaduan' => Pengaduan::all()->count(),
        ]);
    }
}
