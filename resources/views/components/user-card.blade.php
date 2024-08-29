<div class="w-full max-w-md mx-auto mt-10 overflow-hidden bg-white border border-black">
    <div class="relative w-full">
        <a href="#">
            <img class="object-cover w-full h-auto aspect-square" src="{{ $user->avatar }}" alt="{{ $user->name }}">
        </a>
    </div>

    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h3>
        <p class="mt-2 text-gray-600">{{ $user->email }}</p>
        <a href="#" class="block mt-4 text-sm text-blue-500 hover:underline">View Profile</a>
    </div>
</div>