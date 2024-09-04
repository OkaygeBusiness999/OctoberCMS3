<?php namespace CustomChat\ChatPlugin;

use CustomChat\ChatPlugin\Controllers\Chats;
use CustomChat\ChatPlugin\Controllers\Messages;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api'], function () {
    // Chat routes
    Route::post('chats', [Chats::class, 'createChat']);
    Route::get('chats', [Chats::class, 'listChats']);
  
    // Message routes
    Route::post('messages', [Messages::class, 'postMessage']);
    Route::post('messages/{id}/reactions', [Messages::class, 'addReaction']);
});