<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a wire:navigate href="{{ route('home') }}">
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden space-x-8 sm:flex sm:items-center sm:ms-6">

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link wire:navigate :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link wire:navigate :href="route('openings.index')" :active="request()->routeIs('openings.index')">
                        {{ __('Openings') }}
                    </x-nav-link>
                    <x-nav-link wire:navigate :href="route('users.index')" :active="request()->routeIs('users.index')">
                        {{ __('Connect') }}
                    </x-nav-link>
                </div>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link wire:navigate :href="route('users.show', Auth::user()->username)">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <x-dropdown-link wire:navigate :href="route('network')">
                                {{ __('Network') }}
                            </x-dropdown-link>

                            @if (auth()->user()->role === 'developer')
                                <x-dropdown-link wire:navigate :href="route('openings.applications')">
                                    {{ __('Applications') }}
                                </x-dropdown-link>
                                <x-dropdown-link wire:navigate :href="route('profile.cv')">
                                    {{ __('C.V') }}
                                </x-dropdown-link>
                            @else
                                <x-dropdown-link wire:navigate :href="route('openings.my-openings')">
                                    {{ __('My openings') }}
                                </x-dropdown-link>
                                <x-dropdown-link wire:navigate :href="route('openings.create')">
                                    {{ __('New opening') }}
                                </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>

                    <a wire:navigate href="{{ route('notifications') }}" class="relative flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="w-6 h-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>

                        <span x-data="{ unreadCount: {{ auth()->user()->unreadNotifications->count() }} }" x-show="unreadCount > 0 "
                            x-text="unreadCount > 9 ? '+9' : unreadCount" x-cloak
                            class="absolute flex items-center justify-center w-5 h-5 text-xs font-semibold text-white bg-red-600 rounded-full -top-2 -right-2">
                        </span>
                    </a>
                @else
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('login')">
                            {{ __('Log in') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-nav-link>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                @auth
                    <a wire:navigate class="relative flex items-center mx-2" href="{{ route('notifications') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>

                        <span x-data="{ unreadCount: {{ auth()->user()->unreadNotifications->count() }} }" x-show="unreadCount > 0 "
                            x-text="unreadCount > 9 ? '+9' : unreadCount" x-cloak
                            class="absolute flex items-center justify-center w-5 h-5 text-xs font-semibold text-white bg-red-600 rounded-full -top-2 -right-2">
                        </span>
                    </a>
                @endauth

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linein="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link wire:navigate :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link wire:navigate :href="route('openings.index')" :active="request()->routeIs('openings.index')">
                {{ __('Openings') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link wire:navigate :href="route('users.index')" :active="request()->routeIs('users.index')">
                {{ __('Connect') }}
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link wire:navigate :href="route('network')" :active="request()->routeIs('network')">
                    {{ __('Network') }}
                </x-responsive-nav-link>
                @if (auth()->user()->role === 'developer')
                    <x-responsive-nav-link wire:navigate :href="route('openings.applications')" :active="request()->routeIs('openings.applications')">
                        {{ __('Applications') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link wire:navigate :href="route('profile.cv')" :active="request()->routeIs('profile.cv')">
                        {{ __('C.V') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link wire:navigate :href="route('openings.my-openings')" :active="request()->routeIs('openings.my-openings')">
                        {{ __('My openings') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link wire:navigate :href="route('openings.create')" :active="request()->routeIs('openings.create')">
                        {{ __('New opening') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="flex items-center">
                        
                        <!-- Avatar -->
                        @if (Auth::user()->avatar)
                            <a wire:navigate href="{{ route('users.show', Auth::user()->username) }}">
                                <img class="rounded-full size-12 aspect-square"
                                    src="{{ Str::startsWith(Auth::user()->avatar, ['http://', 'https://']) ? Auth::user()->avatar : Storage::disk('s3')->url(Auth::user()->avatar) }}"
                                    alt="{{ Auth::user()->username }}">
                            </a>
                        @else
                            <a wire:navigate href="{{ route('users.show', Auth::user()->username) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="text-gray-500 rounded-full size-16 aspect-square">
                                    <path fill-rule="evenodd"
                                        d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif

                        <div class="ml-2">
                            <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200">
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Log in') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            </div>
        @endauth
    </div>
</nav>
