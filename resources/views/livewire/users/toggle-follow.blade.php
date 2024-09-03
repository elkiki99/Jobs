<div class="flex items-center justify-between">
    @if (auth()->user()->id !== $user->id)
        <div class="flex justify-center w-32">
            @if ($isFollowing)
                <x-secondary-button class="flex justify-center w-full text-center" wire:click="toggleFollow">Unfollow</x-secondary-button>
            @else
                <x-primary-button class="flex justify-center w-full text-center" wire:click="toggleFollow">Follow</x-primary-button>
            @endif
        </div>
    @endif
</div>