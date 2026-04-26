<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Medicine;
use App\Models\Conversation;
use App\Models\Message;

class AdminController extends Controller
{

    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'medicines' => Medicine::count(),
            'conversations' => Conversation::count(),
            'messages' => Message::count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentConversations = Conversation::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentConversations'));
    }

    public function medicines()
    {
        $medicines = Medicine::paginate(20);
        return view('admin.medicines', compact('medicines'));
    }

    public function users()
    {
        $users = User::withCount('conversations')->paginate(20);
        return view('admin.users', compact('users'));
    }
}