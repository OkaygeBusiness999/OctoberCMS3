<?php namespace CustomChat\ChatPlugin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use CustomChat\ChatPlugin\Models\Chat;
use Backend\Models\User;

class ChatController extends Controller
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
        $userId = $request->query('user_id');

        $chats = Chat::where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->get();

        return response()->json($chats);
    }

    public function searchUsers(Request $request)
    {
        $query = $request->input('query');
       
        $users = User::where('login', 'like', "%$query%")
            ->orWhere('id', $query)
            ->get();

        return response()->json($users);
    }
}
