<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\FacebookMessagesController;

Route::get('/messages', [FacebookMessagesController::class, 'getMessages']);
Route::post('/webhook', [App\Http\Controllers\MessengerWebhookController::class, 'handleWebhook']);
Route::get('/webhook', [App\Http\Controllers\MessengerWebhookController::class, 'verifyWebhook']);
