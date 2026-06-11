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
use App\Http\Controllers\Admin\SecurityUserController;
use App\Http\Controllers\PencarianPublikController;

// Halaman awal publik menggunakan PencarianPublikController
Route::get('/', [PencarianPublikController::class, 'index']);

Route::middleware(['auth', 'prevent-back'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('profile', ProfileController::class);
    Route::resource('pemilik', PemilikController::class);
    Route::resource('kurir', KurirController::class);
    Route::resource('ruang', RuangController::class);
    Route::resource('suratPaket', SuratPaketController::class);

    Route::get('suratPaket/{suratPaket}/history', [SuratPaketController::class, 'history'])->name('suratPaket.history');

    // Route Cetak diletakkan di atas Resource agar tidak bentrok
    Route::get('laporansurpa/cetak', [laporansurpaController::class, 'cetak'])->name('laporansurpa.cetak');
    Route::resource('laporansurpa', laporansurpaController::class);

    Route::get('/notification/send/{id}', [NotificationController::class, 'sendNotification'])->name('notification.send');
    Route::get('/notification/sendEmail/{id}', [NotificationController::class, 'sendEmailNotification'])->name('notification.sendEmail');

    Route::get('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'reset'])->name('password.store');
});

Route::middleware(['auth', 'role:admin', 'prevent-back'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/security', [SecurityUserController::class, 'index'])->name('security.index');
    Route::get('/security/create', [SecurityUserController::class, 'create'])->name('security.create');
    Route::post('/security', [SecurityUserController::class, 'store'])->name('security.store');
    Route::get('/security/{id}/edit', [SecurityUserController::class, 'edit'])->name('security.edit');
    Route::put('/security/{id}', [SecurityUserController::class, 'update'])->name('security.update');
    Route::delete('/security/{id}', [SecurityUserController::class, 'destroy'])->name('security.destroy');
});

require __DIR__.'/auth.php';
