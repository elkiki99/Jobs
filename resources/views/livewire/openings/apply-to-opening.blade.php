<div>
    @auth
        @if (auth()->user()->role === 'developer')
            <div class="pt-4">
                @if (!$hasApplied)
                    <form wire:submit.prevent="apply">
                        <x-primary-button type="submit" aria-label="Apply to this opening">Apply</x-primary-button>
                    </form>
                @else
                    <p class="text-green-500 underline">Congrats! You have applied to this opening</p>
                @endif
            </div>
        @endif
    @else
        <div class="pt-4">
            <a href="{{ route('login') }}" class="hover:underline">Login to apply</a>
        </div>
    @endauth
</div>