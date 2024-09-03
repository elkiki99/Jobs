<div class="px-6 mx-auto max-w-7xl lg:px-8">
    <p class="text-xl text-gray-800">
        {{ __('Get recruited quickly by top headhunters, tailored for fast-moving developers.') }}<br>
        {{ __('Just apply and skip the lengthy forms!') }}
    </p>

    <div class="py-12">
        <p class="pb-6 text-2xl text-gray-600">{{ __('Featured openings') }}</p>
        <div class="gap-8">
            @forelse($openings as $opening)
                <x-opening-card :opening="$opening" />
            @empty
                <p>No openings found.</p>
            @endforelse
        </div>
    </div>

    <div class="py-12">
        <p class="text-2xl text-gray-600">{{ __('Featured recruiters') }}</p>
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($users as $user)
                <x-user-card :user="$user" />
            @empty
                <p>No recruiters found.</p>
            @endforelse
        </div>
    </div>

    <div class="py-12">
        <p class="text-2xl text-gray-600">{{ __('Featured companies') }}</p>
        <div class="gap-8 mt-10 sm:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 sm:grid">
            @forelse($companies as $company)
                <a href="{{ route('companies.show', $company->slug) }}">
                    <div class="flex flex-col items-center justify-center text-center">
                        <img loading="lazy" class="w-24 h-24 border rounded-full " src="{{ $company->logo }}"
                        alt="{{ $company->name }}">
                        <p class="flex-grow mt-2 font-medium">{{ $company->name }}</p>
                    </div>
                </a>
            @empty
                <p>No companies found.</p>
            @endforelse
        </div>
    </div>
</div>