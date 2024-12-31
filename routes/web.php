<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratPaketController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::Resource('pemilik', PemilikController::class);
    Route::Resource('kurir', KurirController::class);
    Route::Resource('ruang', RuangController::class);
    Route::Resource('suratPaket', SuratPaketController::class);
    Route::get('/notification/send/{id}', [NotificationController::class, 'sendNotification'])->name('notification.send');
    Route::get('/notification/send-email/{id}', [NotificationController::class, 'sendEmailNotification'])->name('notification.sendEmail');
});

require __DIR__.'/auth.php';
