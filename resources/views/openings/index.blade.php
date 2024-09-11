<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800 sm:text-6xl">
            @if (isset($categoryName))
                {{ __(':category', ['category' => $categoryName]) }}
            @else
                {{ __('Job openings') }}
            @endif
        </h2>
    </x-slot>

    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        @if (isset($categoryName))
            <p class="text-lg text-gray-600 sm:text-2xl">
                {{ __('Last job openings in :category', ['category' => $categoryName]) }}</p>
        @else
            <p class="text-lg text-gray-600 sm:text-2xl">{{ __('Last job openings') }}</p>
        @endif

        <div class="gap-8 py-12">
            @forelse($openings as $opening)
                <x-opening-card :opening="$opening" />
            @empty
                <p>No openings found.</p>
            @endforelse
        </div>

        <div class="max-w-4xl">
            {{ $openings->links() }}
        </div>
    </div>
</x-app-layout>
