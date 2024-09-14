<div class="p-8 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex flex-col items-center justify-between gap-4 lg:flex-row">
        <!-- Logo / Name Section -->
        <div>
            <p class="text-gray-500">
                © {{ date('Y') }} {{ config('app.name') }}
            </p>
        </div>

        <!-- Navigation Links -->
        <div class="flex flex-wrap justify-center gap-4 px-4 sm:gap-6 md:gap-8">
            <x-nav-link wire:navigate :href="route('home')">Home</x-nav-link>
            <x-nav-link wire:navigate :href="route('about')">About</x-nav-link>
            <x-nav-link wire:navigate :href="route('terms')">Terms</x-nav-link>
            <x-nav-link wire:navigate :href="route('support')">Support</x-nav-link>
            <x-nav-link wire:navigate :href="route('privacy')">Privacy</x-nav-link>
            <x-nav-link wire:navigate :href="route('cookies')">Cookies</x-nav-link>
            <x-nav-link wire:navigate :href="route('help')">Help</x-nav-link>
        </div>
    </div>
</div>