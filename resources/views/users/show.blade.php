<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800">
            {{ $user->name }}
        </h2>
    </x-slot>  

    <div class="flex gap-8 px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="w-1/3 space-y-2">
            <img class="rounded-full size-36 aspect-square" src="{{ $user->avatar }}" alt="{{ $user->username }}">
            <p class="text-2xl">{{ $user->username }}</p>
            <p class="text-gray-600">{{ $user->email }}</p>   
            <p>{{ $user->bio }}</p>	
            <p>{{ $user->phone }}</p>
            <p>{{ $user->address }}</p>
            <p>{{ $user->city }}, {{ $user->country }}</p>
        </div>    

        <div class="w-2/3 space-y-2">
            @foreach ($user->opening as $opening)
                <x-opening-card :opening="$opening" />
            @endforeach
        </div>
    </div>
</x-app-layout>