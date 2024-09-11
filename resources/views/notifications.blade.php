<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800 sm:text-6xl">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <p class="pb-12 text-lg text-gray-600 sm:text-2xl">{{ __('Manage your notifications') }}</p>
        
        <div>
            @forelse ($notifications as $notification)
                <div
                    class="p-5 mb-4 border flex justify-between items-start {{ $notification->read_at ? 'border-gray-200 bg-white' : 'border-blue-300 bg-blue-50' }} notification-item transition duration-300 ease-in-out">
                        <!-- Avatar -->
                        <div class="mr-5">
                            @if ($notification->data['candidate_avatar']['avatar'])
                                <img class="object-cover rounded-full size-12 sm:size-24 aspect-square"
                                    src="{{ Str::startsWith($notification->data['candidate_avatar']['avatar'], ['http://', 'https://']) ? $notification->data['candidate_avatar']['avatar'] : asset('storage/' . $notification->data['candidate_avatar']['avatar']) }}"
                                    alt="{{ $notification->data['candidate_username'] }}">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="text-gray-500 rounded-full size-12 sm:size-24 aspect-square">
                                    <path fill-rule="evenodd"
                                        d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                        
                        <div class="flex-1">
                            <p class="text-xs text-gray-700 md:text-lg">
                                {{ $notification->data['message'] }}
                            </p>
                            <div class="flex items-center gap-6 mt-3 text-sm text-gray-500">
                                <span class="flex items-center gap-2">
                                    <!-- Icon calendar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                    </svg>
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <div class="flex gap-4 mt-4">
                                <a wire:navigate href="{{ route('openings.show', $notification->data['opening_slug']) }}"
                                    class="text-sm text-blue-500 md:text-lg hover:underline">
                                    View opening
                                </a>
                                <a wire:navigate href="{{ route('users.show', $notification->data['candidate_username']) }}"
                                    class="text-sm text-blue-500 md:text-lg hover:underline">
                                    View user
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 ">You have no notifications.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $notifications->links() }}
        </div>
    </div>
</x-app-layout>
