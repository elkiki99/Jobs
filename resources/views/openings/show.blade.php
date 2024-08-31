<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800">
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
                <a href="{{ route('companies.show', $opening->user->company->slug) }}" class="text-sm hover:underline"
                    href="#">{{ $opening->user->company->name }}</a>
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

            @auth
                @if (auth()->user()->role === 'developer')
                    <div class="pt-4">
                        @if (!auth()->user()->appliedOpenings()->where('opening_id', $opening->id)->exists())
                            <form method="POST" action="{{ route('openings.show', $opening->slug) }}">
                                @csrf
                                <x-primary-button type="submit" aria-label="Apply to this opening">Apply</x-primary-button>
                            </form>
                        @else
                            <p class="text-green-500 underline">Congrats! You have applied to this opening</p>
                        @endif
                    </div>
                @endif
            @else
                <div class="pt-4">
                    <a href="{{ route('login') }}" class="underline">Login to apply</a>
                </div>
            @endauth
        </div>
        <div class="w-full md:w-1/2">
            <img src="{{ $opening->image }}" alt="{{ $opening->name }}">
        </div>
    </div>
</x-app-layout>
