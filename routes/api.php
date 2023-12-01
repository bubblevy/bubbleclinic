<?php

use App\Http\Controllers\Api\DokterController;
use App\Http\Controllers\Api\ClinicController;
use App\Http\Controllers\Api\PatientsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/antrian/now', [PatientsController::class, 'show']);
Route::post('/antrian/take', [PatientsController::class, 'store']);
Route::get('/antrian/total', [PatientsController::class, 'totalPatients']);
Route::get('/pasien/search', [PatientsController::class, 'search']);
Route::get('/clinic/detail', [ClinicController::class, 'detail']);
Route::get('/dokter/detail', [DokterController::class, 'detail']);
