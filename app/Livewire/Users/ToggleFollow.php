<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use App\Notifications\UserFollowed;
use Illuminate\Support\Facades\Auth;

class ToggleFollow extends Component
{
    public $user;
    public $isFollowing = false;    
    
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
            $this->dispatch('userUnfollowed', $this->user->id);
        } else {
            $authUser->following()->attach($this->user->id);
            $this->isFollowing = true;
            $this->dispatch('userFollowed', $this->user->id);

            $this->user->notify(new UserFollowed($authUser));
        }
    }

    public function render()
    {
        return view('livewire.users.toggle-follow', [
            'isFollowing' => $this->isFollowing
        ]);
    }
}
