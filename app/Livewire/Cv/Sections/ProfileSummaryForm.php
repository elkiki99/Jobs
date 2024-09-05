<?php

namespace App\Livewire\Cv\Sections;

use Livewire\Component;
use App\Models\UserCV;
use Illuminate\Support\Facades\Auth;

class ProfileSummaryForm extends Component
{
    public $profile_summary;
    public $userCv;

    public function mount(UserCV $userCv = null) 
    {
        $this->userCv = $userCv ?? UserCV::firstOrNew(['user_id' => Auth::id()]);
        $this->profile_summary = $this->userCv->profile_summary ?? '';
    }

    public function updateProfileSummary()
    {
        $this->validate([
            'profile_summary' => 'required|string|max:1000',
        ]);

        $this->userCv->profile_summary = $this->profile_summary;
        $this->userCv->user_id = Auth::id();
        $this->userCv->save();

        session()->flash('profile_summary_updated', 'Profile summary updated successfully!');
    }

    public function render()
    {
        return view('livewire.cv.sections.profile-summary-form');
    }
}