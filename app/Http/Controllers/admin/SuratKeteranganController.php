<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SuratKeterangan;
use App\Services\FonnteService;
use Illuminate\Http\Request;

class SuratKeteranganController extends Controller
{
    protected $fonnte;

    public function __construct(FonnteService $fonnte)
    {
        $this->fonnte = $fonnte;
    }

    public function index()
    {
        // Ambil semua surat beserta relasi user dan penduduk
        $surat = SuratKeterangan::with(['user.penduduk'])->latest()->get();

        return view('adminDashboard.surat-keterangan.index', [
            'title' => 'Daftar Pengajuan Surat Keterangan',
            'surat' => $surat
        ]);
    }

    public function validasiForm($id)
    {
        $surat = SuratKeterangan::findOrFail($id);
        return view('adminDashboard.surat-keterangan.validasi', [
            'surat' => $surat,
            'title' => 'Validasi Surat Keterangan'
        ]);
    }

   public function validasi(Request $request, $id)
    {
        $surat = SuratKeterangan::findOrFail($id);

        $request->validate([
            'status_verifikasi' => 'required|in:diterima,ditolak',
            'file_upload' => 'required_if:status_verifikasi,diterima|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $surat->status_verifikasi = $request->status_verifikasi;
        $surat->keterangan = $request->keterangan;

        if ($request->status_verifikasi == 'diterima' && $request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('surat_keterangan', $filename, 'public');
            $surat->file_upload = $filename;
        } elseif ($request->status_verifikasi == 'ditolak') {
            $surat->file_upload = null;
        }

        $surat->save();

        // Kirim notifikasi WA ke pemohon
        $no_hp = $surat->no_hp;
        if ($no_hp) {
            // Pastikan format nomor WA benar (misal: 628xxxx)
            $wa_number = preg_replace('/^0/', '62', $no_hp);

            $message = "Halo, pengajuan Surat Keterangan Anda dengan kategori *{$surat->kategori}* telah " .
                ($surat->status_verifikasi == 'diterima' ? "DITERIMA" : "DITOLAK") .
                ".\n\nKeterangan: {$surat->keterangan}\n\nTerima kasih.";

            $this->fonnte->sendMessage($wa_number, $message);
        }

        return redirect()->route('admin.surat-keterangan.index')->with('success', 'Validasi surat keterangan berhasil disimpan.');
    }
}
