<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800 sm:text-6xl">
            {{ __('Following') }}
        </h2>
    </x-slot>

    <livewire:users.show-following />
</x-app-layout>
