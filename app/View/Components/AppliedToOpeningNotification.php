<?php

namespace App\View\Components;

use Closure;
use App\Models\User;
use App\Models\Opening;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AppliedToOpeningNotification extends Component
{
    /**
     * Create a new component instance.
     */

    public $notification;
    public $opening;
    public $user;

    public function __construct($notification)
    {
        $this->notification = $notification;
        
        $this->user = isset($notification->data['candidate_id'])
        ? User::find($notification->data['candidate_id'])
        : null;

        $this->opening = isset($notification->data['opening_id'])
        ? Opening::find($notification->data['opening_id'])
        : null;    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.applied-to-opening-notification');
    }
}
