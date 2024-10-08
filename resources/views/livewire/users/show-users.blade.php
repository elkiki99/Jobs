<div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
    <p class="text-lg text-gray-600 sm:text-2xl">
        {{ __('Expand your network, contact with headhunters and connect with devs just like you') }}</p>

    <div class="gap-8 py-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 sm:grid">
        @forelse($users as $user)
            <x-user-card :user="$user" />
        @empty
            <p>No users found.</p>
        @endforelse
    </div>

    {{ $users->links() }}
</div>