<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\FacebookMessagesController;

// Route::get('/facebook/messages', [FacebookMessagesController::class, 'getMessages']);
// Route::get('/messages', [FacebookMessagesController::class, 'showMessages']);
Route::get('/conversations', [FacebookMessagesController::class, 'getConversations']);
//Route::get('/conversations/{conversationId}/messages', [FacebookMessagesController::class, 'getMessages']);
//Route::post('/messages/{messageId}/reply', [FacebookMessagesController::class, 'replyToMessage']);
