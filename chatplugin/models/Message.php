<?php namespace CustomChat\ChatPlugin\Models;

use Model;
use System\Models\File;

class Message extends Model
{
    protected $table = 'customchat_messages';

    protected $fillable = [
        'chat_id',
        'user_id',
        'message',
        'file_path',
        'reactions',
        'parent_message_id'
    ];

    public $belongsTo = [
        'chat' => ['CustomChat\ChatPlugin\Models\Chat'],
        'user' => ['Backend\Models\User'],
        'parent' => ['CustomChat\ChatPlugin\Models\Message', 'key' => 'parent_message_id'],
    ];

    public $hasMany = [
        'replies' => ['CustomChat\ChatPlugin\Models\Message', 'key' => 'parent_message_id'],
    ];

    // Enable file attachments
    public $attachOne = [
        'uploaded_file' => [\System\Models\File::class],
    ];

    protected $casts = [
        'reactions' => 'array',
    ];
    
    // Reactions, making sure only allowed emojis used
    public function addReaction($emoji)
    {
        $allowedEmojis = Settings::get('allowed_emojis', []);
        if (in_array($emoji, array_column($allowedEmojis, 'emoji'))) {
            $this->reactions[] = $emoji;
            $this->save();
        }
    }
}
