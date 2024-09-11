<?php

namespace App\Livewire\Openings;

use App\Models\Opening;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AppliedToOpening;

class ApplyToOpening extends Component
{
    public $opening;
    public $recruiter;
    public $hasApplied = false;

    public function mount(Opening $opening)
    {
        $this->opening = $opening;
        $this->recruiter = $opening->recruiter;

        if (Auth::check() && Auth::user()->role === 'developer') {
            $this->hasApplied = Auth::user()->appliedOpenings()->where('opening_id', $this->opening->id)->exists();
        }
    }
    public function apply()
    {
        if (Auth::check() && Auth::user()->role === 'developer' && !$this->hasApplied) {
            Auth::user()->appliedOpenings()->attach($this->opening->id);
            $this->hasApplied = true;

            $this->recruiter->notify(new AppliedToOpening($this->opening, Auth::user()));
        }
    }

    public function render()
    {
        return view('livewire.openings.apply-to-opening', [
            'opening' => $this->opening,
            'hasApplied' => $this->hasApplied,
        ]);
    }
}