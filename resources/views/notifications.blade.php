<x-app-layout>
    <x-slot name="header">
        <h2 class="text-6xl font-medium leading-tight text-gray-800">
            {{ __('Notifications') }}
        </h2>
    </x-slot>   

    <div class="gap-8 px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        @forelse ($notifications as $notification)
            <div class="p-4 mb-4 border rounded-md {{ $notification->read_at ? 'border-gray-200 bg-white' : 'border-green-200 bg-green-50' }} notification-item">
                <p>{{ $notification->data['message'] }}</p>
                <div class="flex items-center gap-5">
                    <a href="{{ route('openings.show', $notification->data['opening_slug']) }}" class="text-blue-500 hover:underline">
                        View opening
                    </a>
                    <a href="{{ route('users.show', $notification->data['candidate_username']) }}" class="text-blue-500 hover:underline">
                        View user
                    </a>
                </div>
            </div>
        @empty
            <p>No notifications</p>
        @endforelse
    </div>
</x-app-layout>