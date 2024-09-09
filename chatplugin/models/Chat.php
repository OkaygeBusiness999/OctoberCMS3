<?php namespace CustomChat\ChatPlugin\Models;

use Model;

class Chat extends Model
{
    protected $table = 'customchat_chats';

    public $belongsToMany = [
        'participants' => [
            'Backend\Models\User',
            'table' => 'customchat_chat_user',
            'key' => 'chat_id',
            'otherKey' => 'user_id',
        ],
    ];
    public $hasMany = [
        'messages' => ['CustomChat\ChatPlugin\Models\Message'],
    ];

    protected $fillable = ['name'];
}
