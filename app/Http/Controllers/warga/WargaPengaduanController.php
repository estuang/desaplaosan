<?php

namespace App\Http\Controllers\warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WargaPengaduanController extends Controller
{
    // Tampilkan daftar pengaduan milik user (bisa disesuaikan dengan user login)
    public function index()
    {
        $pengaduans = Pengaduan::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $title = 'Pengaduan Desa Plaosan';
        // dd($pengaduans);
        return view('warga.pengaduan.index', compact('pengaduans', 'title'));
    }

    // Tampilkan form create (modal di view)
    public function create()
    {
        return view('warga.pengaduan.index');
    }

    // Simpan pengaduan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'judul' => 'required|max:150',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = $request->only(['nama', 'judul', 'isi']);
        $data['user_id'] = Auth::user()->id;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pengaduan_foto', $filename, 'public');
            $data['foto'] = 'pengaduan_foto/' . $filename;
        }

        $pengaduan = Pengaduan::create($data);

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim!');
    }
}
