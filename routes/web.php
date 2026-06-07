<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResiController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratPaketController;
use App\Http\Controllers\laporansurpaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
// TAMBAHKAN BARIS INI: Import Controller Kelola Akun Security
use App\Http\Controllers\Admin\SecurityUserController;

Route::get('/', function () {
    return view('welcome');
});

// =========================================================================
// 1. RUTE OPERASIONAL (Bisa diakses bersama oleh Admin & Security setelah Login)
// =========================================================================
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::Resource('profile', ProfileController::class);
    Route::Resource('pemilik', PemilikController::class);
    Route::Resource('kurir', KurirController::class);
    Route::Resource('ruang', RuangController::class);
    Route::Resource('suratPaket', SuratPaketController::class);

    Route::get('suratPaket/{suratPaket}/history', [SuratPaketController::class, 'history'])->name('suratPaket.history');
    Route::Resource('laporansurpa', laporansurpaController::class);
    Route::get('/notification/send/{id}', [NotificationController::class, 'sendNotification'])->name('notification.send');
    Route::get('/notification/sendEmail/{id}', [NotificationController::class, 'sendEmailNotification'])->name('notification.sendEmail');

    // Rute Lupa Password bawaan yang ada di dalam middleware auth Anda
    Route::get('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'reset'])->name('password.store');
});

// =========================================================================
// 2. RUTE KHUSUS ADMIN (Hanya bisa dibuka jika login sebagai role admin)
// =========================================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/security', [SecurityUserController::class, 'index'])->name('security.index');
    Route::get('/security/create', [SecurityUserController::class, 'create'])->name('security.create');
    Route::post('/security', [SecurityUserController::class, 'store'])->name('security.store');
    Route::delete('/security/{id}', [SecurityUserController::class, 'destroy'])->name('security.destroy');
});

// =========================================================================
// 3. RUTE PUBLIK & VERIFIKASI (Bawaan Sistem)
// =========================================================================
// Rute Verifikasi Email
Route::get('/email/verify', EmailVerificationPromptController::class)->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (Request $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Fitur CekResi Publik
Route::get('/cekresi', [ResiController::class, 'searchResi'])->name('search.resi');

require __DIR__.'/auth.php';
