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
                    <form method="post" action="{{ route('categories.store') }}" class="mt-6 space-y-6">
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
                        <div>
                            <x-input-label for="description" :value="__('Bio')" />
                            <textarea rows=6 id="description" placeholder="Category description" name="description"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                autofocus autocomplete="description">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <!-- Slug -->
                        <div>
                            <x-input-label for="slug" :value="__('Category slug')" />
                            <x-text-input placeholder="Your opening slug" id="slug" name="slug" type="text"
                                class="block w-full mt-1" :value="old('slug')" autofocus autocomplete="slug" />
                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
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