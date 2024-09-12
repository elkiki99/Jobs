<?php

namespace App\View\Components;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class UserFollowedNotification extends Component
{
    /**
     * Create a new component instance.
     */

    public $notification;
    public $follower;

    public function __construct($notification)
    {
        $this->notification = $notification;
        $this->follower = isset($notification->data['follower_id'])
        ? User::find($notification->data['follower_id'])
        : null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-followed-notification');
    }
}
