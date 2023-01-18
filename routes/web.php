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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/suratmasuk', [App\Http\Controllers\SuratMasukController::class, 'index'])->name('suratmasuk');
Route::get('/suratmasuk/formTambah', [App\Http\Controllers\SuratMasukController::class, 'formTambah'])->name('suratmasuk.formTambah');
Route::post('/suratmasuk/tambah', [App\Http\Controllers\SuratMasukController::class, 'tambah'])->name('suratmasuk.tambah');
Route::get('/suratmasuk/hapus/{id}', [App\Http\Controllers\SuratMasukController::class, 'hapus'])->name('suratmasuk.hapus');
Route::post('/suratmasuk/update/{id}', [App\Http\Controllers\SuratMasukController::class, 'update'])->name('suratmasuk.update');
Route::get('/suratmasuk/exportexcel', [App\Http\Controllers\SuratMasukController::class, 'exportexcel'])->name('suratmasuk.exportexcel');
Route::get('/suratmasuk/exportpdf', [App\Http\Controllers\SuratMasukController::class, 'exportpdf'])->name('suratmasuk.exportpdf');
