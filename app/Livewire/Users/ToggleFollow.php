<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ToggleFollow extends Component
{
    public $user;
    public $isFollowing;
    
    public function mount(User $user)
    {
        $this->user = $user;
        $this->isFollowing = auth()->user()->following()->where('followed_id', $user->id)->exists();
    }

    public function toggleFollow()
    {
        $authUser = Auth::user();

        if ($this->isFollowing) {
            $authUser->following()->detach($this->user->id);
            $this->isFollowing = false;
        } else {
            $authUser->following()->attach($this->user->id);
            $this->isFollowing = true;
        }
        // $this->emit('userFollowedOrUnfollowed');
    }

    public function render()
    {
        return view('livewire.users.toggle-follow');
    }
}
