<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PenyakitController;
use App\Http\Controllers\Admin\GejalaController;
use App\Http\Controllers\Admin\BasisPengetahuanController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\DiagnosaAdminController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\DiagnosaController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
})->name('landing');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');

        Route::resource('penyakit', PenyakitController::class);
        Route::resource('gejala', GejalaController::class);
        Route::resource('basis', BasisPengetahuanController::class);
        Route::resource('obat', ObatController::class);

        Route::get('/diagnosa', [DiagnosaAdminController::class, 'index'])
            ->name('diagnosa.index');

        Route::get('/diagnosa/{id}', [DiagnosaAdminController::class, 'show'])
            ->name('diagnosa.show');
    });

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('user')
    ->name('user.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/dashboard', [UserDashboard::class, 'index'])
            ->name('dashboard');

        Route::get('/diagnosa', [DiagnosaController::class, 'index'])
            ->name('diagnosa.index');

        Route::post('/diagnosa/proses', [DiagnosaController::class, 'proses'])
            ->name('diagnosa.proses');

        Route::get('/diagnosa/{id}/hasil', [DiagnosaController::class, 'hasil'])
            ->name('diagnosa.hasil');

        Route::get('/diagnosa/{id}/pdf', [DiagnosaController::class, 'exportPdf'])
            ->name('diagnosa.pdf');

        Route::get('/riwayat', [DiagnosaController::class, 'riwayat'])
            ->name('riwayat');

        Route::delete('/riwayat/{id}', [DiagnosaController::class, 'hapusRiwayat'])
            ->name('riwayat.hapus');
    });

    