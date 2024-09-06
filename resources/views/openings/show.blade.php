<x-app-layout>
    <x-slot name="header">
        <h2 class="text-6xl font-medium leading-tight text-gray-800">
            {{ $opening->title }}
        </h2>
    </x-slot>

    <div class="flex flex-col-reverse gap-8 px-4 py-12 mx-auto md:flex-row sm:px-6 lg:px-8 max-w-7xl">
        <div class="w-full space-y-2 md:w-1/2">

            @if (session('applied_success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="mb-4 text-green-600">
                    {{ session('applied_success') }}
                </div>
            @endif

            <p class="text-xl font-semibold">{{ $opening->title }}</p>
            <p>{{ $opening->description }}</p>
            <p><span class="font-semibold">Location:</span> {{ $opening->location }}</p>
            <p><span class="font-semibold">Offer:</span>
                {{ Illuminate\Support\Number::currency($opening->salary, 'USD') }}</p>
            <div class="flex items-center gap-2">
                <p class="font-semibold">Company: </p>
                <a href="{{ route('companies.show', $opening->user->company->slug) }}" class="text-sm hover:underline">
                    {{ $opening->user->company->name }}
                </a>
            </div>
            <div class="flex items-center gap-2">
                <p class="font-semibold">Category: </p>
                <a href="{{ route('categories.show', $opening->category->slug) }}"
                    class="text-sm hover:underline">{{ $opening->category->name }}</a>
            </div>
            <div class="flex items-center gap-2">
                <p class="font-semibold">Posted by: </p>
                <a href="{{ route('users.show', $opening->user->username) }}"
                    class="text-sm hover:underline">{{ $opening->user->name }}
                </a>
            </div>
            <p><span class="font-semibold">Status:</span> {{ $opening->status }}</p>

            <livewire:openings.apply-to-opening :slug="$opening->slug" />
        </div>
        <div class="w-full md:w-1/2">
            @if ($opening->image)
                <img class="aspect-square object-cover"
                    src="{{ Str::startsWith($opening->image, ['http://', 'https://']) ? $opening->image : asset('storage/' . $opening->image) }}"
                    alt="{{ $opening->name }}">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="text-gray-500 aspect-square">
                    <path fill-rule="evenodd"
                        d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                        clip-rule="evenodd" />
                </svg>
            @endif
        </div>
    </div>
</x-app-layout>
