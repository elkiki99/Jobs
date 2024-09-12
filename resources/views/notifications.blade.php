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
                <x-user-followed-notification :notification="$notification" />
                
                <x-applied-to-opening-notification :notification="$notification" />
            @empty
                <p class="text-gray-600">You have no notifications.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $notifications->links() }}
        </div>
    </div>
</x-app-layout>
