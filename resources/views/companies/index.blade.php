<x-app-layout>
    <x-slot name="header">
        <h2 class="text-6xl font-medium leading-tight text-gray-800">
            {{ __('My companies') }}
        </h2>
    </x-slot>

    <div class="flex gap-8 px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <a class="w-1/3 flex py-1 underline" href="{{ route('companies.create') }}">
            New company
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ml-1 size-5">
                <path fill-rule="evenodd"
                    d="M8.25 3.75H19.5a.75.75 0 0 1 .75.75v11.25a.75.75 0 0 1-1.5 0V6.31L5.03 20.03a.75.75 0 0 1-1.06-1.06L17.69 5.25H8.25a.75.75 0 0 1 0-1.5Z"
                    clip-rule="evenodd" />
            </svg>
        </a>

        <div class="w-2/3 space-y-2">
            @forelse($companies as $company)
                <div class="flex flex-col">
                    <a href="{{ route('companies.show', $company->slug) }}">
                        <img loading="lazy" class="w-24 h-24 border rounded-full"
                            src="{{ Str::startsWith($company->logo, ['http://', 'https://']) ? $company->logo : asset('storage/' . $company->logo) }}"
                            alt="{{ $company->name }}">
                    </a>
                    <p class="flex-grow mt-2 font-medium">{{ $company->name }}</p>
                </div>
            @empty
                <p>No companies found.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
