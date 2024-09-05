<?php

namespace App\Livewire\Cv;

use App\Models\UserCV;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CvForm extends Component
{
    public $userCv;

    public function mount() 
    {
        $this->userCv = Auth::user()->userCv;
        if (!$this->userCv) {
            $this->userCv = new UserCV();
        }
    }

    public function render()
    {
        return view('livewire.cv.cv-form');
    }
}
