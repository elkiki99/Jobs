<?php

namespace App\Livewire\Cv\Sections;

use App\Models\UserCv;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EducationForm extends Component
{
    public $education = [];
    public $userCv;

    public function mount()
    {
        $this->userCv = Auth::user()->userCv;
        $this->education = $this->userCv->education ?? [];
    }

    protected function messages()
    {
        return [
            'education.*.institution.required' => 'The institution field is required.',
            'education.*.degree.required' => 'The degree field is required.',
            'education.*.description.required' => 'The description field is required.',
            'education.*.description.max' => 'The description field may not be greater than 1000 characters.',
            'education.*.start_year.required' => 'The start date is required.',
            'education.*.start_year.date' => 'The start date must be a valid one.',
            'education.*.end_year.date' => 'The end date must be a valid one.',
        ];
    }

    public function addEducation()
    {
        $this->education[] = ['institution' => '', 'degree' => '', 'description' => '', 'start_year' => '', 'end_year' => ''];
    }

    public function updateEducation()
    {
        $this->validate([
            'education.*.institution' => 'required|string|max:255',
            'education.*.degree' => 'required|string|max:255',
            'education.*.description' => 'required|string|max:1000',
            'education.*.start_year' => 'required|date',
            'education.*.end_year' => 'nullable|date',
        ]);

        $existingData = $this->userCv ? $this->userCv->toArray() : [];

        $updatedData = array_merge($existingData, [
            'education' => $this->education
        ]);

        UserCv::updateOrCreate(
            ['user_id' => Auth::id()],
            $updatedData
        );

        session()->flash('education_updated', 'Education updated successfully!');
    }

    public function removeEducation($index)
    {
        if (isset($this->education[$index])) {
            unset($this->education[$index]);
            $this->education = array_values($this->education);

            $this->updateEducation();
        }
    }

    public function render()
    {
        return view('livewire.cv.sections.education-form');
    }
}