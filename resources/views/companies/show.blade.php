<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800">
            {{ $company->name }}
        </h2>
    </x-slot>  

    <div class="flex gap-8 px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="w-1/3 space-y-2">
            <img class="rounded-full size-36 aspect-square" src="{{ $company->logo }}" alt="{{ $company->name }}">
            <p class="text-gray-600">{{ $company->email }}</p>   
            <p class="">{{ $company->bio }}</p>	
            <p>{{ $company->phone }}</p>
            <p>{{ $company->address }}</p>
            <p>{{ $company->city }}, {{ $company->country }}</p>
        </div>    

        <div class="w-2/3 space-y-2">
            @foreach ($company->openings as $opening)
                <x-opening-card :opening="$opening" />
            @endforeach
        </div>
    </div>
</x-app-layout>