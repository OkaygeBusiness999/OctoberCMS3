<?php namespace CustomChat\ChatPlugin;

use Illuminate\Support\Facades\Route;
use CustomChat\ChatPlugin\Http\Controllers\ChatController;
use CustomChat\ChatPlugin\Http\Controllers\MessageController;

Route::post('/chats', [ChatController::class, 'createChat']);
Route::get('/chats', [ChatController::class, 'listChats']);
Route::post('/messages', [MessageController::class, 'sendMessage']);
Route::post('/messages/{id}/reaction', [MessageController::class, 'addReaction']);
Route::get('/chats/{chat_id}/messages', [MessageController::class, 'getMessages']);
Route::get('/users/search', [ChatController::class, 'searchUsers']);