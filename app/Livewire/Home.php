<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Company;
use App\Models\Opening;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class Home extends Component
{
    protected $listeners = ['userFollowed' => 'handleUserFollowed'];

    public $followedUsers;
    public $openings;
    public $companies;
    public $users;

    public function handleUserFollowed($userId)
    {
        if ($this->followedUsers instanceof Collection) {
            $this->followedUsers->push($userId);
        } else {
            $this->followedUsers = collect([$userId]);
        }
        $this->updateUserList();
    }

    public function updateOpeningsList()
    {
        $userId = Auth::id();
    
        $notAppliedOpenings = Opening::whereNotIn('id', function ($query) use ($userId) {
            $query->select('opening_id')
                  ->from('opening_user')
                  ->where('user_id', $userId);
        })
        ->latest()
        ->take(6)
        ->get();
        
        $remainingSlots = 6 - $notAppliedOpenings->count();
    
        if ($remainingSlots > 0) {
            $appliedOpenings = Opening::whereIn('id', function ($query) use ($userId) {
                $query->select('opening_id')
                      ->from('opening_user')
                      ->where('user_id', $userId);
            })
            ->latest()
            ->take($remainingSlots)
            ->get();
            
            $this->openings = $notAppliedOpenings->merge($appliedOpenings);
        } else {
            $this->openings = $notAppliedOpenings;
        }
    }

    public function updateUserList()
    {
        $notFollowedRecruiters = User::where('id', '!=', Auth::id())
            ->whereDoesntHave('followers', function ($query) {
                $query->where('follower_id', Auth::id());
            })
            ->latest()
            ->where('role', 'recruiter')
            ->take(8)
            ->get();

        $remainingSlots = 8 - $notFollowedRecruiters->count();

        if ($remainingSlots > 0) {
            $followedRecruiters = User::where('id', '!=', Auth::id())
                ->whereHas('followers', function ($query) {
                    $query->where('follower_id', Auth::id());
                })
                ->latest()
                ->where('role', 'recruiter')
                ->take($remainingSlots)
                ->get();

            $this->users = $notFollowedRecruiters->merge($followedRecruiters);
        } else {
            $this->users = $notFollowedRecruiters;
        }
    }

    public function mount()
    {
        $this->updateOpeningsList();

        if(auth()->check()) {
            $this->followedUsers = Auth::user()->following()->pluck('users.id');
        } else {
            $this->followedUsers = collect();
        }

        $this->companies = Company::inRandomOrder()->take(8)->get();
    }

    public function render()
    {
        if (!auth()->check()) {
            $this->users = User::inRandomOrder()->where('role', 'recruiter')->take(8)->get();
        } else {
            $this->updateUserList();
        }

        return view('livewire.home', [
            'users' => $this->users,
            'openings' => $this->openings,
            'companies' => $this->companies,
        ]);
    }
}