<x-app-layout>
    <x-slot name="header">
        <h2 class="text-6xl font-medium leading-tight text-gray-800">
            {{ $opening->title }}
        </h2>
    </x-slot>

    <div class="flex flex-col-reverse gap-8 px-4 py-12 mx-auto md:flex-row sm:px-6 lg:px-8 max-w-7xl">
        <div class="w-full space-y-2 md:w-1/2">

            <div class="mt-5">
                @if (session('applied_success'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="mb-4 text-green-600">
                        {{ session('applied_success') }}
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-between">
                <p class="text-xl font-semibold">{{ $opening->title }}</p>
                @auth
                    @if (auth()->user()->id === $opening->user_id)
                        <a href="{{ route('openings.edit', $opening->slug) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="mx-2 size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </a>
                    @endif
                @endauth
            </div>
            <p>{!! $opening->description !!}</p>
            <p><span class="font-semibold">Location:</span> {{ $opening->location }}</p>
            <p><span class="font-semibold">Offer:</span>
                {{ Illuminate\Support\Number::currency($opening->salary, 'USD') }}</p>
            <div class="flex items-center gap-2">
                <p class="font-semibold">Company: </p>
                <a href="{{ route('companies.show', $opening->company->slug) }}" class="text-sm hover:underline">
                    {{ $opening->company->name }}
                </a>
            </div>
            <div class="flex items-center gap-2">
                <p class="font-semibold">Category: </p>
                <a href="{{ route('categories.show', $opening->category()->slug) }}"
                    class="text-sm hover:underline">{{ $opening->category()->name }}</a>
            </div>
            
            <div class="flex items-center gap-2">
                <p class="font-semibold">Posted by: </p>
                <a href="{{ route('users.show', $opening->user->username) }}"
                    class="text-sm hover:underline">{{ $opening->user->name }}
                </a>
            </div>

            <livewire:openings.apply-to-opening :opening="$opening" />

            @auth
                @if (auth()->user()->role === 'recruiter' && auth()->user()->id === $opening->user_id)
                    <x-primary-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-opening-deletion')">{{ __('Delete opening') }}</x-primary-button>

                    <x-modal name="confirm-opening-deletion" focusable>
                        <form method="post" action="{{ route('openings.delete', $opening->slug) }}" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to delete this opening?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once deleted, you won\'t be able to restore this opening.') }}
                            </p>

                            <div class="flex justify-end mt-6">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    {{ __('Delete opening') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                @endif
            @endauth
        </div>
        <div class="w-full md:w-1/2">
            @if ($opening->image)
                <img class="object-cover aspect-square"
                    src="{{ Str::startsWith($opening->image, ['http://', 'https://']) ? $opening->image : asset('storage/' . $opening->image) }}"
                    alt="{{ $opening->name }}">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="text-gray-500 aspect-square">
                    <path fill-rule="evenodd"
                        d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                        clip-rule="evenodd" />
                </svg>
            @endif
        </div>
    </div>
</x-app-layout>
