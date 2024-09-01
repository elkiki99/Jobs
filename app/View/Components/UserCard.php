<?php

namespace App\View\Components;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class UserCard extends Component
{
    /**
     * Create a new component instance.
     */

    public $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-card', [
            'user' => $this->user
        ]);
    }
}
