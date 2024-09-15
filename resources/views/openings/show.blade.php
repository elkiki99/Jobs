<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800 sm:text-6xl">
            {{ $opening->title }}
        </h2>
    </x-slot>

    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <p class="pb-12 text-lg text-gray-600 sm:text-2xl">{{ $opening->company->name }}</p>

        <div class="flex flex-col-reverse gap-8 lg:flex-row">
            <div class="w-full space-y-2 lg:w-1/2">

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
                            <a wire:navigate href="{{ route('openings.edit', $opening->slug) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="mx-2 size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="flex items-center gap-2 py-1 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p>{{ $opening->created_at->diffForHumans() }}</p>
                </div>

                <p>{!! $opening->description !!}</p>

                <div class="pt-6">
                    <div class="space-y-4">
                        <p><span class="font-semibold">Location:</span> {{ $opening->location }}</p>
                        <p><span class="font-semibold">Offer:</span>
                            {{ Illuminate\Support\Number::currency($opening->salary, 'USD') }}</p>
                        <div class="flex items-center gap-2">
                            <p class="font-semibold">Company: </p>
                            <a wire:navigate href="{{ route('companies.show', $opening->company->slug) }}"
                                class="hover:underline">
                                {{ $opening->company->name }}
                            </a>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="font-semibold">Category: </p>
                            <a wire:navigate href="{{ route('categories.show', $opening->category()->slug) }}"
                                class="hover:underline">{{ $opening->category()->name }}</a>
                        </div>

                        <div class="flex items-center gap-2">
                            <p class="font-semibold">Posted by: </p>
                            <a wire:navigate href="{{ route('users.show', $opening->user->username) }}"
                                class="hover:underline">{{ $opening->user->name }}
                            </a>
                        </div>

                        <livewire:openings.apply-to-opening :opening="$opening" />
                    </div>
                </div>

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

            <div class="w-full lg:w-1/2">
                @if ($opening->image)
                    <img class="object-cover aspect-square"
                        src="{{ Str::startsWith($opening->image, ['http://', 'https://']) ? $opening->image : Storage::disk('s3')->url($opening->image) }}"
                        alt="{{ $opening->name }}">
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
