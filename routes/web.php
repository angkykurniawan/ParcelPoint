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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.index');

// Rute Verifikasi Email
Route::get('/email/verify', EmailVerificationPromptController::class)->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (Request $request) {
    $request->fulfill();
    return redirect('/dashboard'); // Redirect setelah verifikasi berhasil
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::Resource('profile', ProfileController::class);

    Route::get('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'reset'])->name('password.store');
    Route::Resource('pemilik', PemilikController::class);
    Route::Resource('kurir', KurirController::class);
    Route::Resource('ruang', RuangController::class);
    Route::Resource('suratPaket', SuratPaketController::class);
    Route::get('suratPaket/{suratPaket}/history', [SuratPaketController::class, 'history'])->name('suratPaket.history');
    Route::Resource('laporansurpa', laporansurpaController::class);
    Route::get('/notification/send/{id}', [NotificationController::class, 'sendNotification'])->name('notification.send');
    Route::get('/notification/sendEmail/{id}', [NotificationController::class, 'sendEmailNotification'])->name('notification.sendEmail');




});

//Fitur CekResi
Route::get('/cekresi', [ResiController::class, 'searchResi'])->name('search.resi');
Route::get('/search-owner', [SuratPaketController::class, 'searchOwner'])->name('searchOwner');

require __DIR__.'/auth.php';
