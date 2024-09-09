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
            'user_ids' => 'required|array|min:2',
            'user_ids.*' => 'exists:backend_users,id',
            'name' => 'nullable|string|max:255',
        ]);

        $chat = Chat::create(['name' => $validated['name'] ?? null]);
        $chat->participants()->attach($validated['user_ids']);

        return response()->json($chat->load('participants'), 201);
    }

    public function listChats(Request $request)
    {
        $userId = $request->query('user_id');

        $chats = Chat::whereHas('participants', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->get();

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
