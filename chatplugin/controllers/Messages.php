<?php namespace CustomChat\ChatPlugin\Controllers;

use Backend\Classes\Controller;
use Illuminate\Http\Request;
use CustomChat\ChatPlugin\Models\Message;
use CustomChat\ChatPlugin\Models\Chat;

class Messages extends Controller
{

    public function postMessage(Request $request)
    {
        $data = $request->validate([
            'chat_id' => 'required|exists:customchat_chats,id',
            'user_id' => 'required|exists:backend_users,id',
            'message' => 'nullable|string',
            'file_path' => 'nullable|file',
        ]);

        $chat = Chat::find($data['chat_id']);
        if ($chat->user1_id !== (int) $data['user_id'] && $chat->user2_id !== (int) $data['user_id']) {
            return response()->json(['error' => 'You are not allowed to post in this chat.'], 403);
        }

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $message->uploaded_file = $file; // Automatically handles the attachment
        }

        $message = Message::create($data);

        return response()->json($message, 201);
    }

    // Add a reaction to a message
    public function addReaction(Request $request, $id)
    {

        $validated = $request->validate([
            'emoji' => 'required|string',
        ]);

        
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $reactions = json_decode($message->reactions, true) ?: [];
        $reactions[] = $validated['emoji'];

        $message->reactions = json_encode($reactions);
        $message->save();

        return response()->json(['message' => 'Reaction added successfully']);
    }
}
