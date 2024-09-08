<x-app-layout>
    <x-slot name="header">
        <h2 class="text-6xl font-medium leading-tight text-gray-800">
            {{ __('New opening') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white border sm:p-8">
                <div class="w-full">
                    <form method="post" action="{{ route('categories.store') }}" class="mt-6 space-y-6"
                        {{-- enctype="multipart/form-data"> --}}
                        @csrf
                        <!-- Title -->
                        <div>
                            <x-input-label for="name" :value="__('Category name')" />
                            <x-text-input placeholder="Your opening name" id="name" name="name" type="text"
                                class="block w-full mt-1" :value="old('name')" autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="slug" :value="__('Category slug')" />
                            <div>
                                <textarea id="slug" name="slug" placeholder="Tell us your story!">{{ old('slug') }}</textarea>
                            </div>

                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                        </div>

                        <!-- Slug -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Category description')" />
                            <div>
                                <textarea id="description" name="description" placeholder="Tell us your story!">{{ old('description') }}</textarea>
                            </div>

                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Save Button -->
                        <div class="flex items-center gap-4">
                            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</x-app-layout>