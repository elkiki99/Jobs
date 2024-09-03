<?php

namespace App\Livewire\Openings;

use App\Models\Opening;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ApplyToOpening extends Component
{
    public $opening;
    public $hasApplied = false;

    public function mount($slug)
    {
        $this->opening = Opening::with(['user', 'user.company', 'category'])
                            ->where('slug', $slug)
                            ->firstOrFail();

        if (Auth::check() && Auth::user()->role === 'developer') {
            $this->hasApplied = Auth::user()->appliedOpenings()->where('opening_id', $this->opening->id)->exists();
        }
    }

    public function apply()
    {
        if (Auth::check() && Auth::user()->role === 'developer' && !$this->hasApplied) {
            Auth::user()->appliedOpenings()->attach($this->opening->id);
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