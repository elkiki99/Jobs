<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800 sm:text-6xl">
            {{ __('My C.V.') }}
        </h2>
    </x-slot>

    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <p class="pb-12 text-lg text-gray-600 sm:text-2xl">{{ __('Update my C.V.') }}</p>

        <div class="p-4 bg-white border sm:p-8">
            <div class="w-full">
                @livewire('cv.cv-form', ['userCv' => $userCv])
            </div>
        </div>
    </div>
</x-app-layout>
