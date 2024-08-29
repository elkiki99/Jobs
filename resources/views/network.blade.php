<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800">
            {{ __('Network') }}
        </h2>
    </x-slot>   

    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <p class="text-2xl">{{ __('Get discovered by headhunters') }}</p>
        
        <div class="gap-8 py-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 sm:grid">
            {{-- @forelse($recruiters as $recruiter) --}}
                <x-recruiter-card 
                {{-- :recruiter="$recruiter"  --}}
                />
                <x-recruiter-card 
                    {{-- :recruiter="$recruiter"  --}}
                />
                <x-recruiter-card 
                    {{-- :recruiter="$recruiter"  --}}
                />
                <x-recruiter-card 
                    {{-- :recruiter="$recruiter"  --}}
                />
            {{-- @empty
                <p>No recruiters found.</p>
            @endforelse --}}
        </div>
    </div>
</x-app-layout>