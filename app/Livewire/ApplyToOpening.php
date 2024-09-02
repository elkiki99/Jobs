<?php

namespace App\Livewire;

use App\Models\Opening;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ApplyToOpening extends Component
{
    public $opening;
    public $hasApplied = false;

    public function mount($slug)
    {
        // Fetch the opening and related models
        $this->opening = Opening::with(['user', 'user.company', 'category'])
                            ->where('slug', $slug)
                            ->firstOrFail();

        // Check if the authenticated user has already applied
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
        return view('livewire.apply-to-opening', [
            'opening' => $this->opening,
            'hasApplied' => $this->hasApplied,
        ]);
    }
}