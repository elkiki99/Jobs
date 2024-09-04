<?php

namespace App\Livewire\Cv\Sections;

use Livewire\Component;
use App\Models\UserCV;

class SkillsForm extends Component
{
    public $skillsInput = '';
    public $userCv;

    public function mount(UserCV $userCv) 
    {
        $this->userCv = $userCv;

        if ($this->userCv) {
            $this->skillsInput = implode(', ', json_decode($this->userCv->skills, true) ?? []);
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
        $this->userCv->update(['skills' => json_encode($skillsArray)]);

        session()->flash('skills_updated', 'Skills updated successfully!');
    }

    public function render()
    {
        return view('livewire.cv.sections.skills-form');
    }
}