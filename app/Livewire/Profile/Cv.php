<?php

namespace App\Livewire\Profile;

use App\Models\UserCV;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Cv extends Component
{
    public $userCv;
    public $profile_summary;
    public $education = [];
    public $work_experience = [];
    public $skills = [];
    public $certifications = [];
    public $languages = [];

    public function mount(UserCV $userCv) 
    {
        $this->userCv = $userCv;
        if ($this->userCv) {
            $this->profile_summary = $this->userCv->profile_summary;
            $this->education = $this->userCv->education ?? [];
            $this->work_experience = $this->userCv->work_experience ?? [];
            $this->skills = $this->userCv->skills ?? [];
            $this->certifications = $this->userCv->certifications ?? [];
            $this->languages = $this->userCv->languages ?? [];
        }
    }

    public function addEducation()
    {
        $this->education[] = ['institution' => '', 'degree' => '', 'start_year' => '', 'end_year' => ''];
    }

    public function addWorkExperience()
    {
        $this->work_experience[] = ['company' => '', 'position' => '', 'start_date' => '', 'end_date' => '', 'description' => ''];
    }

    public function addSkill()
    {
        $this->skills[] = '';
    }

    public function addCertification()
    {
        $this->certifications[] = ['title' => '', 'year' => ''];
    }

    public function addLanguage()
    {
        $this->languages[] = ['language' => '', 'proficiency' => ''];
    }

    public function updateCv()
    {
        $validatedData = $this->validate([
            'profile_summary' => 'nullable|string|max:500',
            'education.*.institution' => 'nullable|string|max:255',
            'education.*.degree' => 'nullable|string|max:255',
            'education.*.start_year' => 'nullable|integer',
            'education.*.end_year' => 'nullable|integer',
            'work_experience.*.company' => 'nullable|string|max:255',
            'work_experience.*.position' => 'nullable|string|max:255',
            'work_experience.*.start_date' => 'nullable|date',
            'work_experience.*.end_date' => 'nullable|date',
            'work_experience.*.description' => 'nullable|string',
            'skills' => 'nullable|array',
            'skills.*' => 'nullable|string|max:255',
            'certifications.*.title' => 'nullable|string|max:255',
            'certifications.*.year' => 'nullable|integer',
            'languages.*.language' => 'nullable|string|max:255',
            'languages.*.proficiency' => 'nullable|string|max:255',
        ]);

        $cv = Auth::user()->userCv()->updateOrCreate(
            ['user_id' => Auth::id()],
            $validatedData
        );
        
        session()->flash('cv_updated', 'CV updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile.cv');
    }
}