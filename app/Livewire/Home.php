<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Company;
use App\Models\Opening;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    protected $listeners = ['userFollowed' => 'updateUserList'];

    public $followedUsers;
    public $openings;
    public $companies;

    public function updateUserList($userId)
    {
        $this->followedUsers->push($userId);
    }

    public function mount()
    {
        $this->openings = Opening::whereNotIn('id', function ($query) {
            $query->select('opening_id')
                  ->from('opening_user')
                  ->where('user_id', Auth::id());
        })->inRandomOrder()->take(6)->get();

        $this->followedUsers = Auth::user()->following()->pluck('users.id');

        $this->companies = Company::inRandomOrder()->take(8)->get();
    }

    public function render()
    {
        $this->users = User::whereNotIn('id', function ($query) {
            $query->select('followed_id')
                  ->from('followers')
                  ->where('follower_id', Auth::id());
        })->inRandomOrder()->where('role', 'recruiter')->take(8)->get();

        return view('livewire.home', [
            'users' => $this->users,
        ]);
    }
}
