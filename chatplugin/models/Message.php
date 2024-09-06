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

    public $attachOne = [
        'uploaded_file' => [\System\Models\File::class],
    ];

    protected $casts = [
        'reactions' => 'array',
    ];
    
    public function addReaction($emoji)
    {
        $allowedEmojis = Settings::get('allowed_emojis', []);
        $allowedEmojiList = array_column($allowedEmojis, 'emoji');

        if (in_array($emoji, $allowedEmojiList)) {
            
            $reactions = $this->reactions ?: [];
            
            $reactions[] = $emoji;

            $this->reactions = $reactions;
            $this->save();
            
            return true;
        }
        
        return false;
    }
}
