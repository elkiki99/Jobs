<x-app-layout>
    <x-slot name="header">
        <h2 class="text-6xl font-medium leading-tight text-gray-800">
            {{ __('Edit opening ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white border sm:p-8">
                <div class="w-full">
                    <form method="post" action="{{ route('openings.update', $opening->slug) }}"
                        enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        {{-- @method('PUT')  --}}

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Opening title')" />
                            <x-text-input placeholder="Your opening title" id="title" name="title" type="text"
                                class="block w-full mt-1" :value="old('title', $opening->title)" autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Opening description')" />
                            <textarea rows=6 id="description" placeholder="Your opening description" name="description"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                autofocus autocomplete="description">{{ $opening->description }}</textarea>

                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <!-- Image -->
                        <div>
                            @if ($opening->image)
                                <div class="mt-4">
                                    <x-input-label :value="__('Current Image')" />
                                    <img src="{{ asset('storage/' . $opening->image) }}" alt="Current Image"
                                        class="w-full mt-2 shadow-md md:w-1/2" />
                                </div>
                            @endif
                            <x-input-label for="image" :value="__('Opening image')" />
                            <x-text-input placeholder="Your image" id="image" name="image" type="file" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />

                            <!-- Image Preview -->
                            <div id="image-preview" class="hidden mt-4">
                                <x-input-label :value="__('Image preview')" />
                                <img id="preview-img" src="" alt="Image Preview"
                                    class="w-full mt-2 shadow-md md:w-1/2" />
                            </div>
                        </div>

                        <!-- Salary -->
                        <div>
                            <x-input-label for="salary" :value="__('Opening salary')" />
                            <x-text-input placeholder="Your opening salary" id="salary" name="salary" type="number"
                                class="block w-full mt-1" :value="old('salary', $opening->salary)" autofocus autocomplete="salary" />
                            <x-input-error class="mt-2" :messages="$errors->get('salary')" />
                        </div>

                        <!-- Location -->
                        <div>
                            <x-input-label for="location" :value="__('Location')" />
                            <select id="location"
                                class="block w-full mt-1 text-sm font-medium text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="location" autocomplete="location">
                                <option hidden value="">Select a country</option>
                                @foreach (Pranpegu\LaravelCountries\Countries::all() as $location)
                                    <option value="{{ $location['name'] }}"
                                        {{ old('location', $opening->location) == $location['name'] ? 'selected' : '' }}>
                                        {{ $location['name'] }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div>
                            <x-input-label for="status" :value="__('Opening status')" />
                            <select id="status"
                                class="block w-full mt-1 text-sm font-medium text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="status" autocomplete="status">
                                <option hidden value="">Select a status</option>
                                <option value="open"
                                    {{ old('status', $opening->status) == 'open' ? 'selected' : '' }}>Open
                                </option>
                                <option value="closed"
                                    {{ old('status', $opening->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Slug -->
                        <div>
                            <x-input-label for="slug" :value="__('Opening slug')" />
                            <x-text-input placeholder="Your opening slug" id="slug" name="slug" type="text"
                                class="block w-full mt-1" :value="old('slug', $opening->slug)" autofocus autocomplete="slug" />
                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                        </div>

                        <!-- Category -->
                        <div>
                            <x-input-label for="category_id" :value="__('Opening category')" />
                            <select id="category_id"
                                class="block w-full mt-1 text-sm font-medium text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="category_id" autocomplete="category_id">
                                <option hidden value="">Select a category</option>
                                @foreach (App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $opening->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
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
</x-app-layout>
