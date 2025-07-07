<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    // Tampilkan semua pengaduan
    public function index()
    {
        $pengaduans = Pengaduan::orderBy('created_at', 'desc')->get();
        $title = 'Pengaduan';
        return view('admin.pengaduan.index', compact('pengaduans', 'title'));
    }

    // Tampilkan form update (modal di view)
    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    // Update status pengaduan
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,disetujui,ditolak',
            'foto_bukti_admin' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
    
        if ($request->hasFile('foto_bukti_admin')) {
            $file = $request->file('foto_bukti_admin');
            $filename = 'bukti_' . uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pengaduan_bukti_admin', $filename, 'public');
            $pengaduan->foto_bukti_admin = 'pengaduan_bukti_admin/' . $filename;
        }
    
        $pengaduan->save();
    
        return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui!');
    }

}
