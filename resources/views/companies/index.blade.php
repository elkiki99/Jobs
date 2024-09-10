<x-app-layout>
    <x-slot name="header">
        <h2 class="text-6xl font-medium leading-tight text-gray-800">
            {{ __('My companies') }}
        </h2>
    </x-slot>

    <div class="flex gap-8 px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="w-1/3 space-y-2 ">
            @forelse($companies as $company)
                <a href="{{ route('companies.show', $company->slug) }}">
                    <div class="flex flex-col items-center justify-center text-center">
                        <img loading="lazy" class="w-24 h-24 border rounded-full" src="{{ Str::startsWith($company->logo, ['http://', 'https://']) ? $company->logo : asset('storage/' . $company->logo) }}"
                            alt="{{ $company->name }}">
                        <p class="flex-grow mt-2 font-medium">{{ $company->name }}</p>
                    </div>
                </a>
            @empty
                <p>No companies found.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
