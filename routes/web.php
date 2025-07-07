<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\MasyarakatController;
use App\Http\Controllers\admin\SuratKetStatusController;
use App\Http\Controllers\admin\SuratKetBiasaController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\PengaduanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\admin\SuratKeteranganController as SuratKeteranganAdminController;
use App\Http\Controllers\warga\SuratKeteranganController as SuratKeteranganWargaController;
use App\Http\Controllers\warga\WargaController;
use App\Http\Controllers\warga\WargaMyAccountController;
use App\Http\Controllers\warga\WargaSuratKetStatusController;
use App\Http\Controllers\warga\WargaSuratKetBiasaController;
use App\Http\Controllers\warga\WargaPengaduanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome');
});

// Auth::routes();
// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');
// Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Route Akun Admin/Staff
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'index')->name('admin');
    });

    Route::controller(MasyarakatController::class)->group(function () {
        Route::get('/data-penduduk', 'index')->name('data-penduduk')->middleware('auth');
        Route::post('/data-penduduk/store', 'store')->name('data-penduduk/store')->middleware('auth');
        Route::patch('/data-penduduk/{nik}', 'update')->name('data-penduduk/update')->middleware('auth');
        Route::delete('/data-penduduk/{nik}', 'destroy')->name('data-penduduk.destroy')->middleware('auth');
        Route::post('/data-penduduk/store/excel', 'storeExcel')->name('data-penduduk/store/excel')->middleware('auth');
    });

    Route::controller(SuratKetStatusController::class)->group(
        function () {
            Route::get('/surat-keterangan-status', 'index')->name('surat-keterangan-status')->middleware('auth');
            Route::post('/surat-keterangan-status/store', 'store')->name('surat-keterangan-status/store')->middleware('auth');
            Route::post('/surat-keterangan-status/{nik}', 'update')->name('surat-keterangan-status/verif')->middleware('auth');
            Route::delete('/surat-keterangan-status/delete/{nik}', 'destroy')->name('surat-keterangan-status/delete')->middleware('auth');
            Route::get('/surat-keterangan-status/pdf/{nik}', 'pdf')->name('surat-keterangan-status/pdf')->middleware('auth');
            Route::get('/surat-keterangan-status/pdf/lurah/{nik}', 'pdflurah')->name('surat-keterangan-status/pdflurah')->middleware('auth');
            Route::post('/surat-keterangan-status/lampiran/store/{nik}', 'lampiranStore')->name('surat-keterangan-status/lampiran/store')->middleware('auth');
            Route::get('/surat-keterangan-status/lampiran/edit/{nik}', 'lampiranEdit')->name('surat-keterangan-status/lampiran/edit')->middleware('auth');
            Route::get('/surat-keterangan-status/lampiran/update/{nik}', 'lampiranUpdate')->name('surat-keterangan-status/lampiran/update')->middleware('auth');
            Route::get('/surat-keterangan-status/lampiran/destroy/{nik}', 'lampiranDestroy')->name('surat-keterangan-status/lampiran/destroy')->middleware('auth');
            Route::get('/surat-keterangan-status/lampiran/show/{nik}', 'showLampiran')->name('surat-keterangan-status/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(UserController::class)->group(function () {
        Route::get('/myAcount', 'myAcount')->name('myAcount')->middleware('auth');
        Route::post('/Admin/Update/Account/{id}', 'updateMyAcount')->name('Admin/Update/Account')->middleware('auth');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/other-account', 'index')->name('other-account')->middleware('auth');
        Route::post('/other-account/store', 'store')->name('other-account')->middleware('auth');
        Route::post('other-account/update/{id}', 'update')->name('other-account/update')->middleware('auth');
        Route::delete('/other-account/delete/{id}', 'destroy')->name('admin.other-account.delete');
    });

    // Route Surat Keterangan Admin
    Route::get('admin/surat-keterangan', [SuratKeteranganAdminController::class, 'index'])->name('admin.surat-keterangan.index');
    Route::get('admin/surat-keterangan/{id}/validasi', [SuratKeteranganAdminController::class, 'validasiForm'])->name('admin.surat-keterangan.validasiForm');
    Route::post('admin/surat-keterangan/{id}/validasi', [SuratKeteranganAdminController::class, 'validasi'])->name('admin.surat-keterangan.validasi');

    // Route Pengaduan Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/pengaduan/plaosan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::post('/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
        Route::post('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    });
});

// Route Akun Warga/Penduduk
Route::middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::controller(WargaController::class)->group(function () {

        Route::get('/index', 'index')->name('masyarakat');
    });

    // Route Surat Keterangan Warga
    Route::get('surat-keterangan/warga', [SuratKeteranganWargaController::class, 'index'])->name('warga.surat-keterangan.index');
    Route::get('surat-keterangan/create/warga', [SuratKeteranganWargaController::class, 'create'])->name('warga.surat-keterangan.create');
    Route::post('surat-keterangan/warga', [SuratKeteranganWargaController::class, 'store'])->name('warga.surat-keterangan.store');
    Route::get('surat-keterangan/{surat_keterangan}/warga', [SuratKeteranganWargaController::class, 'show'])->name('warga.surat-keterangan.show');
    Route::get('surat-keterangan/{surat_keterangan}/edit/warga', [SuratKeteranganWargaController::class, 'edit'])->name('warga.surat-keterangan.edit');
    Route::put('surat-keterangan/{surat_keterangan}/warga', [SuratKeteranganWargaController::class, 'update'])->name('warga.surat-keterangan.update');
    Route::delete('surat-keterangan/{surat_keterangan}/warga', [SuratKeteranganWargaController::class, 'destroy'])->name('warga.surat-keterangan.destroy');

    Route::controller(WargaMyAccountController::class)->group(function () {
        Route::get('Warga/myAcount', 'myAcount')->name('Warga/myAcount')->middleware('auth');
        Route::post('Update/Account/{id}', 'updateMyAcount')->name('Warga/Update/Account')->middleware('auth');
    });

    // Route Pengaduan Warga
    Route::prefix('warga')->name('warga.')->group(function () {
        Route::get('/pengaduan/desaplaosan', [WargaPengaduanController::class, 'index'])->name('pengaduan.index');
        Route::post('/pengaduan/ajukan', [WargaPengaduanController::class, 'store'])->name('pengaduan.store');
    });
});
