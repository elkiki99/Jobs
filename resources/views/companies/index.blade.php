<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800 sm:text-6xl">
            {{ __('My companies') }}
        </h2>
    </x-slot>

    <div class="gap-8 px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <p class="pb-12 text-lg text-gray-600 sm:text-2xl">Listing of my companies</p>

        <div class="flex">
            <a wire:navigate class="flex w-1/3 py-1 underline" href="{{ route('companies.create') }}">
                New company
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ml-1 size-5">
                    <path fill-rule="evenodd"
                        d="M8.25 3.75H19.5a.75.75 0 0 1 .75.75v11.25a.75.75 0 0 1-1.5 0V6.31L5.03 20.03a.75.75 0 0 1-1.06-1.06L17.69 5.25H8.25a.75.75 0 0 1 0-1.5Z"
                        clip-rule="evenodd" />
                </svg>
            </a>

            <div class="w-2/3 space-y-2">
                @forelse($companies as $company)
                    <div class="flex flex-col md:flex-row md:items-start">
                        <a wire:navigate href="{{ route('companies.show', $company->slug) }}">
                            @if ($company->logo)
                                <img loading="lazy" class="w-24 h-24 mb-2 mr-5 border rounded-full"
                                    src="{{ $company->logo ? (Str::startsWith($company->logo, ['http://', 'https://']) ? $company->logo : Storage::disk('s3')->url($company->logo)) : 'path/to/default/image.png' }}"
                                    alt="{{ $company->name }}">
                            @else
                                <img loading="lazy" class="w-24 h-24 mb-2 mr-5 border rounded-full"
                                    src="{{ asset('images/no-image.png') }}" alt="{{ $company->name }}">
                            @endif
                        </a>
                        <div class="flex-grow">
                            <p class="mt-2 font-medium">{{ $company->name }}</p>
                            <p class="mt-2 text-sm">{{ $company->email }}</p>
                            <p class="mt-2 text-sm">{{ $company->city }}</p>
                        </div>
                        <a wire:navigate href="{{ route('companies.edit', $company->slug) }}"
                            class="mt-2 md:mt-0 md:ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </a>
                    </div>
                @empty
                    <p>No companies found.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
