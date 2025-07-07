<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Svg\Tag\Rect;

class RegisterController extends Controller
{
    public function index()
    {
        return view('adminDashboard.register', [
            'title' => 'Register',
            'active' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'nik' => ['required', 'string', 'max:18'],
            'name' => ['required', 'string', 'max:255'],
            'userName' => ['required', 'string', 'max:30', 'unique:users,userName'],
            'alamat' => ['required', 'string', 'max:255'],
            'syarat' => ['required'],
            'password' => ['required', 'string', 'min:8'],
            // Data lengkap penduduk
            'no_kk' => ['required', 'string', 'max:20'],
            'rt' => ['required', 'numeric'],
            'rw' => ['required', 'numeric'],
            'jk' => ['required', 'in:Laki-Laki,Perempuan'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tgl_lahir' => ['required', 'date'],
            'wn' => ['required', 'in:WNI,WNA'],
            'kebangsaan' => ['required', 'string', 'max:50'],
            'agama' => ['required', 'in:Islam,Kristen,Katolik,Budha,Konghucu,Hindu'],
            'pekerjaan' => ['required', 'string', 'max:100'],
            'pendidikan' => ['required', 'string', 'max:100'],
            'sts_kawin' => ['required', 'in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati'],
            'sts_penduduk' => ['required', 'in:Warga Baru Menunggu Verifikasi,Meninggal,Tinggal,Pindah Keluar,Warga Pindah Menunggu Verifikasi,Warga Meninggal Menunggu Verifikasi'],
            'sts_dalam_kk' => ['required', 'in:Anak,Kepala_Keluarga,Suami,Istri,orang_lain'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.max' => 'NIK maksimal 18 karakter.',
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'userName.required' => 'Username wajib diisi.',
            'userName.max' => 'Username maksimal 30 karakter.',
            'userName.unique' => 'Username sudah digunakan.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
            'syarat.required' => 'Anda harus menyetujui syarat dan ketentuan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'no_kk.required' => 'Nomor KK wajib diisi.',
            'rt.required' => 'RT wajib diisi.',
            'rw.required' => 'RW wajib diisi.',
            'jk.required' => 'Jenis kelamin wajib dipilih.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
            'wn.required' => 'Warga negara wajib dipilih.',
            'kebangsaan.required' => 'Kebangsaan wajib diisi.',
            'agama.required' => 'Agama wajib dipilih.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'pendidikan.required' => 'Pendidikan wajib diisi.',
            'sts_kawin.required' => 'Status kawin wajib dipilih.',
            'sts_penduduk.required' => 'Status penduduk wajib dipilih.',
            'sts_dalam_kk.required' => 'Status dalam KK wajib dipilih.',
        ]);
        if ($data->fails()) {
            return back()->withErrors($data)->withInput();
        } else {
            $Password = Hash::make($request->password);
            User::create([
                'nik' => $request->nik,
                'name' => $request->name,
                'userName' => $request->userName,
                'alamat' => $request->alamat,
                'password' => $Password,
                'role' => 'masyarakat'
            ]);
            Penduduk::create([
                'nik' => $request->nik,
                'nama' => $request->name,
                'no_kk' => $request->no_kk,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'jk' => $request->jk,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'wn' => $request->wn,
                'kebangsaan' => $request->kebangsaan,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'pendidikan' => $request->pendidikan,
                'sts_kawin' => $request->sts_kawin,
                'sts_penduduk' => $request->sts_penduduk,
                'sts_dalam_kk' => $request->sts_dalam_kk,
            ]);
            return redirect('/login')->with('success', "Akun Sukses Dibuat.");
        }
    }
}
