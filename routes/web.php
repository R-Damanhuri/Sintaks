<?php

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
//127.0.0.1:8000/ diarahkan membuka file view login

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//Admin
Route::middleware(['auth', 'ceklevel:1'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/jenissurat', [App\Http\Controllers\JenisSuratController::class, 'index'])->name('jenissurat');
    Route::get('/jenissurat/formTambah', [App\Http\Controllers\JenisSuratController::class, 'formTambah'])->name('jenissurat.formTambah');
    Route::post('/jenissurat/tambah', [App\Http\Controllers\JenisSuratController::class, 'tambah'])->name('jenissurat.tambah');
    Route::get('/jenissurat/hapus/{id}', [App\Http\Controllers\JenisSuratController::class, 'hapus'])->name('jenissurat.hapus');
    Route::post('/jenissurat/update/{id}', [App\Http\Controllers\JenisSuratController::class, 'update'])->name('jenissurat.update');

    Route::get('/pengguna', [App\Http\Controllers\PenggunaController::class, 'index'])->name('pengguna');
    Route::get('/pengguna/formTambah', [App\Http\Controllers\PenggunaController::class, 'formTambah'])->name('pengguna.formTambah');
    Route::post('/pengguna/tambah', [App\Http\Controllers\PenggunaController::class, 'tambah'])->name('pengguna.tambah');
    Route::get('/pengguna/hapus/{id}', [App\Http\Controllers\PenggunaController::class, 'hapus'])->name('pengguna.hapus');
    Route::post('/pengguna/update/{id}', [App\Http\Controllers\PenggunaController::class, 'update'])->name('pengguna.update');

    Route::get('/pengolah', [App\Http\Controllers\PengolahController::class, 'index'])->name('pengolah');
    Route::get('/pengolah/formTambah', [App\Http\Controllers\PengolahController::class, 'formTambah'])->name('pengolah.formTambah');
    Route::post('/pengolah/tambah', [App\Http\Controllers\PengolahController::class, 'tambah'])->name('pengolah.tambah');
    Route::get('/pengolah/hapus/{id}', [App\Http\Controllers\PengolahController::class, 'hapus'])->name('pengolah.hapus');
    Route::post('/pengolah/update/{id}', [App\Http\Controllers\PengolahController::class, 'update'])->name('pengolah.update');
});

//Admin dan Pengarsip
Route::middleware(['auth', 'ceklevel:1,2'])->group(function () {
    Route::get('/suratmasuk', [App\Http\Controllers\SuratMasukController::class, 'index'])->name('suratmasuk');
    Route::get('/suratmasuk/formTambah', [App\Http\Controllers\SuratMasukController::class, 'formTambah'])->name('suratmasuk.formTambah');
    Route::post('/suratmasuk/tambah', [App\Http\Controllers\SuratMasukController::class, 'tambah'])->name('suratmasuk.tambah');
    Route::get('/suratmasuk/hapus/{id}', [App\Http\Controllers\SuratMasukController::class, 'hapus'])->name('suratmasuk.hapus');
    Route::post('/suratmasuk/update/{id}', [App\Http\Controllers\SuratMasukController::class, 'update'])->name('suratmasuk.update');
    Route::get('/suratmasuk/exportexcel', [App\Http\Controllers\SuratMasukController::class, 'exportexcel'])->name('suratmasuk.exportexcel');
    Route::get('/suratmasuk/exportpdf', [App\Http\Controllers\SuratMasukController::class, 'exportpdf'])->name('suratmasuk.exportpdf');

    Route::get('/suratkeluar', [App\Http\Controllers\SuratKeluarController::class, 'index'])->name('suratkeluar');
    Route::get('/suratkeluar/formTambah', [App\Http\Controllers\SuratKeluarController::class, 'formTambah'])->name('suratkeluar.formTambah');
    Route::post('/suratkeluar/tambah', [App\Http\Controllers\SuratKeluarController::class, 'tambah'])->name('suratkeluar.tambah');
    Route::get('/suratkeluar/hapus/{id}', [App\Http\Controllers\SuratKeluarController::class, 'hapus'])->name('suratkeluar.hapus');
    Route::post('/suratkeluar/update/{id}', [App\Http\Controllers\SuratKeluarController::class, 'update'])->name('suratkeluar.update');
    Route::get('/suratkeluar/exportexcel', [App\Http\Controllers\SuratKeluarController::class, 'exportexcel'])->name('suratkeluar.exportexcel');
    Route::get('/suratkeluar/exportpdf', [App\Http\Controllers\SuratKeluarController::class, 'exportpdf'])->name('suratkeluar.exportpdf');

    Route::get('/disposisi', [App\Http\Controllers\DisposisiController::class, 'index'])->name('disposisi');
    Route::get('/disposisi/getPengolah/{id}', [App\Http\Controllers\DisposisiController::class, 'getPengolah'])->name('disposisi.getPengolah');
    Route::get('/disposisi/formTambah', [App\Http\Controllers\DisposisiController::class, 'formTambah'])->name('disposisi.formTambah');
    Route::get('/disposisi/menuTambah/{id}', [App\Http\Controllers\DisposisiController::class, 'menuTambah'])->name('disposisi.menuTambah');
    Route::post('/disposisi/tambah', [App\Http\Controllers\DisposisiController::class, 'tambah'])->name('disposisi.tambah');
    Route::get('/disposisi/hapus/{id}', [App\Http\Controllers\DisposisiController::class, 'hapus'])->name('disposisi.hapus');
    Route::post('/disposisi/update/{id}', [App\Http\Controllers\DisposisiController::class, 'update'])->name('disposisi.update');
    Route::get('/disposisi/exportpdf/{id}', [App\Http\Controllers\DisposisiController::class, 'exportpdf'])->name('disposisi.exportpdf');

    Route::get('/pengaturan/{id}', [App\Http\Controllers\PengaturanController::class, 'index'])->name('pengaturan');
    Route::post('/pengaturan/update/{id}', [App\Http\Controllers\PengaturanController::class, 'update'])->name('pengaturan.update');
    Route::post('/pengaturan/password/{id}', [App\Http\Controllers\PengaturanController::class, 'password'])->name('pengaturan.password');
});
