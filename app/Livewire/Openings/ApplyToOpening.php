<?php

namespace App\Livewire\Openings;

use App\Models\Opening;
use Livewire\Component;
// use Illuminate\Support\Facades\Auth;

class ApplyToOpening extends Component
{
    public $opening;
    public $hasApplied = false;

    public function mount(Opening $opening)
    {
        $this->opening = $opening;

        if (auth()->check() && auth()->user()->role === 'developer') {
            $this->hasApplied = auth()->user()->appliedOpenings()->where('opening_id', $this->opening->id)->exists();
        }
    }

    public function apply()
    {
        if (auth()->check() && auth()->user()->role === 'developer' && !$this->hasApplied) {
            auth()->user()->appliedOpenings()->attach($this->opening->id);
            $this->hasApplied = true;
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