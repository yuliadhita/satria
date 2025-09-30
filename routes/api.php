<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::post('/chatbot', [ChatbotController::class, 'generate'])->name('chatbot.generate');
Route::post('/chatbot/send', [ChatbotController::class, 'sendMessage']);
Route::get('/chatbot/callback', [ChatbotController::class, 'handleCallback']);