<x-app-layout>
    <x-slot name="header">
        <h2 class="text-6xl font-medium leading-tight text-gray-800">
            {{ __('Network') }}
        </h2>
    </x-slot>

    <livewire:users.show-users />
</x-app-layout>
