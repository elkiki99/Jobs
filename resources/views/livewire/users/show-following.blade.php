<div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
    <p class="text-2xl text-gray-600">{{ __('This is a listing of the people you are following') }}</p>

    <div class="gap-8 py-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 sm:grid">
        @forelse($users as $user)
            <x-user-card :user="$user" />
        @empty
            <div class="col-span-full">
                <p>You are not following anyone yet, <a class="py-1 underline" href="{{ route('users.index') }}">connect with more people!</a></p>
            </div>
        @endforelse
    </div>

    {{ $users->links() }}
</div>