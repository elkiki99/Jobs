<x-app-layout>
    <x-slot name="header">
        <h2 class="text-6xl font-medium leading-tight text-gray-800">
            {{ __('My C.V.') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white border sm:p-8">
                <div class="w-full">
                    @livewire('profile.cv', ['userCv' => $userCv])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
