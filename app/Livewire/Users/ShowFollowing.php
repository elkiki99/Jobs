<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ShowFollowing extends Component
{
    use WithPagination;

    public $followedUsers;
    protected $listeners = ['userUnfollowed' => 'removeUserFromList'];

    public function removeUserFromList($userId)
    {
        $this->followedUsers = $this->followedUsers->filter(function ($id) use ($userId) {
            return $id !== $userId;
        });
    }

    public function mount()
    {
        $this->followedUsers = Auth::user()->following()->pluck('users.id');
    }

    public function render()
    {
        $users = User::where('id', '!=', Auth::id())
            ->whereIn('id', $this->followedUsers)
            ->latest()
            ->paginate(24);
            
        return view('livewire.users.show-following', [
            'users' => $users
        ]);
    }
}
