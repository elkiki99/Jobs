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
                    <form method="post" action="{{ route('openings.store') }}" class="mt-6 space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Opening title')" />
                            <x-text-input placeholder="Your opening title" id="title" name="title" type="text"
                                class="block w-full mt-1" {{-- :value="old('title', $opening->title)"  --}} required autofocus
                                autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Opening description')" />
                            <textarea rows=6 id="description" placeholder="Your opening description" name="description"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                autofocus autocomplete="description">
                                {{-- {{ old('description', $opening->description) }} --}}
                            </textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <!-- Image -->
                        <div>
                            <x-input-label for="image" :value="__('Opening image')" />
                            <x-text-input placeholder="Your image" id="image" name="image" type="file" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />

                            <!-- Image Preview -->
                            <div id="image-preview" class="hidden mt-4">
                                <x-input-label :value="__('Image preview')" />
                                <img id="preview-img" src="" alt="Image Preview"
                                    class="w-1/2 mt-2 rounded-full shadow-md md:w-1/4" />
                            </div>
                        </div>

                        <!-- Salary -->
                        <div>
                            <x-input-label for="title" :value="__('Opening title')" />
                            <x-text-input placeholder="Your opening title" id="title" name="title" type="text"
                                class="block w-full mt-1" {{-- :value="old('title', $opening->title)"  --}} required autofocus
                                autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <!-- Status -->
                        <div>
                            <x-input-label for="status" :value="__('Opening status')" />
                            <select id="status"
                                class="block w-full mt-1 text-sm font-medium text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="status" autocomplete="status">
                                <option hidden value="">Select a status</option>
                                <option value="open" {{-- {{ old('status', $user->status) == 'female' ? 'selected' : '' }} --}}>Open
                                </option>
                                <option value="closed" {{-- {{ old('status', $user->status) == 'male' ? 'selected' : '' }} --}}>Closed</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Slug -->
                        <div>
                            <x-input-label for="title" :value="__('Opening title')" />
                            <x-text-input placeholder="Your opening title" id="title" name="title" type="text"
                                class="block w-full mt-1" {{-- :value="old('title', $opening->title)"  --}} required autofocus
                                autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <!-- Category -->
                        <div>
                            <x-input-label for="category" :value="__('Opening category')" />
                            <select id="category"
                                class="block w-full mt-1 text-sm font-medium text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="category" autocomplete="category">
                                <option hidden value="">Select a category</option>
                                @foreach (App\Models\Category::all() as $category)
                                    <option value="{{ $category->name }}" {{-- {{ old('category', $user->category) == $category->name ? 'selected' : '' }} --}}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>


                        <!-- Save Button -->
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            {{-- @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                            @endif --}}
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
