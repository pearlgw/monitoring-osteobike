<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailTerapiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PengingatTerapiController;
use App\Http\Controllers\ProfileController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

// Route::get('/dashboard', function () {
//     return view('pages.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/data-pasien', [PasienController::class, 'index'])->name('data-pasien');
    Route::resource('pasien', PasienController::class);
    Route::resource('terapi', DetailTerapiController::class);
    Route::resource('pengingat-terapi', PengingatTerapiController::class);
    Route::get('/laporan-admin', [LaporanController::class, 'index'])->name('laporan-admin');
    Route::post('/laporan-admin/filter', [LaporanController::class, 'filter'])->name('laporan-admin.filter');
    Route::post('/laporan-admin/download', [LaporanController::class, 'download'])->name('laporan-admin.download');
});

Route::get('/laporan', [LaporanController::class, 'laporan_guest'])->name('laporan');
Route::post('/laporan/filter', [LaporanController::class, 'filter_guest'])->name('laporan.filter');
Route::post('/laporan/download', [LaporanController::class, 'download'])->name('laporan.download');

// Route::get('/test-email', function () {
//     Mail::to('gayuhnata02@gmail.com')->send(new TestMail());

//     return 'Email terkirim';
// });
require __DIR__ . '/auth.php';
