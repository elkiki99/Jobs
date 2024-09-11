<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800 sm:text-6xl">
            {{ __('New company') }}
        </h2>
    </x-slot>

    <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
        <p class="pb-12 text-lg text-gray-600 sm:text-2xl">Create a new company</p>

        <div class="p-4 bg-white border sm:p-8">
            <div class="w-full">
                <form method="post" action="{{ route('companies.store') }}" class="mt-6 space-y-6"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Company name *')" />
                        <x-text-input placeholder="Your company name" id="name" name="name" type="text"
                            class="block w-full mt-1" :value="old('name')" autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Company email *')" />
                        <x-text-input placeholder="Your company email" id="email" name="email" type="email"
                            class="block w-full mt-1" :value="old('email')" autofocus autocomplete="email" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <!-- Address -->
                    <div>
                        <x-input-label for="address" :value="__('Company address *')" />
                        <x-text-input placeholder="Your company address" id="address" name="address"
                            type="text" class="block w-full mt-1" :value="old('address')" autofocus
                            autocomplete="address" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="sm:gap-2 sm:flex">
                        <!-- Country -->
                        <div class="w-full sm:w-1/2">
                            <x-input-label for="country" :value="__('Company country *')" />
                            <select id="country"
                                class="block w-full mt-1 text-sm font-medium text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                name="country" autocomplete="country">
                                <option hidden value="">Select a country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country['name'] }}"
                                        {{ old('country') == $country['name'] ? 'selected' : '' }}>
                                        {{ $country['name'] }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>

                        <!-- City -->
                        <div class="w-full sm:w-1/2">
                            <x-input-label for="city" :value="__('Company city *')" />
                            <x-text-input placeholder="Your company city" id="city" name="city"
                                type="text" class="block w-full mt-1" :value="old('city')" autofocus
                                autocomplete="city" />
                            <x-input-error class="mt-2" :messages="$errors->get('city')" />
                        </div>
                    </div>

                    <div class="sm:gap-2 sm:flex">
                        <!-- Postcode -->
                        <div class="w-full sm:w-1/2">
                            <x-input-label for="postcode" :value="__('Company postcode *')" />
                            <x-text-input placeholder="Your company postcode" id="postcode" name="postcode"
                                type="number" class="block w-full mt-1" :value="old('postcode')" autofocus
                                autocomplete="postcode" />
                            <x-input-error class="mt-2" :messages="$errors->get('postcode')" />
                        </div>

                        <!-- Industry -->
                        <div class="w-full sm:w-1/2">
                            <x-input-label for="industry" :value="__('Company industry *')" />
                            <x-text-input placeholder="Your company industry" id="industry" name="industry"
                                type="text" class="block w-full mt-1" :value="old('industry')" autofocus
                                autocomplete="industry" />
                            <x-input-error class="mt-2" :messages="$errors->get('industry')" />
                        </div>
                    </div>

                    <div class="sm:gap-2 sm:flex">
                        <!-- Phone -->
                        <div class="w-full sm:w-1/2">
                            <x-input-label for="phone" :value="__('Company phone')" />
                            <x-text-input placeholder="Your company phone" id="phone" name="phone"
                                type="number" class="block w-full mt-1" :value="old('phone')" autofocus
                                autocomplete="phone" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <!-- Foundation -->
                        <div class="w-full sm:w-1/2">
                            <x-input-label for="founded" :value="__('Company foundation')" />
                            <x-text-input placeholder="Your company foundation year" id="founded" name="founded"
                                type="date" class="block w-full mt-1" :value="old('founded')" autofocus
                                autocomplete="founded" />
                            <x-input-error class="mt-2" :messages="$errors->get('founded')" />
                        </div>
                    </div>

                    <div class="sm:gap-2 sm:flex">
                        <!-- Website -->
                        <div class="w-full sm:w-1/2">
                            <x-input-label for="website" :value="__('Company website')" />
                            <x-text-input placeholder="Your company website" id="website" name="website"
                                type="url" class="block w-full mt-1" :value="old('website')" autofocus
                                autocomplete="website" />
                            <x-input-error class="mt-2" :messages="$errors->get('website')" />
                        </div>

                        <!-- Revenue -->
                        <div class="w-full sm:w-1/2">
                            <x-input-label for="revenue" :value="__('Company revenue')" />
                            <x-text-input placeholder="Your company foundation year" id="revenue"
                                name="revenue" type="number" class="block w-full mt-1" :value="old('revenue')"
                                autofocus autocomplete="revenue" />
                            <x-input-error class="mt-2" :messages="$errors->get('revenue')" />
                        </div>
                    </div>

                    <!-- Employees -->
                    <div class="w-full sm:w-1/2">
                        <x-input-label for="employees" :value="__('Company employees')" />
                        <x-text-input placeholder="Your company foundation year" id="employees" name="employees"
                            type="number" class="block w-full mt-1" :value="old('employees')" autofocus
                            autocomplete="employees" />
                        <x-input-error class="mt-2" :messages="$errors->get('employees')" />
                    </div>

                    <!-- Logo -->
                    <div>
                        <x-input-label for="logo" :value="__('Company logo')" />
                        <x-text-input placeholder="Your company logo" id="logo" name="logo" type="file" />
                        <x-input-error class="mt-2" :messages="$errors->get('logo')" />

                        <!-- Logo Preview -->
                        <div id="logo-preview" class="hidden mt-4">
                            <x-input-label :value="__('Logo preview')" />
                            <img id="preview-img" src="" alt="Logo Preview"
                                class="w-1/2 mt-2 rounded-full shadow-md md:w-1/4" />
                        </div>
                    </div>

                    <!-- Bio -->
                    <div class="mb-4">
                        <x-input-label for="bio" :value="__('Company bio')" />
                        <div>
                            <textarea id="bio" name="bio" placeholder="Tell us about this company!">{{ old('bio') }}</textarea>
                        </div>

                        <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                    </div>

                    <!-- Slug -->
                    <div>
                        <x-input-label for="slug" :value="__('Company slug *')" />
                        <x-text-input placeholder="Your company slug" id="slug" name="slug"
                            type="text" class="block w-full mt-1" :value="old('slug')" autofocus
                            autocomplete="slug" />
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

    <!-- JavaScript for handling file input and preview -->
    <script>
        document.getElementById('logo').addEventListener('change', function(event) {
            const input = event.target;
            const preview = document.getElementById('logo-preview');
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
        ClassicEditor.create(document.querySelector('#bio'))
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>
