<?php

namespace App\Livewire\Cv;

use App\Models\User;
use Livewire\Component;

class ShowCv extends Component
{
    public $user;

    public function mount($username) 
    {
        $this->user = User::with('userCv')->where('username', $username)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.cv.show-cv', [
            'user' => $this->user
        ]);
    }
}
