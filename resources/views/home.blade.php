<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-gray-800 text-8xl">
            {{ __('Apply for the job') }}<br>
            {{ __('get hired.') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <p class="text-xl ">
            {{ __('Get recruited by the best headhunters in town blazing fast,') }}<br>
            {{ __('made for developers in a hurry.') }}
        </p>
        
        <div class="py-12">
            <p class="text-2xl text-gray-600">{{ __('Featured jobs') }}</p>
            <div class="gap-8 py-12">
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
    </div>
</x-app-layout>
