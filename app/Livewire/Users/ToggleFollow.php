<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class ToggleFollow extends Component
{
    public $user;
    public $isFollowing;
    
    public function mount(User $user)
    {
        $this->user = $user;
        $this->isFollowing = auth()->user()->following()->where('followed_id', $user->id)->exists();
    }

    public function render()
    {
        return view('livewire.users.toggle-follow');
    }
}
