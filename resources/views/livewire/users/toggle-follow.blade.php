<div>
    @if (auth()->user()->id !== $user->id)
        @if ($isFollowing)
            <x-secondary-button wire:click="toggleFollow">Unfollow</x-secondary-button>
        @else
            <x-primary-button wire:click="toggleFollow">Follow</x-primary-button>
        @endif
    @endif
</div>