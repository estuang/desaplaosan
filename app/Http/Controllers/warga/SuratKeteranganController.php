<?php

namespace App\Http\Controllers\warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratKeterangan;

class SuratKeteranganController extends Controller
{
    public function index()
    {
        $surat = SuratKeterangan::where('user_id', Auth::user()->id)->latest()->get();
        return view('wargaDashboard.surat-keterangan.index', [
            'surat' => $surat,
            'title' => 'Daftar Pengajuan Surat Keterangan'
        ]);
    }

    public function create()
    {
        return view('wargaDashboard.surat-keterangan.create', [
            'title' => 'Ajukan Surat Keterangan'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'keterangan' => 'nullable|string|max:255',
            'no_hp' => [
                'required',
                'string',
                'min:10',
                'max:15',
                'regex:/^[0-9+\- ]+$/'
            ],
        ]);

        SuratKeterangan::create([
            'user_id'    => Auth::id(),
            'kategori'   => $request->kategori,
            'keterangan_warga' => $request->keterangan,
            'no_hp'      => $request->no_hp,
            // file_upload dan status_verifikasi otomatis (default)
        ]);

        return redirect()->route('warga.surat-keterangan.index')
            ->with('success', 'Pengajuan surat keterangan berhasil dikirim.');
    }

    public function edit($id)
    {
        $surat = SuratKeterangan::where('user_id', Auth::id())->findOrFail($id);
        return view('wargaDashboard.surat-keterangan.edit', [
            'surat' => $surat,
            'title' => 'Edit Pengajuan Surat Keterangan'
        ]);
    }

    public function update(Request $request, $id)
    {
        $surat = SuratKeterangan::where('user_id', Auth::id())->findOrFail($id);

        // Hanya boleh update jika status masih pending
        if ($surat->status_verifikasi !== 'pending') {
            return redirect()->route('warga.surat-keterangan.index')
                ->with('fail', 'Pengajuan yang sudah diverifikasi tidak dapat diubah.');
        }

        $request->validate([
            'kategori' => 'required',
            'keterangan' => 'nullable|string|max:255',
            'no_hp' => [
                'required',
                'string',
                'min:10',
                'max:15',
                'regex:/^[0-9+\- ]+$/'
            ],
        ]);

        $surat->update([
            'kategori' => $request->kategori,
            'keterangan_warga' => $request->keterangan,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('warga.surat-keterangan.index')
            ->with('success', 'Pengajuan surat keterangan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $surat = SuratKeterangan::where('user_id', Auth::id())->findOrFail($id);

        // Hanya boleh hapus jika status masih pending
        if ($surat->status_verifikasi !== 'pending') {
            return redirect()->route('warga.surat-keterangan.index')
                ->with('fail', 'Pengajuan yang sudah diverifikasi tidak dapat dihapus.');
        }

        $surat->delete();

        return redirect()->route('warga.surat-keterangan.index')
            ->with('success', 'Pengajuan surat keterangan berhasil dihapus.');
    }
}
