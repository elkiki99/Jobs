<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->latest()->paginate(24);

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function show($username)
    {
        $user = User::with('opening')->where('username', $username)->firstOrFail();
        $openings = $user->opening()->paginate(24);
        
        return view('users.show', [
            'user' => $user,
            'openings' => $openings
        ]);
    }
}
