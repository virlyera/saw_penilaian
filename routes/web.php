<?php

use App\Models\Guru;
use App\Models\Kriteria;
use function Ramsey\Uuid\v1;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;

use App\Http\Controllers\CetakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\UserController;


Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'role:admin,kepala_sekolah']);

// route registrasi dan login
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Route Menu Data Guru
Route::controller(GuruController::class)->group(function () {
    Route::get('/guru', 'index')->middleware(['auth', 'role:admin,kepala_sekolah']);
    Route::get('/guru/create', 'create')->middleware(['auth', 'role:admin']);
    Route::post('/guru', 'store')->middleware(['auth', 'role:admin']);
    Route::match(['get', 'post'], '/guru/{id}', 'update')->middleware(['auth', 'role:admin']);
    Route::get('/delete/guru/{id}', 'destroy')->middleware(['auth', 'role:admin']);
});

// Route Menu Data Kriteria

Route::controller(KriteriaController::class)->group(function () {
    Route::get('/kriteria', 'index')->middleware(['auth', 'role:admin,kepala_sekolah']);
    Route::get('/kriteria/create', 'create')->middleware(['auth', 'role:admin']);
    Route::post('/kriteria', 'store')->middleware(['auth', 'role:admin']);
    Route::match(['get', 'post'], '/kriteria/{id}', 'update')->middleware(['auth', 'role:admin']);
    Route::get('/delete/kriteria/{id}', 'destroy')->middleware(['auth', 'role:admin']);
});

// Route Menu Penilaian
Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index')->middleware(['auth', 'role:kepala_sekolah']);
Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store')->middleware(['auth', 'role:kepala_sekolah']);
Route::get('/cetak/hasil/penilaian/{guru_id}', [CetakController::class, 'cetakHasilPenilaian'])->name('cetak.hasil.penilaian')->middleware(['auth', 'role:kepala_sekolah']);

// Route data user
Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->middleware(['auth', 'role:admin']);
    Route::get('/user/create', 'create')->middleware(['auth', 'role:admin']);
    Route::post('/user', 'store')->middleware(['auth', 'role:admin']);
    Route::match(['get', 'post'], '/user/{id}', 'update')->middleware(['auth', 'role:admin']);
    Route::get('/delete/user/{id}', 'destroy')->middleware(['auth' . 'role:admin']);
});
