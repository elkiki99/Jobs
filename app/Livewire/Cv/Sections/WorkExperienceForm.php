<?php

namespace App\Livewire\Cv\Sections;

use Livewire\Component;
use App\Models\UserCV;

class WorkExperienceForm extends Component
{
    public $work_experience = [];
    public $userCv;

    public function mount()
    {
        $this->userCv = auth()->user()->userCv;
        if($this->userCv) { 
            $this->work_experience = $this->userCv->work_experience ?? [];
        }
    }
    
    protected function messages()
    {
        return [
            'work_experience.*.company.required' => 'The company field is required.',
            'work_experience.*.position.required' => 'The position field is required.',
            'work_experience.*.start_date.required' => 'The start date is required.',
            'work_experience.*.start_date.date' => 'The start date must be an valid one.',
            'work_experience.*.end_date.date' => 'The end date must be an valid one.',
            'work_experience.*.description.required' => 'The description field is required.',
        ];
    }

    public function addWorkExperience()
    {
        $this->work_experience[] = ['company' => '', 'position' => '', 'start_date' => '', 'end_date' => '', 'description' => ''];
    }

    public function updateWorkExperience()
    {
        $this->validate([
            'work_experience.*.company' => 'required|string|max:255',
            'work_experience.*.position' => 'required|string|max:255',
            'work_experience.*.start_date' => 'required|date',
            'work_experience.*.end_date' => 'nullable|date',
            'work_experience.*.description' => 'required|string',
        ]);
        $this->userCv->update(['work_experience' => $this->work_experience]);
        session()->flash('work_experience_updated', 'Work experience updated successfully!');
    }

    public function removeWorkExperience($index)
    {
        if (isset($this->work_experience[$index])) {
            unset($this->work_experience[$index]);
            $this->work_experience = array_values($this->work_experience);
    
            $this->updateWorkExperience();
        }
    }

    public function render()
    {
        return view('livewire.cv.sections.work-experience-form');
    }
}
