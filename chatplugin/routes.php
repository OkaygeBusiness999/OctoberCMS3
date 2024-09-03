<?php namespace CustomChat\ChatPlugin;

use Backend;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Define the routes for the backend controllers of your plugin here.
|
*/

Route::group(['prefix' => 'backend/customchat/chatplugin', 'middleware' => ['web', 'backend']], function () {
    // Routes for the Chats controller
    Route::controller('chats', 'CustomChat\ChatPlugin\Controllers\Chats');

    // Routes for the Messages controller
    Route::controller('messages', 'CustomChat\ChatPlugin\Controllers\Messages');
});