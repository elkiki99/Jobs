<?php

namespace App\Livewire\Cv\Sections;

use App\Models\UserCv;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SkillsForm extends Component
{
    public $skillsInput = '';
    public $userCv;

    public function mount() 
    {
        $this->userCv = Auth::user()->userCv;
        if ($this->userCv) {
            $this->skillsInput = implode(', ', json_decode($this->userCv->skills, true) ?? []);
        } else {
            $this->skillsInput = '';
        }
    }

    protected function rules()
    {
        return [
            'skillsInput' => 'required|string',
        ];
    }

    protected function messages()
    {
        return [
            'skillsInput.required' => 'The skills field is required.',
        ];
    }

    public function updateSkills()
    {
        $this->validate();

        $skillsArray = array_map('trim', explode(',', $this->skillsInput));
        $skillsJson = json_encode($skillsArray);

        UserCv::updateOrCreate(
            ['user_id' => Auth::id()],
            ['skills' => $skillsJson]
        );

        session()->flash('skills_updated', 'Skills updated successfully!');
    }

    public function render()
    {
        return view('livewire.cv.sections.skills-form');
    }
}