<?php

namespace App\Livewire\Cv;

use App\Models\UserCV;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CvForm extends Component
{
    public $userCv;

    public function mount(UserCV $userCv) 
    {
        $this->userCv = $userCv;
    }

    public function render()
    {
        return view('livewire.cv.cv-form');
    }
}
