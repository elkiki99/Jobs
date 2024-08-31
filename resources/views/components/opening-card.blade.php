<div class="max-w-4xl py-4 overflow-hidden bg-white border-b border-gray-300">
    <div class="flex flex-col sm:flex-row">
        <div class="relative w-full mb-4 sm:w-36 sm:mb-0 sm:mr-4 aspect-square">
            <a href="{{ route('openings.show', $opening->slug) }}">
                <img loading="lazy" class="absolute inset-0 object-cover w-full h-full border border-black" src="{{ $opening->image }}" alt="{{ $opening->title }}">
            </a>
        </div>

        <div class="flex-1">
            <h3 class="text-2xl font-medium text-gray-800">{{ $opening->title }}</h3>
            <p class="my-2 text-gray-700">{{ Str::limit($opening->description, 150) }}</p>
            <a href="{{ route('companies.show', $opening->user->company->slug)}}" class="text-gray-400 ">{{ $opening->user->company->name }}</a>
        </div>
    </div>
</div>