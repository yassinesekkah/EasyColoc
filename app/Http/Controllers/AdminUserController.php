<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function toggleBan(User $user)
    {
        $user->update([
            'is_banned' => !$user->is_banned
        ]);

        return back()->with('success', 'User status updated.');
    }
}
