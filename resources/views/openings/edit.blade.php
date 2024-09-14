<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800 sm:text-6xl">
            {{ __('Edit opening') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
        <p class="pb-12 text-lg text-gray-600 sm:text-2xl">Edit opening {{ $opening->name }}</p>
            <div class="p-4 bg-white border sm:p-8">
                <div class="w-full">
                    <form method="post" action="{{ route('openings.update', $opening->slug) }}"
                        enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Opening title *')" />
                            <x-text-input placeholder="Your opening title" id="title" name="title" type="text"
                                class="block w-full mt-1" :value="old('title', $opening->title)" autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Profile description *')" />
                            <div>
                                <textarea id="description" name="description" placeholder="Tell us your story!">{{ old('description', $opening->description) }}</textarea>
                            </div>

                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Image -->
                        <div>
                            @if ($opening->image)
                                <div class="mt-4">
                                    <x-input-label :value="__('Current Image *')" />
                                    <img 
                                        {{-- src="{{ asset('storage/' . $opening->image) }}"  --}}
                                        alt="Current image"
                                        src="{{ Str::startsWith($opening->avatar, ['http://', 'https://']) ? $opening->avatar : Storage::disk('s3')->url($opening->avatar) }}"
                                        class="w-full mt-2 shadow-md md:w-1/2" />
                                </div>
                            @endif

                            <div class="mt-4">
                                <x-input-label for="image" :value="__('Opening image')" />
                                <x-text-input placeholder="Your image" id="image" name="image" type="file" />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <!-- Image Preview -->
                            <div id="image-preview" class="hidden mt-4">
                                <x-input-label :value="__('Image preview')" />
                                <img id="preview-img" src="" alt="Image preview"
                                    class="w-full mt-2 shadow-md md:w-1/2" />
                            </div>
                        </div>

                        <!-- Salary -->
                        <div>
                            <x-input-label for="salary" :value="__('Opening salary *')" />
                            <x-text-input placeholder="Your opening salary" id="salary" name="salary" type="number"
                                class="block w-full mt-1" :value="old('salary', $opening->salary)" autofocus autocomplete="salary" />
                            <x-input-error class="mt-2" :messages="$errors->get('salary')" />
                        </div>

                        <!-- Location -->
                        <div>
                            <x-input-label for="location" :value="__('Location *')" />
                            <select id="location"
                                class="block w-full mt-1 text-sm font-medium text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="location" autocomplete="location">
                                <option hidden value="">Select a country</option>
                                @foreach ($countries as $location)
                                    <option value="{{ $location['name'] }}"
                                        {{ old('location', $opening->location) == $location['name'] ? 'selected' : '' }}>
                                        {{ $location['name'] }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>


                        <!-- Company -->
                        <div>
                            <x-input-label for="company_id" :value="__('Opening company *')" />
                            <select id="company_id"
                                class="block w-full mt-1 text-sm font-medium text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="company_id" autocomplete="company_id">
                                <option hidden value="">Select a company</option>
                                @foreach (App\Models\Company::all() as $company)
                                    <option value="{{ $company->id }}"
                                        {{ old('company_id', $opening->company_id) == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('company_id')" class="mt-2" />

                            {{-- <a class="flex items-center justify-end mt-4 text-sm font-medium text-gray-600"
                                href="{{ route('companies.create') }}">
                                <p>Create category</p>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            </a> --}}
                        </div>

                        <!-- Slug -->
                        <div>
                            <x-input-label for="slug" :value="__('Opening slug *')" />
                            <x-text-input placeholder="Your opening slug" id="slug" name="slug" type="text"
                                class="block w-full mt-1" :value="old('slug', $opening->slug)" autofocus autocomplete="slug" />
                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                        </div>

                        <!-- Category -->
                        <div>
                            <x-input-label for="category_slug" :value="__('Opening category *')" />
                            <select id="category_slug"
                                class="block w-full mt-1 text-sm font-medium text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="category_slug" autocomplete="category_slug">
                                <option hidden value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category['slug'] }}"
                                        {{ old('category_slug', $opening->category()->slug) == $category['slug'] ? 'selected' : '' }}>
                                        {{ $category['name'] }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_slug')" class="mt-2" />
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

    <!-- JavaScript for handling file input and preview -->
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');
            const img = document.getElementById('preview-img');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.add('hidden');
            }
        });
    </script>

    <!-- CKEditor -->
    <script>
        ClassicEditor.create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>
