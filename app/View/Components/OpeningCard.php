<?php

namespace App\View\Components;

use App\Models\Opening;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OpeningCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $opening;
    
    public function __construct(Opening $opening)
    {
        $this->opening = $opening;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.opening-card', [
            'opening' => $this->opening
        ]);
    }
}
