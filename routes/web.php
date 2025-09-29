<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\KelolaController;

// -------------------------------------------------------------------
// Halaman Home
// -------------------------------------------------------------------
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/chatbot', function () {
    return view('chatbot');
})->name('chatbot');

// -------------------------------------------------------------------
// Auth & Verifikasi
// -------------------------------------------------------------------
require __DIR__ . '/auth.php';
Route::get('/check-auth', function () {
    if (Auth::check()) {
        return 'User is authenticated: ' . Auth::user()->name;
    } else {
        return 'User is not authenticated.';
    }
})->name('check-auth');

// -------------------------------------------------------------------
// Halaman error jika unauthorized
// -------------------------------------------------------------------
Route::get('/notfound', function () {
    return view('error.unauthorized');
})->name('error.unauthorized');

// -------------------------------------------------------------------
// Lolos 'auth' dan 'verified'
// -------------------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {


        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
        // Form Pengajuan
        Route::name('form.')->prefix('/form')->group(function () {
            Route::get('/', [FormController::class, 'index'])->name('index');
            Route::post('/store', [FormController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [FormController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [FormController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [FormController::class, 'destroy'])->name('delete');
        });

        // Download
        Route::prefix('download')->name('download.')->group(function () {
            Route::get('/', [DownloadController::class, 'index'])->name('index');
            Route::post('/proses', [DownloadController::class, 'download'])->name('proses');
        });

        // Manage (prefix: /manage)
        Route::name('kelola.')->prefix('/kelola')->group(function () {

                // Akun Belanja
                Route::get('/indikator', [KelolaController::class, 'dataStrategis'])->name('indikator.index');
                Route::get('/indikator/create', [KelolaController::class, 'createDataStrategis'])->name('indikator.create');
                Route::get('/indikator/edit/{id}', [KelolaController::class, 'editDataStrategis'])->name('indikator.edit');
                Route::put('/indikator/{id}', [KelolaController::class, 'update'])->name('indikator.update');
                Route::post('/indikator/store', [KelolaController::class, 'storeDataStrategis'])->name('indikator.store');
                Route::put('/indikator/{id}/update-flag', [KelolaController::class, 'updateFlagDataStrategis'])->name('indikator.updateFlag');
          
        });
});