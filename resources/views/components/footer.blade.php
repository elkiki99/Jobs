<div class="flex justify-between p-8 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div>
        <p class="text-gray-500">
            © {{ date('Y') }} {{ config('app.name') }}
        </p>
    </div>
    
    <div class="px-4 space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('jobs')">Home</x-nav-link>
        <x-nav-link :href="route('about')">About</x-nav-link>
        <x-nav-link :href="route('terms')">Terms</x-nav-link>
        <x-nav-link :href="route('support')">Support</x-nav-link>
        <x-nav-link :href="route('privacy')">Privacy</x-nav-link>
        <x-nav-link :href="route('cookies')">Cookies</x-nav-link>
        <x-nav-link :href="route('help')">Help</x-nav-link>
    </div>
</div>