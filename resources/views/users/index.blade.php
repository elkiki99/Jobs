<x-app-layout>
    <x-slot name="header">
        <h2 class="text-6xl font-medium leading-tight text-gray-800">
            {{ __('Network') }}
        </h2>
    </x-slot>  

    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <p class="text-2xl text-gray-600">{{ __('Expand your network, contact with headhunters and connect with devs just like you') }}</p>
        
        <div class="gap-8 py-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 sm:grid">
            @forelse($users as $user)
                <x-user-card :user="$user" />
            @empty  
                <p>No users found.</p>
            @endforelse
        </div>

        {{ $users->links() }}   
    </div>
</x-app-layout>