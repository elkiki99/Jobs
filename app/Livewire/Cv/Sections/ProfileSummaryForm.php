<?php

namespace App\Livewire\Cv\Sections;

use Livewire\Component;
use App\Models\UserCv;
use Illuminate\Support\Facades\Auth;

class ProfileSummaryForm extends Component
{
    public $profile_summary = '';
    public $userCv;

    public function mount()
    {
        $this->userCv = Auth::user()->userCv;
        $this->profile_summary = $this->userCv->profile_summary ?? '';
    }

    protected function rules()
    {
        return [
            'profile_summary' => 'nullable|string|max:1000',
        ];
    }

    protected function messages()
    {
        return [
            'profile_summary.max' => 'The profile summary may not be greater than 1000 characters.',
        ];
    }

    public function updateProfileSummary()
    {
        $this->validate();

        UserCv::updateOrCreate(
            ['user_id' => Auth::id()],
            ['profile_summary' => $this->profile_summary]
        );

        session()->flash('profile_summary_updated', 'Profile summary updated successfully!');
    }

    public function render()
    {
        return view('livewire.cv.sections.profile-summary-form');
    }
}