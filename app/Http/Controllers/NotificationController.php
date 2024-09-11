<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $notifications = $user->notifications->sortByDesc('created_at');

        $this->markAsReadOnNextVisit($user);

        return view('notifications', [
            'notifications' => $notifications,
        ]);
    }

    private function markAsReadOnNextVisit($user)
    {
        if (session()->has('last_notification_visit')) {
            $user->unreadNotifications->markAsRead();
        }
        session(['last_notification_visit' => now()]);
    }
}