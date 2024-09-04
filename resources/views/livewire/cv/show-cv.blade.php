<div class="max-w-4xl p-6 mx-auto">
    <!-- Profile summary -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">About</h2>
        <p class="mt-2 text-gray-700">{{ $user->userCv->profile_summary }}</p>
    </div>

    <!-- Education -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Education</h2>
        @foreach ($user->userCv->education as $education)
            <div class="mt-2">
                <p class="text-lg font-semibold">{{ $education['degree'] }} - {{ $education['institution'] }}</p>
                <p class="text-gray-600 ">{{ $education['start_year'] }} - {{ $education['end_year'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Work experience -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Work Experience</h2>
        @foreach ($user->userCv->work_experience as $experience)
            <div class="mt-2">
                <p class="text-lg font-semibold">{{ $experience['position'] }} at {{ $experience['company'] }}</p>
                <p class="text-gray-600 ">{{ $experience['start_date'] }} - {{ $experience['end_date'] ?: __('Present') }}</p>
                <p class="text-gray-700">{!! nl2br(e($experience['description'])) !!}</p>
            </div>
        @endforeach
    </div>

    <!-- Certifications -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Certifications</h2>
        @foreach ($user->userCv->certifications as $certification)
            <div class="mt-2">
                <p class="text-lg font-semibold">{{ $certification['title'] }}</p>
                <p class="text-gray-600 ">{{ $certification['date'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Languages -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Languages</h2>
        @foreach ($user->userCv->languages as $language)
            <p class="mt-2 text-gray-700"><span class="font-bold">{{ $language['language'] }}</span> - {{ $language['proficiency'] }}</p>
        @endforeach
    </div>

    <!-- Skills -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Skills</h2>
        <div class="flex flex-wrap gap-2 py-2">
            @foreach (json_decode($user->userCv->skills) as $skill)
                <span class="px-3 py-1 text-sm font-medium text-gray-800 bg-gray-200 rounded-full">
                    {{ $skill }}
                </span>
            @endforeach
            </ul>
        </div>
    </div>
</div>