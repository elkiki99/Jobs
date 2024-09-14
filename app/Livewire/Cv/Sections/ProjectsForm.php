<?php

namespace App\Livewire\Cv\Sections;

use App\Models\UserCv;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProjectsForm extends Component
{
    public $projects = [];
    public $userCv;

    public function mount()
    {
        $this->userCv = Auth::user()->userCv;
        $this->projects = $this->userCv->projects ?? [];
    }

    protected function messages()
    {
        return [
            'projects.*.title.required' => 'The project title field is required.',
            'projects.*.title.max' => 'The project title may not be greater than 255 characters.',
            'projects.*.description.required' => 'The project description field is required.',
            'projects.*.description.max' => 'The project description may not be greater than 1000 characters.',
            'projects.*.technologies.required' => 'The technologies used field is required.',
            'projects.*.technologies.max' => 'The technologies used may not be greater than 255 characters.',
            'projects.*.date.required' => 'The project date field is required.',
            'projects.*.date.date' => 'The project date must be a valid date.',
        ];
    }

    public function addProject()
    {
        $this->projects[] = ['title' => '', 'description' => '', 'technologies' => '', 'date' => ''];
    }

    public function updateProjects()
    {
        $this->validate([
            'projects.*.title' => 'required|string|max:255',
            'projects.*.description' => 'required|string|max:1000',
            'projects.*.technologies' => 'required|string|max:255',
            'projects.*.date' => 'required|date',
        ]);

        $existingData = $this->userCv ? $this->userCv->toArray() : [];

        $updatedData = array_merge($existingData, [
            'projects' => $this->projects
        ]);

        UserCv::updateOrCreate(
            ['user_id' => Auth::id()],
            $updatedData
        );

        session()->flash('projects_updated', 'Project updated successfully!');
    }

    public function removeProject($index)
    {
        if (isset($this->projects[$index])) {
            unset($this->projects[$index]);
            $this->projects = array_values($this->projects);
            $this->updateProjects();
        }
    }

    public function render()
    {
        return view('livewire.cv.sections.projects-form');
    }
}