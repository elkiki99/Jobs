<div class="w-full max-w-md mx-auto mt-10 overflow-hidden bg-white border border-black">
    <div class="relative w-full">
        <a href="{{ route('users.show', $user->username) }}">
            <img loading="lazy" class="object-cover w-full h-auto aspect-square" src="{{ $user->avatar }}" alt="{{ $user->name }}">
        </a>
    </div>

    <div class="p-4 space-y-2">
        <h3 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h3>
        <p class="mt-2 text-gray-600">{{ $user->email }}</p>
        <div class="flex items-center justify-between">
            <a href="{{ route('users.show', $user->username) }}" class="block mt-0 text-sm hover:underline">View Profile</a>
            <x-primary-button>Follow</x-primary-button>
        </div>
    </div>
</div>