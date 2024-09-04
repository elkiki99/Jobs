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

    public function removeEducation($index)
    {
        if (isset($this->education[$index])) {
            unset($this->education[$index]);
            $this->education = array_values($this->education);

            $this->updateEducation();
        }
    }

    public function removeWorkExperience($index)
    {
        if (isset($this->work_experience[$index])) {
            unset($this->work_experience[$index]);
            $this->work_experience = array_values($this->work_experience);
    
            $this->updateWorkExperience();
        }
    }

    public function removeSkill($index)
    {
        if (isset($this->skills[$index])) {
            unset($this->skills[$index]);
            $this->skills = array_values($this->skills);

            $this->updateSkills();
        }
    }

    public function removeCertification($index)
    {
        if (isset($this->certifications[$index])) {
            unset($this->certifications[$index]);
            $this->certifications = array_values($this->certifications);

            $this->updateCertifications();
        }
    }

    public function removeLanguage($index)
    {
        if (isset($this->languages[$index])) {
            unset($this->languages[$index]);
            $this->languages = array_values($this->languages);
    
            $this->updateLanguages();
        }
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

    public function updateProfileSummary()
    {
        $this->validate(['profile_summary' => 'required|string|max:500']);
        $this->userCv->update(['profile_summary' => $this->profile_summary]);
        session()->flash('cv_updated', 'Profile summary updated successfully!');
    }

    public function updateEducation()
    {
        $this->validate([
            'education.*.institution' => 'required|string|max:255',
            'education.*.degree' => 'required|string|max:255',
            'education.*.start_year' => 'required|integer',
            'education.*.end_year' => 'required|integer',
        ]);
        $this->userCv->update(['education' => $this->education]);
        session()->flash('cv_updated', 'Education updated successfully!');
    }

    public function updateWorkExperience()
    {
        $this->validate([
            'work_experience.*.company' => 'required|string|max:255',
            'work_experience.*.position' => 'required|string|max:255',
            'work_experience.*.start_date' => 'required|date',
            'work_experience.*.end_date' => 'required|date',
            'work_experience.*.description' => 'required|string',
        ]);
        $this->userCv->update(['work_experience' => $this->work_experience]);
        session()->flash('cv_updated', 'Work experience updated successfully!');
    }

    public function updateSkills()
    {
        $this->validate([
            'skills' => 'required|array',
            'skills.*' => 'required|string|max:255',
        ]);
        $this->userCv->update(['skills' => $this->skills]);
        session()->flash('cv_updated', 'Skills updated successfully!');
    }

    public function updateCertifications()
    {
        $this->validate([
            'certifications.*.title' => 'required|string|max:255',
            'certifications.*.year' => 'required|integer',
        ]);
        $this->userCv->update(['certifications' => $this->certifications]);
        session()->flash('cv_updated', 'Certifications updated successfully!');
    }

    public function updateLanguages()
    {
        $this->validate([
            'languages.*.language' => 'required|string|max:255',
            'languages.*.proficiency' => 'required|string|max:255',
        ]);
        $this->userCv->update(['languages' => $this->languages]);
        session()->flash('cv_updated', 'Languages updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile.cv');
    }
}
