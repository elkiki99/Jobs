<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-gray-800 text-8xl">
            {{ __('Apply for the job') }}<br>
            {{ __('get hired.') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <p class="text-xl text-gray-800">
            {{ __('Get recruited quickly by top headhunters, tailored for fast-moving developers.') }}<br>
            {{ __('Just apply and skip the lengthy forms!') }}
        </p>
        
        <div class="py-12">
            <p class="text-2xl text-gray-600">{{ __('Featured openings') }}</p>
            <div class="gap-8 py-12">
                @forelse(App\Models\Opening::take(4)->get() as $opening)
                    <x-opening-card :opening="$opening"  />
                @empty
                    <p>No openings found.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
