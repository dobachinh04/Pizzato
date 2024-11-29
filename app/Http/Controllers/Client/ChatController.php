<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('client.chat');
    }

    // Lấy lịch sử tin nhắn giữa client và admin
    public function getMessages($adminId)
    {
        $messages = Message::where(function ($query) use ($adminId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $adminId);
        })->orWhere(function ($query) use ($adminId) {
            $query->where('sender_id', $adminId)
                  ->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    // Gửi tin nhắn từ client đến admin
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        // Có thể thêm logic broadcast ở đây nếu cần

        return response()->json($message);
    }
}
