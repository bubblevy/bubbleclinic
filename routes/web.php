<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\AdminDataPasienController;
use App\Http\Controllers\AdminAntrianPasienController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/admin/dashboard');
});

// login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/logout', function () {
    return redirect('/');
});

// dashboard admin
Route::get('/admin/dashboard',  [AdminDashboardController::class, 'index'])->middleware('admin');

// data pasien
Route::get('/admin/pasien', [AdminDataPasienController::class, 'index'])->middleware('admin');
Route::get('/admin/pasien/filter', [AdminDataPasienController::class, 'filter'])->middleware('admin');
Route::post('/admin/pasien/delete', [AdminDataPasienController::class, 'deletePatient'])->middleware('admin');
Route::get('/admin/pasien/delete', function () {
    return redirect('/admin/pasien');
})->middleware('admin');
Route::post('/admin/pasien/edit', [AdminDataPasienController::class, 'editPatient'])->middleware('admin');
Route::get('/admin/pasien/edit', function () {
    return redirect('/admin/pasien');
})->middleware('admin');
Route::get('/admin/pasien/search', [AdminDataPasienController::class, 'search'])->middleware('admin');

// daftar antrian
Route::get('/admin/antrian', [AdminAntrianPasienController::class, 'index'])->middleware('admin');
Route::post('/admin/antrian', [AdminAntrianPasienController::class, 'generateQueueNumber'])->middleware('admin');
Route::post('/admin/antrian/confirm', [AdminAntrianPasienController::class, 'confirmPatient'])->middleware('admin');
Route::get('/admin/antrian/confirm', function () {
    return redirect('/admin/antrian');
})->middleware('admin');
Route::post('/admin/antrian/skip', [AdminAntrianPasienController::class, 'skipPatient'])->middleware('admin');
Route::get('/admin/antrian/skip', function () {
    return redirect('/admin/antrian');
})->middleware('admin');
Route::get('/admin/antrian/search', [AdminAntrianPasienController::class, 'search'])->middleware('admin');

// pasien terlambat
Route::get('/admin/daftar-antrian-terlambat', [AdminAntrianPasienController::class, 'daftarAntrianTerlambat'])->middleware('admin');
Route::get('/admin/daftar-antrian-terlambat/search', [AdminAntrianPasienController::class, 'searchAntrianTerlambat'])->middleware('admin');
Route::post('/admin/daftar-antrian-terlambat/confirm', [AdminAntrianPasienController::class, 'confirmPasienTerlambat'])->middleware('admin');
Route::get('/admin/daftar-antrian-terlambat/confirm', function () {
    return redirect('/admin/daftar-antrian-terlambat');
})->middleware('admin');

// Setting admin
Route::get('/admin/pengaturan', [AdminSettingsController::class, 'index'])->middleware('admin');
Route::post('/admin/pengaturan', [AdminSettingsController::class, 'store'])->middleware('admin');
Route::post('/admin/pengaturan/verify', [AdminSettingsController::class, 'verify'])->middleware('admin');
Route::post('/admin/pengaturan/setemail', [AdminSettingsController::class, 'setemail'])->middleware('admin');
Route::get('/admin/pengaturan/setemail', function () {
    return back();
})->middleware('admin');
Route::get('/admin/pengaturan/verify', function () {
    return back();
})->middleware('admin');
Route::post('/admin/pengaturan/changepassword', [AdminSettingsController::class, 'changepassword'])->middleware('admin');
Route::get('/admin/pengaturan/changepassword', function () {
    return back();
})->middleware('admin');
Route::post('/admin/pengaturan/app', [AdminSettingsController::class, 'updateapp'])->middleware('admin');
Route::get('/admin/pengaturan/app', function () {
    return back();
})->middleware('admin');
