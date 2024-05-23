<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validate request
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Save message to the database
        $message = new Message();
        $message->user_id = auth()->id();
        $message->message = $request->input('message');
        $message->save();

        return response()->json(['message' => 'Message sent successfully']);
    }

    public function getMessages()
    {
        // Retrieve latest messages
        $messages = Message::orderBy('created_at', 'desc')->take(10)->get();

        return response()->json($messages);
    }
}

