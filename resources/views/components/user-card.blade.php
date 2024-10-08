<div class="w-full max-w-4xl mx-auto mt-10 overflow-hidden bg-white border" wire:remove
    wire:key="user-{{ $user->id }}" wire:target='userFollowed,{{ $user->id }}'>
    <div class="relative w-full">
        <a wire:navigate href="{{ route('users.show', $user->username) }}">
            @if ($user->avatar)
                <img loading="lazy" class="object-cover w-full h-auto aspect-square"
                    src="{{ Str::startsWith($user->avatar, ['http://', 'https://']) ? $user->avatar : Storage::disk('s3')->url($user->avatar) }}"
                    alt="{{ $user->name }}">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="object-cover w-full h-auto text-gray-500 aspect-square">
                    <path fill-rule="evenodd"
                        d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                        clip-rule="evenodd" />
                </svg>
            @endif
        </a>
    </div>

    <div class="p-4 space-y-2">
        @if ($user->role === 'recruiter')
            <div class="flex items-center gap-2">
                <h3 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h3>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-6 h-6 text-blue-500">
                    <path fill-rule="evenodd"
                        d="M8.603 3.799A4.49 4.49 0 0 1 12 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 0 1 3.498 1.307 4.491 4.491 0 0 1 1.307 3.497A4.49 4.49 0 0 1 21.75 12a4.49 4.49 0 0 1-1.549 3.397 4.491 4.491 0 0 1-1.307 3.497 4.491 4.491 0 0 1-3.497 1.307A4.49 4.49 0 0 1 12 21.75a4.49 4.49 0 0 1-3.397-1.549 4.49 4.49 0 0 1-3.498-1.306 4.491 4.491 0 0 1-1.307-3.498A4.49 4.49 0 0 1 2.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 0 1 1.307-3.497 4.49 4.49 0 0 1 3.497-1.307Zm7.007 6.387a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        @else
            <h3 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h3>
        @endif
        <p class="text-gray-600">{{ $user->email }}</p>

        <div class="flex items-center justify-between pt-4">
            <a wire:navigate href="{{ route('users.show', $user->username) }}" class="text-sm hover:underline">View
                Profile</a>
            @auth
                <livewire:users.toggle-follow :user="$user" :key="$user->id" />
            @endauth
        </div>
    </div>
</div>
