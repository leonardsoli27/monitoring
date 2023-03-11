<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokelHewanController;
use App\Http\Controllers\DokelTumbuhanController;
use App\Http\Controllers\DomasHewanController;
use App\Http\Controllers\DomasTumbuhanController;
use App\Http\Controllers\EksporHewanController;
use App\Http\Controllers\EksporTumbuhanController;
use App\Http\Controllers\ImporHewanController;
use App\Http\Controllers\ImporTumbuhanController;
use App\Http\Controllers\LaluLintasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RincianController;
use App\Http\Controllers\UsersController;
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

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/user', [UsersController::class, 'index']);
    Route::get('/user/register', function () {
        return view('Users.tbhUser');
    });

    Route::get('/user/profil/{id}', [UsersController::class, 'show']);
    Route::put('/user/profil/{id}', [UsersController::class, 'password']);
    Route::post('/user/register', [UsersController::class, 'store']);
    Route::get('/user/edit/{id}', [UsersController::class, 'edit']);
    Route::put('/user/edit/{id}', [UsersController::class, 'update']);
    Route::delete('/user/hapus/{id}', [UsersController::class, 'destroy']);

    // Tambah Data
    Route::get('/lalulintas', [LaluLintasController::class, 'index']);
    Route::post('/lalulintas/hewan', [LaluLintasController::class, 'store']);
    Route::post('/lalulintas/tumbuhan', [LaluLintasController::class, 'store_t']);

    // DOMAS
    Route::get('/domasHewan', [DomasHewanController::class, 'index']);
    Route::get('/domasHewan/edit/{id}', [DomasHewanController::class, 'edit']);
    Route::put('/domasHewan/edit', [DomasHewanController::class, 'update']);
    Route::post('/domasHewan/hapus', [DomasHewanController::class, 'delete']);
    Route::get('/domasTumbuhan', [DomasTumbuhanController::class, 'index']);
    Route::get('/domasTumbuhan/edit/{id}', [DomasTumbuhanController::class, 'edit']);
    Route::put('/domasTumbuhan/edit', [DomasTumbuhanController::class, 'update']);
    Route::post('/domasTumbuhan/hapus', [DomasTumbuhanController::class, 'delete']);

    // DOKEL
    Route::get('/dokelHewan', [DokelHewanController::class, 'index']);
    Route::get('/dokelHewan/edit/{id}', [DokelHewanController::class, 'edit']);
    Route::put('/dokelHewan/edit', [DokelHewanController::class, 'update']);
    Route::post('/dokelHewan/hapus', [DokelHewanController::class, 'delete']);
    Route::get('/dokelTumbuhan', [DokelTumbuhanController::class, 'index']);
    Route::get('/dokelTumbuhan/edit/{id}', [DokelTumbuhanController::class, 'edit']);
    Route::put('/dokelTumbuhan/edit', [DokelTumbuhanController::class, 'update']);
    Route::post('/dokelTumbuhan/hapus', [DokelTumbuhanController::class, 'delete']);

    // EKSPOR
    Route::get('/eksporHewan', [EksporHewanController::class, 'index']);
    Route::get('/eksporHewan/edit/{id}', [EksporHewanController::class, 'edit']);
    Route::put('/eksporHewan/edit', [EksporHewanController::class, 'update']);
    Route::post('/eksporHewan/hapus', [EksporHewanController::class, 'delete']);
    Route::get('/eksporTumbuhan', [EksporTumbuhanController::class, 'index']);
    Route::get('/eksporTumbuhan/edit/{id}', [EksporTumbuhanController::class, 'edit']);
    Route::put('/eksporTumbuhan/edit', [EksporTumbuhanController::class, 'update']);
    Route::post('/eksporTumbuhan/hapus', [EksporTumbuhanController::class, 'delete']);

    // IMPOR
    Route::get('/imporHewan', [ImporHewanController::class, 'index']);
    Route::get('/imporHewan/edit/{id}', [ImporHewanController::class, 'edit']);
    Route::put('/imporHewan/edit', [ImporHewanController::class, 'update']);
    Route::post('/imporHewan/hapus', [ImporHewanController::class, 'delete']);
    Route::get('/imporTumbuhan', [ImporTumbuhanController::class, 'index']);
    Route::get('/imporTumbuhan/edit/{id}', [ImporTumbuhanController::class, 'edit']);
    Route::put('/imporTumbuhan/edit', [ImporTumbuhanController::class, 'update']);
    Route::post('/imporTumbuhan/hapus', [ImporTumbuhanController::class, 'delete']);

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::post('/laporan', [LaporanController::class, 'store']);

    // Rincian
    Route::get('/rHewan', [RincianController::class, 'index']);
    Route::get('/rTumbuhan', [RincianController::class, 'index_t']);
    Route::get('/jalur', [RincianController::class, 'jalur']);
});
