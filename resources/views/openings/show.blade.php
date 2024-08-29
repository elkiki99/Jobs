<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800">
            {{ $opening->slug }}
        </h2>
    </x-slot>   

    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="gap-8 py-12">
            {{-- {{ $opening->category->name }} --}}
        </div>
    </div>
</x-app-layout>