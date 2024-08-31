<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl space-y-6 sm:px-6 lg:px-8">
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
    </div>
</x-app-layout>
