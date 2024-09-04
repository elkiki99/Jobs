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
            'certifications.*.date.required' => 'The date field is required.',
            'certifications.*.date.date' => 'The date must be a valid one.',
        ];
    }
    
    public function addCertification()
    {
        $this->certifications[] = ['title' => '', 'date' => ''];
    }

    public function updateCertifications()
    {
        $this->validate([
            'certifications.*.title' => 'required|string|max:255',
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
