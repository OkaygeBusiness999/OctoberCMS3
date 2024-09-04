<?php namespace CustomChat\ChatPlugin\Controllers;

use Backend\Classes\Controller;
use Illuminate\Http\Request;
use CustomChat\ChatPlugin\Models\Chat;

class Chats extends Controller
{

    public function createChat(Request $request)
    {
        $validated = $request->validate([
            'user1_id' => 'required|exists:backend_users,id',
            'user2_id' => 'required|exists:backend_users,id',
            'name' => 'nullable|string|max:255',
        ]);

        $chat = Chat::create($validated);

        return response()->json($chat, 201);
    }

    public function listChats(Request $request)
    {
        $userId = $request->query('user_id'); // Expect user_id to be passed in query params

        $chats = Chat::where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->get();

        return response()->json($chats);
    }
}
