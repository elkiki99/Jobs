<?php

namespace App\Livewire\Cv\Sections;

use App\Models\UserCv;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LanguageForm extends Component
{
    public $languages = [];
    public $userCv;

    public function mount()
    {
        $this->userCv = Auth::user()->userCv;
        $this->languages = $this->userCv->languages ?? [];
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

        $existingData = $this->userCv ? $this->userCv->toArray() : [];

        $updatedData = array_merge($existingData, [
            'languages' => $this->languages
        ]);

        UserCv::updateOrCreate(
            ['user_id' => Auth::id()],
            $updatedData
        );

        session()->flash('languages_updated', 'Languages updated successfully!');
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