<form wire:submit.prevent='updateCv' class="mt-6 space-y-6">
    <!-- Profile summary -->
    <div>
        <x-input-label for="profile_summary" :value="__('Profile summary')" />
        <textarea 
            placeholder="Tell us a little about yourself!" 
            wire:model="profile_summary" 
            class="block w-full mt-1" 
            autofocus
            autocomplete="profile_summary"></textarea>
        <x-input-error class="mt-2" :messages="$errors->get('profile_summary')" />
    </div>

    <!-- Education -->
    <div>
        <x-input-label for="education" :value="__('Education')" />
        @foreach ($education as $index => $edu)
            <div class="py-4 space-y-4">
                <x-text-input placeholder="Institution" wire:model="education.{{ $index }}.institution"
                    type="text" class="block w-full mt-1" />
                <x-text-input placeholder="Degree" wire:model="education.{{ $index }}.degree" type="text"
                    class="block w-full mt-1" />
                <x-text-input placeholder="Start Year" wire:model="education.{{ $index }}.start_year"
                    type="number" class="block w-full mt-1" />
                <x-text-input placeholder="End Year" wire:model="education.{{ $index }}.end_year" type="number"
                    class="block w-full mt-1" />
            </div>
        @endforeach
        <x-secondary-button type="button" wire:click="addEducation">Add Education</x-secondary-button>
    </div>

    <!-- Work Experience -->
    <div>
        <x-input-label for="work_experience" :value="__('Work Experience')" />
        @foreach ($work_experience as $index => $work)
            <div class="py-4 space-y-4">
                <x-text-input placeholder="Company" wire:model="work_experience.{{ $index }}.company"
                    type="text" class="block w-full mt-1" />
                <x-text-input placeholder="Position" wire:model="work_experience.{{ $index }}.position"
                    type="text" class="block w-full mt-1" />
                <x-text-input placeholder="Start Date" wire:model="work_experience.{{ $index }}.start_date"
                    type="date" class="block w-full mt-1" />
                <x-text-input placeholder="End Date" wire:model="work_experience.{{ $index }}.end_date"
                    type="date" class="block w-full mt-1" />
                <textarea placeholder="Description of your role and achievements"
                    wire:model="work_experience.{{ $index }}.description" class="block w-full mt-1"></textarea>
            </div>
        @endforeach
        <x-secondary-button type="button" wire:click="addWorkExperience">Add Work Experience</x-secondary-button>
    </div>

    <!-- Skills -->
    <div>
        <x-input-label for="skills" :value="__('Skills')" />
        @foreach ($skills as $index => $skill)
            <x-text-input placeholder="Skill" wire:model="skills.{{ $index }}" type="text"
                class="block w-full mt-1" />
        @endforeach
        <x-secondary-button type="button" wire:click="addSkill">Add Skill</x-secondary-button>
    </div>

    <!-- Certifications -->
    <div>
        <x-input-label for="certifications" :value="__('Certifications')" />
        @foreach ($certifications as $index => $certification)
            <div class="py-4 space-y-4">
                <x-text-input placeholder="Certification Title" wire:model="certifications.{{ $index }}.title"
                    type="text" class="block w-full mt-1" />
                <x-text-input placeholder="Year" wire:model="certifications.{{ $index }}.year" type="number"
                    class="block w-full mt-1" />
            </div>
        @endforeach
        <x-secondary-button type="button" wire:click="addCertification">Add Certification</x-secondary-button>
    </div>

    <!-- Languages -->
    <div>
        <x-input-label for="languages" :value="__('Languages')" />
        @foreach ($languages as $index => $language)
            <div class="py-4 space-y-4">
                <x-text-input placeholder="Language" wire:model="languages.{{ $index }}.language" type="text"
                    class="block w-full mt-1" />
                <x-text-input placeholder="Proficiency (e.g., Fluent, Intermediate)"
                    wire:model="languages.{{ $index }}.proficiency" type="text" class="block w-full mt-1" />
            </div>
        @endforeach
        <x-secondary-button type="button" wire:click="addLanguage">Add Language</x-secondary-button>
    </div>

    <!-- Save Button -->
    <x-primary-button type="submit" class="mt-4">
        Save
    </x-primary-button>

    @if (session('cv_updated'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="mb-4 text-green-600">
            {{ session('cv_updated') }}
        </div>
    @endif
</form>
