<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\KelolaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\HomeDataController;


// -------------------------------------------------------------------
// Halaman Home
// -------------------------------------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/chatbot', function () {
    return view('chatbot');
})->name('chatbot');

// API endpoint untuk fetch chat
Route::post('/chatbot/send', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');
Route::get('/chatbot/callback', [ChatbotController::class, 'handleCallback']);

Route::prefix('data')->name('data.')->group(function () {
    Route::get('/', [HomeDataController::class, 'index'])->name('index');
    Route::post('/proses', [HomeDataController::class, 'download'])->name('proses');
});

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

        // Panduan
        Route::prefix('panduan')->name('panduan.')->group(function () {
            Route::get('/', [PanduanController::class, 'index'])->name('index');
            Route::get('/upload', [PanduanController::class, 'uploadPanduan'])->name('upload.form');
            Route::post('/upload', [PanduanController::class, 'storePanduan'])->name('upload');
        });
});