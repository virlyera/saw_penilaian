<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;

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


Route::get('/dashboard', function () {
    return view('/dashboard');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);

// Route Menu Data Guru
Route::controller(GuruController::class)->group(function () {
    Route::get('/guru', 'index');
    Route::get('/guru/create', 'create');
    Route::post('/guru', 'store');
    Route::match(['get', 'post'], '/guru/{id}', 'update');
    Route::get('/delete/guru/{id}', 'destroy');
});

// Route Menu Data Kriteria
Route::controller(KriteriaController::class)->group(function () {
    Route::get('/kriteria', 'index');
    Route::get('/kriteria/create', 'create');
    Route::post('/kriteria', 'store');
    Route::match(['get', 'post'], '/kriteria/{id}', 'update');
    Route::get('/delete/kriteria/{id}', 'destroy');
});

// Route Menu Penilaian
Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
