<?php namespace CustomChat\ChatPlugin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use CustomChat\ChatPlugin\Models\Message;
use CustomChat\ChatPlugin\Models\Chat;

class MessageController extends Controller
{

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'chat_id' => 'required|exists:customchat_chats,id',
            'user_id' => 'required|exists:backend_users,id',
            'message' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'parent_message_id' => 'nullable|exists:customchat_messages,id',
        ]);

        $chat = Chat::find($data['chat_id']);

        if (!$chat->participants->contains($data['user_id'])) {
            return response()->json(['error' => 'You are not allowed to post in this chat.'], 403);
        }

        $message = Message::create($data);

        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $message->uploaded_file = $uploadedFile;
            $message->save();
        }

        return response()->json($message, 201);
    }

    public function getMessages(Request $request, $chat_id)
    {
        $chat = Chat::find($chat_id);

        if (!$chat) {
            return response()->json(['error' => 'Chat not found'], 404);
        }

        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        if (!$chat->participants->contains($userId)) {
            return response()->json(['error' => 'You are not allowed to view these messages.'], 403);
        }

        $messages = Message::where('chat_id', $chat_id)->get();
        return response()->json($messages);
    }


    public function addReaction(Request $request, $id)
    {
        $validated = $request->validate([
            'emoji' => 'required|string',
        ]);
    
        $message = Message::find($id);
    
        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }
    
        $success = $message->addReaction($validated['emoji']);
    
        if ($success) {
            return response()->json(['message' => 'Reaction added successfully']);
        } else {
            return response()->json(['error' => 'Invalid emoji'], 400);
        }
    }
}
