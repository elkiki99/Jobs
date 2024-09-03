<x-app-layout>
    <x-slot name="header">
        <h2 class="text-6xl font-medium leading-tight text-gray-800">
            {{ __('My applications') }}
        </h2>
    </x-slot>   

    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <p class="text-2xl text-gray-600">{{ __('Listing of my job applications') }}</p>
        
        <div class="gap-8 py-12">
            @forelse($openings as $opening)
                <x-opening-card :opening="$opening" />
            @empty
                <p>No openings found.</p>
            @endforelse
        </div>

        {{ $openings->links() }}
    </div>
</x-app-layout>