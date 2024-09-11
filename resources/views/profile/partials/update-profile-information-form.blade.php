<section>
    <header>
        <div class="flex gap-2">
            <!-- Avatar -->
            @if ($user->avatar)
                <img class="rounded-full size-16 aspect-square"
                    src="{{ Str::startsWith($user->avatar, ['http://', 'https://']) ? $user->avatar : asset('storage/' . $user->avatar) }}"
                    alt="{{ $user->username }}">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="text-gray-500 rounded-full size-16 aspect-square">
                    <path fill-rule="evenodd"
                        d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                        clip-rule="evenodd" />
                </svg>
            @endif

            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Profile Information') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __("Update your account's profile information and email address.") }}
                </p>
            </div>

            <a wire:navigate href="{{ route('users.show', $user->username) }}" class="ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M8.25 3.75H19.5a.75.75 0 0 1 .75.75v11.25a.75.75 0 0 1-1.5 0V6.31L5.03 20.03a.75.75 0 0 1-1.06-1.06L17.69 5.25H8.25a.75.75 0 0 1 0-1.5Z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name *')" />
            <x-text-input placeholder="Your name" id="name" name="name" type="text" class="block w-full mt-1"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email *')" />
            <x-text-input placeholder="Your email" id="email" name="email" type="email"
                class="block w-full mt-1" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username *    ')" />
            <x-text-input placeholder="Your username" id="username" name="username" type="text"
                class="block w-full mt-1" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <!-- Bio -->
        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea rows=6 id="bio" placeholder="Tell us about yourself!" name="bio"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                autofocus autocomplete="bio">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <!-- Avatar -->
        <div>
            <div>
                <x-input-label for="avatar" :value="__('Avatar')" />
                <x-text-input placeholder="Your avatar" id="avatar" name="avatar" type="file" />
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>

            <!-- Image Preview -->
            <div id="avatar-preview" class="hidden mt-4">
                <x-input-label :value="__('Image preview')" />
                <img id="preview-img" src="" alt="Image Preview"
                    class="object-cover w-48 h-48 mt-2 rounded-full shadow-md" />
            </div>
        </div>

        <div class="sm:gap-2 sm:flex">
            <!-- Phone -->
            <div class="w-full sm:w-1/2">
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input placeholder="Your phone" id="phone" name="phone" type="text"
                    class="block w-full mt-1" :value="old('phone', $user->phone)" autofocus autocomplete="phone" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <!-- Address -->
            <div class="w-full sm:w-1/2">
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input placeholder="Your address" id="address" name="address" type="text"
                    class="block w-full mt-1" :value="old('address', $user->address)" autofocus autocomplete="address" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>
        </div>

        <div class="sm:gap-2 sm:flex">
            <!-- City -->
            <div class="w-full sm:w-1/2">
                <x-input-label for="city" :value="__('City')" />
                <x-text-input placeholder="Your city" id="city" name="city" type="text"
                    class="block w-full mt-1" :value="old('city', $user->city)" autofocus autocomplete="city" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <!-- Country -->
            <div class="w-full sm:w-1/2">
                <x-input-label for="country" :value="__('Country')" />
                <select id="country"
                    class="block w-full mt-1 text-sm font-medium text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    name="country" autocomplete="country">
                    <option hidden value="">Select a country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country['name'] }}"
                            {{ old('country', $user->country) == $country['name'] ? 'selected' : '' }}>
                            {{ $country['name'] }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('country')" class="mt-2" />
            </div>
        </div>

        <div class="sm:gap-2 sm:flex">
            <!-- Postcode -->
            <div class="w-full sm:w-1/2">
                <x-input-label for="postcode" :value="__('Postcode')" />
                <x-text-input placeholder="11200" id="postcode" name="postcode" type="number"
                    class="block w-full mt-1" :value="old('postcode', $user->postcode)" autofocus autocomplete="postcode" />
                <x-input-error class="mt-2" :messages="$errors->get('postcode')" />
            </div>

            <!-- Gender -->
            <div class="w-full sm:w-1/2">
                <x-input-label for="gender" :value="__('Gender')" />
                <select id="gender"
                    class="block w-full mt-1 text-sm font-medium text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    name="gender" autocomplete="gender">
                    <option hidden value="">Select a gender</option>
                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female
                    </option>
                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male
                    </option>
                    <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other
                    </option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>
        </div>

        <div class="sm:gap-2 sm:flex">
            <!-- Linkedin -->
            <div class="w-full sm:w-1/2">
                <x-input-label for="linkedin" :value="__('Linkedin')" />
                <x-text-input placeholder="Your linkedin profile url" id="linkedin" name="linkedin" type="url"
                    class="block w-full mt-1" :value="old('linkedin', $user->linkedin)" autofocus autocomplete="linkedin" />
                <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
            </div>

            <!-- Github -->
            <div class="w-full sm:w-1/2">
                <x-input-label for="github" :value="__('Github')" />
                <x-text-input placeholder="Your github profile url" id="github" name="github" type="url"
                    class="block w-full mt-1" :value="old('github', $user->github)" autofocus autocomplete="github" />
                <x-input-error class="mt-2" :messages="$errors->get('github')" />
            </div>
        </div>

        <!-- Company -->
        <div>
            <x-input-label for="company_id" :value="__('Company')" />
            <select id="company_id"
                class="block w-full mt-1 text-sm font-medium text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                name="company_id" autocomplete="company_id">
                <option hidden value="">Select a company</option>
                <option value="-1">None</option>
                @foreach (App\Models\Company::all() as $company)
                    <option value="{{ $company->id }}"
                        {{ old('company_id', $user->company_id) == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('company_id')" class="mt-2" />

            @if(auth()->user()->role === 'recruiter')
                <a wire:navigate class="flex items-center justify-end gap-2 mt-2 text-sm text-gray-500"
                    href="{{ route('companies.create') }}">
                    <p>
                        Add a company
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                    </svg>
                </a>
            @endif
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

        </div>
    </form>


    <!-- JavaScript for handling file input and preview -->
    <script>
        document.getElementById('avatar').addEventListener('change', function(event) {
            const input = event.target;
            const preview = document.getElementById('avatar-preview');
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
</section>
