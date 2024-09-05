<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ShowUsers extends Component
{
    use WithPagination;

    public $followedUsers;
    protected $listeners = ['userFollowed' => 'updateUserList'];

    public function updateUserList($userId)
    {
        $this->followedUsers->push($userId);
    }

    public function mount()
    {
        if(auth()->check()) {
            $this->followedUsers = Auth::user()->following()->pluck('users.id');
        }
    }

    public function render()
    {
        if(!auth()->check()) {
            $users = User::latest()->paginate(24);
        } else {
            $users = User::where('id', '!=', Auth::id())
                ->whereDoesntHave('followers', function ($query) {
                    $query->where('follower_id', Auth::id());
                })
                ->latest()
                ->paginate(24);
        }

    
        return view('livewire.users.show-users', [
            'users' => $users
        ]);
    }
}