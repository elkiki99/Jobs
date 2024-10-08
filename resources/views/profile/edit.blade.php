<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800 sm:text-6xl">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    
    <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
        <p class="pb-12 text-lg text-gray-600 sm:text-2xl">Edit your profile</p>

        <div class="p-4 bg-white border sm:p-8">
            <div class="w-full">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 bg-white border sm:p-8">
            <div class="w-full">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 bg-white border sm:p-8">
            <div class="w-full">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
