<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'client')->get(); // Lấy danh sách khách hàng
        return view('admin.chat.index', compact('clients'));
    }

    // Hiển thị chi tiết cuộc trò chuyện với một khách hàng
    public function chatWithClient($clientId)
    {
        $client = User::findOrFail($clientId);
        $messages = Message::where(function ($query) use ($clientId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $clientId);
        })->orWhere(function ($query) use ($clientId) {
            $query->where('sender_id', $clientId)
                  ->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        return view('admin.chat.chat', compact('client', 'messages'));
    }

    // Gửi tin nhắn từ admin đến client
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

        // Broadcast tin nhắn mới
        // broadcast(new \App\Events\MessageSent($message))->toOthers();

        return redirect()->route('admin.chatWithClient', $request->receiver_id);
    }
}
