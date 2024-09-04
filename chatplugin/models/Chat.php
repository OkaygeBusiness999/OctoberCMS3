<?php namespace CustomChat\ChatPlugin\Models;

use Model;

class Chat extends Model
{
    protected $table = 'customchat_chats';

    public $belongsTo = [
        'user1' => ['Backend\Models\User', 'key' => 'user1_id'],
        'user2' => ['Backend\Models\User', 'key' => 'user2_id'],
    ];

    public $hasMany = [
        'messages' => ['CustomChat\ChatPlugin\Models\Message'],
    ];

    // Fillable attributes
    protected $fillable = ['name', 'user1_id', 'user2_id'];
}
