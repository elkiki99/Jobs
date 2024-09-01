<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-gray-800 text-8xl">
            {{ __('Apply for the job') }}<br>
            {{ __('get hired.') }}
        </h2>
    </x-slot>

    <div class="px-6 mx-auto max-w-7xl lg:px-8">
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
        
        <div class="py-12">
            <p class="text-2xl text-gray-600">{{ __('Featured recruiters') }}</p>
            <div class="gap-8 py-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 sm:grid">
                @forelse(App\Models\User::where('role', 'recruiter')->take(8)->get() as $user)
                    <x-user-card :user="$user"  />
                @empty
                    <p>No recruiters found.</p>
                @endforelse
            </div>
        </div>

        <div class="py-12">
            <p class="text-2xl text-gray-600">{{ __('Featured companies') }}</p>
            <div class="gap-8 py-12 sm:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 sm:grid">
                @forelse(App\Models\Company::take(8)->get() as $company)
                    <div class="flex flex-col items-center justify-center text-center">
                        <img class="w-24 h-24 border rounded-full " src="{{ $company->logo }}" alt="{{ $company->name }}">
                        <p class="flex-grow mt-2 font-medium">{{ $company->name }}</p>
                    </div>
                @empty
                    <p>No companies found.</p>
                @endforelse
            </div>
        </div>
        
    </div>
</x-app-layout>
