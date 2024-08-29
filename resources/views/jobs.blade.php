<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800">
            {{ __('Jobs') }}
        </h2>
    </x-slot>   

    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <p class="text-2xl">{{ __('Last job openings') }}</p>
        
        <div class="grid grid-cols-4 gap-8 py-12">
            {{-- @forelse($jobs as $job) --}}
                <x-job-card 
                    {{-- :job="$job"  --}}
                />
                <x-job-card 
                    {{-- :job="$job"  --}}
                />
                <x-job-card 
                    {{-- :job="$job"  --}}
                />
                <x-job-card 
                    {{-- :job="$job"  --}}
                />
            {{-- @empty
                <p>No jobs found.</p>
            @endforelse --}}
        </div>
    </div>
</x-app-layout>