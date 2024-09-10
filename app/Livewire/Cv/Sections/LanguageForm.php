<?php

namespace App\Livewire\Cv\Sections;

use Livewire\Component;
use App\Models\UserCV;

class LanguageForm extends Component
{
    public $languages = [];
    public $userCv;

    public function mount()
    {
        $this->userCv = auth()->user()->userCv;
        if($this->userCv) { 
            $this->languages = $this->userCv->languages ?? [];
        }
    }
    
    protected function messages()
    {   
        return [
            'languages.*.language.required' => 'The language field is required.',
            'languages.*.proficiency.required' => 'The proficiency field is required.',
        ];
    }

    public function addLanguage()
    {
        $this->languages[] = ['language' => '', 'proficiency' => ''];
    }

    public function updateLanguages()
    {
        $this->validate([
            'languages.*.language' => 'required|string|max:255',
            'languages.*.proficiency' => 'required|string|max:255',
        ]);

        $existingLanguages = $this->userCv ? $this->userCv->languages : [];

        if($existingLanguages !== $this->languages) {
            $this->userCv = UserCv::updateOrCreate(
                ['user_id' => auth()->id()],
                ['languages' => $this->languages],
            );
            session()->flash('languages_updated', 'Work experience updated successfully!');
        } else {
            session()->flash('languages_updated_error', 'Language is needed to update your cv!');
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

    public function render()
    {
        return view('livewire.cv.sections.language-form');
    }
}
