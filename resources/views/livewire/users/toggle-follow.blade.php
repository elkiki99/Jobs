<div class="flex items-center justify-between">
    @if (auth()->user()->id !== $user->id)
        <div class="w-32 flex justify-center">
            @if ($isFollowing)
                <x-secondary-button class="w-full text-center flex justify-center" wire:click="toggleFollow">Unfollow</x-secondary-button>
            @else
                <x-primary-button class="w-full text-center flex justify-center" wire:click="toggleFollow">Follow</x-primary-button>
            @endif
        </div>
    @endif
</div>
