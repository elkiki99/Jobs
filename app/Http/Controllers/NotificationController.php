<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->paginate(24);
        $user->unreadNotifications->markAsRead();

        return view('notifications', [
            'notifications' => $notifications,
        ]);
    } 
}