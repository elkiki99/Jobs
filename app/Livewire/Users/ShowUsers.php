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
        // $this->resetPage();
    }

    public function mount()
    {
        $this->followedUsers = Auth::user()->following()->pluck('users.id');
    }

    public function render()
    {
        $users = User::where('id', '!=', Auth::id())
            ->whereNotIn('id', $this->followedUsers)
            ->latest()
            ->paginate(24);
    
        return view('livewire.users.show-users', [
            'users' => $users
        ]);
    }
}