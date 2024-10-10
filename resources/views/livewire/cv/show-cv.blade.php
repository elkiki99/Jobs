<div class="pt-10 xp-0 md:xp-6 lg:pt-0">
    <!-- Profile summary -->
    @if ($user->userCv && $user->userCv->profile_summary)
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">About</h2>
            <p class="mt-2 text-gray-700">{!! $user->userCv->profile_summary !!}</p>
        </div>
    @endif

    <!-- Education -->
    @if ($user->userCv && $user->userCv->education)
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Education</h2>
            @foreach ($user->userCv->education as $education)
                <div class="mt-2">
                    <p class="text-lg font-semibold">{{ $education['degree'] }} - {{ $education['institution'] }}</p>
                    <p class="text-gray-600 ">{{ $education['start_year'] }} -
                        {{ $education['end_year'] ?: __('Present') }}</p>
                    <p class="text-gray-700">{!! nl2br(e($education['description'])) !!}</p>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Work experience -->
    @if ($user->userCv && $user->userCv->work_experience)
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Work Experience</h2>
            @foreach ($user->userCv->work_experience as $experience)
                <div class="mt-2">
                    <p class="text-lg font-semibold">{{ $experience['position'] }} at {{ $experience['company'] }}</p>
                    <p class="text-gray-600 ">{{ $experience['start_date'] }} -
                        {{ $experience['end_date'] ?: __('Present') }}</p>
                    <p class="text-gray-700">{!! nl2br(e($experience['description'])) !!}</p>
                </div>
            @endforeach
        </div>
    @endif

    @if ($user->userCv && $user->userCv->projects)
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Projects</h2>
            @foreach ($user->userCv->projects as $project)
                <div class="mt-2">
                    <p class="text-lg font-semibold">{{ $project['title'] }}</p>
                    {{ \Carbon\Carbon::parse($project['date'])->format('d/m/Y') }}
                    <p class="text-gray-700">{!! nl2br(e($project['description'])) !!}</p>

                    <div class="mt-1 mb-3">

                        @foreach (explode(',', $project['technologies']) as $technology)
                        <span class="px-0.5 underline">
                            {{ trim($technology) }}
                        </span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Certifications -->
    @if ($user->userCv && $user->userCv->certifications)
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Certifications</h2>
            @foreach ($user->userCv->certifications as $certification)
                <div class="mt-2">
                    <p class="text-lg font-semibold">{{ $certification['title'] }} -
                        {{ $certification['organization'] }}
                    </p>
                    <p class="text-gray-600 ">{{ $certification['date'] }}</p>
                    <p class="text-gray-700">{!! nl2br(e($certification['description'])) !!}</p>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Languages -->
    @if ($user->userCv && $user->userCv->languages)
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Languages</h2>
            @foreach ($user->userCv->languages as $language)
                <p class="mt-2 text-gray-700"><span class="font-bold">{{ $language['language'] }}</span> -
                    {{ $language['proficiency'] }}</p>
            @endforeach
        </div>
    @endif

    <!-- Skills -->
    @if ($user->userCv && $user->userCv->skills)
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
    @endif
</div>
