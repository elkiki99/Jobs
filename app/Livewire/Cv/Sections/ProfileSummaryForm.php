<?php

namespace App\Livewire\Cv\Sections;

use Livewire\Component;
use App\Models\UserCV;

class ProfileSummaryForm extends Component
{
    public $profile_summary;
    public $userCv;
    
    public function mount(UserCV $userCv) 
    {
        $this->userCv = $userCv;
        if ($this->userCv) {
            $this->profile_summary = $this->userCv->profile_summary;
        }
    }
    
    public function updateProfileSummary()
    {
        $this->validate(['profile_summary' => 'required|string|max:500']);
        $this->userCv->update(['profile_summary' => $this->profile_summary]);
        session()->flash('profile_summary_updated', 'Profile summary updated successfully!');
    }

    public function render()
    {
        return view('livewire.cv.sections.profile-summary-form');
    }
}
