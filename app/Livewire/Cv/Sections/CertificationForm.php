<?php

namespace App\Livewire\Cv\Sections;

use Livewire\Component;
use App\Models\UserCV;

class CertificationForm extends Component
{
    public $certifications = [];
    public $userCv;
    
    public function mount()
    {
        $this->userCv = auth()->user()->userCv;
        if($this->userCv) { 
            $this->certifications = $this->userCv->certifications ?? [];
        }
    }

    protected function messages()
    {   
        return [
            'certifications.*.title.required' => 'The title field is required.',
            'certifications.*.organization.required' => 'The organization field is required.',
            'certifications.*.organization.max' => 'The organization may not be greater than 255 characters.',
            'certifications.*.description.required' => 'The description field is required.',
            'certifications.*.description.max' => 'The description may not be greater than 1000 characters.',
            'certifications.*.date.date' => 'The date must be a valid one.',
            'certifications.*.date.required' => 'The date field is required.',
        ];
    }
    
    public function addCertification()
    {
        $this->certifications[] = ['title' => '', 'organization' => '', 'description' => '', 'date' => ''];
    }

    public function updateCertifications()
    {
        $this->validate([
            'certifications.*.title' => 'required|string|max:255',
            'certifications.*.organization' => 'required|string|max:255',
            'certifications.*.description' => 'required|string|max:1000',
            'certifications.*.date' => 'required|date',
        ]);
        $this->userCv->update(['certifications' => $this->certifications]);
        session()->flash('certifications_updated', 'Certifications updated successfully!');
    }

    public function removeCertification($index)
    {
        if (isset($this->certifications[$index])) {
            unset($this->certifications[$index]);
            $this->certifications = array_values($this->certifications);
            $this->updateCertifications();
        }
    }

    public function render()
    {
        return view('livewire.cv.sections.certification-form');
    }
}
