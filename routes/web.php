<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PenyakitController;
use App\Http\Controllers\Admin\GejalaController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\DiagnosaAdminController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\DiagnosaController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\User\RiwayatController;

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

Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

Route::get('/register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/forgot-password',        [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password',       [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password',        [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/test-email', function () {
    Mail::raw('Tes Email dari Sistem Pakar Cabai', function ($message) {
        $message->to('rendyshu123@gmail.com')->subject('Tes Email Laravel');
    });
    return 'Email berhasil dikirim';
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        Route::resource('penyakit', PenyakitController::class);
        Route::resource('gejala',   GejalaController::class);
        Route::resource('obat',     ObatController::class);

        // ── Rule / Basis Aturan ──────────────────────────────────────────
        Route::get('/rule',        [RuleController::class, 'index'])->name('rule.index');
        Route::post('/rule',       [RuleController::class, 'store'])->name('rule.store');
        Route::put('/rule/{id}',   [RuleController::class, 'update'])->name('rule.update');
        Route::delete('/rule/{kodeRule}', [RuleController::class, 'destroy'])->name('rule.destroy');

        // ── Diagnosa (monitoring admin) ──────────────────────────────────
        Route::get('/diagnosa',      [DiagnosaAdminController::class, 'index'])->name('diagnosa.index');
        Route::get('/diagnosa/{id}', [DiagnosaAdminController::class, 'show'])->name('diagnosa.show');
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

        Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');

        Route::get('/diagnosa',              [DiagnosaController::class, 'index'])->name('diagnosa.index');
        Route::post('/diagnosa/proses',      [DiagnosaController::class, 'proses'])->name('diagnosa.proses');
        Route::get('/diagnosa/{id}/hasil',   [DiagnosaController::class, 'hasil'])->name('diagnosa.hasil');
        Route::get('/diagnosa/{id}/pdf',     [DiagnosaController::class, 'exportPdf'])->name('diagnosa.pdf');

Route::get('/riwayat', [DiagnosaController::class, 'riwayat'])
    ->name('riwayat');

Route::delete('/riwayat/hapus-semua', [RiwayatController::class, 'hapusSemua'])
    ->name('riwayat.hapus.semua');

Route::delete('/riwayat/{id}', [DiagnosaController::class, 'hapusRiwayat'])
    ->name('riwayat.hapus');


        Route::get('/profil',                [ProfileController::class, 'index'])->name('profil');
        Route::post('/profil/password',      [ProfileController::class, 'updatePassword'])->name('profil.password');
    });