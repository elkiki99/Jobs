<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function following()
    {
        return view('users.following');
    }

    public function followers()
    {
        $users = Auth::user()->followers()->paginate(24);

        return view('users.followers', [
            'users' => $users,
        ]);
    }

    public function network()
    {
        return view('users.network');
    }

    public function show(User $user)
    {
        $openings = $user->opening()->paginate(12);

        return view('users.show', [
            'user' => $user,
            'openings' => $openings,
        ]);
    }
}
