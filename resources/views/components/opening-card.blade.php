<div class="max-w-4xl py-4 overflow-hidden bg-white border-b border-gray-300">
    <div class="flex flex-col sm:flex-row">
        <div class="relative w-full mb-4 sm:w-36 sm:mb-0 sm:mr-4 aspect-square">
            <a href="{{ route('openings.show', $opening->slug) }}">
                <img loading="lazy" class="absolute inset-0 object-cover w-full h-full border" alt="{{ $opening->title }}" src="{{ Str::startsWith($opening->image, ['http://', 'https://']) ? $opening->image : asset('storage/' . $opening->image) }}">
            </a>
        </div>

        <div class="flex-1">
            <h3 class="text-2xl font-medium text-gray-800">{{ $opening->title }}</h3>
            <p class="my-2 text-gray-700">{!! Str::limit($opening->description, 150) !!}</p>
            <div class="flex gap-2">
                <a href="{{ route('companies.show', $opening->company->slug)}}" class="text-gray-400 hover:underline">{{ $opening->company->name }}</a>
                <a href="{{ route('openings.show', $opening->slug) }}" class="ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                        d="M8.25 3.75H19.5a.75.75 0 0 1 .75.75v11.25a.75.75 0 0 1-1.5 0V6.31L5.03 20.03a.75.75 0 0 1-1.06-1.06L17.69 5.25H8.25a.75.75 0 0 1 0-1.5Z"
                        clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            <p class="my-2 text-gray-500 text-sm">${{ number_format($opening->salary, 2) }}</p>
        </div>
    </div>
</div>