<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->latest()->paginate(24);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function followers()
    {
        $users = Auth::user()->followers()->paginate(24);

        return view('users.followers', [
            'users' => $users,
        ]);
    }

    public function following()
    {
        $users = Auth::user()->following()->paginate(24);

        return view('users.following', [
            'users' => $users,
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
