<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800">
            {{ $opening->title }}
        </h2>
    </x-slot>   

    <div class="flex flex-col-reverse gap-8 px-4 py-12 mx-auto md:flex-row sm:px-6 lg:px-8 max-w-7xl">
        <div class="w-full space-y-2 md:w-1/2">
            <p class="text-xl font-semibold">{{ $opening->title }}</p>
            <p>{{ $opening->description }}</p>
            <p><span class="font-semibold">Location:</span> {{ $opening->location }}</p>
            <p><span class="font-semibold">Offer:</span> {{ Illuminate\Support\Number::currency($opening->salary, 'USD') }}</p>
            <div class="flex items-center gap-2">
                <p class="font-semibold">Company: </p>
                <a class="text-sm hover:underline" href="#">{{ $opening->user->company->name }}</a>
            </div>
            <div class="flex items-center gap-2">
                <p class="font-semibold">Category: </p>
                <a href="{{ route('categories.show', $opening->category->slug) }}" class="text-sm hover:underline">{{ $opening->category->name }}</a>
            </div>
            <div class="flex items-center gap-2">
                <p class="font-semibold">Posted by: </p>
                <a href="{{ route('users.show', $opening->user->username )}}" class="text-sm hover:underline">{{ $opening->user->name }}</a>
            </div>
            <p><span class="font-semibold">Status:</span> {{ $opening->status }}</p>
            
            <div class="pt-4">
                <x-primary-button>Apply</x-primary-button>
            </div>
        </div>
        <div class="w-full md:w-1/2">
            <img src="{{ $opening->image }}" alt="{{ $opening->name }}">
        </div>
    </div>
</x-app-layout>
