<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct(protected GeminiService $gemini) {}

    public function index()
    {
        $conversations = Conversation::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('chat.index', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        abort_if($conversation->user_id !== Auth::id(), 403);
        $messages = $conversation->messages()->get();
        $conversations = Conversation::where('user_id', Auth::id())->latest()->get();

        return view('chat.show', compact('conversation', 'messages', 'conversations'));
    }

    public function store(Request $request)
    {
        $conversation = Conversation::create([
            'user_id' => Auth::id(),
            'title' => substr($request->message, 0, 40) . '...',
        ]);

        return redirect()->route('chat.show', $conversation);
    }

    public function sendMessage(Request $request, Conversation $conversation)
    {
        abort_if($conversation->user_id !== Auth::id(), 403);

        $request->validate(['message' => 'required|string|max:1000']);

        // User message save
        Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'user',
            'content' => $request->message,
        ]);

        // Gemini API call
        $response = $this->gemini->chat($request->message);

        // AI message save
        Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'assistant',
            'content' => $response['message'],
            'medicines' => $response['medicines'],
        ]);

        return response()->json([
            'message' => $response['message'],
            'medicines' => $response['medicines'],
        ]);
    }
}