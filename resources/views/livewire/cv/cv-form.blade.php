<div class="mt-6 space-y-6">
    <!-- Profile summary -->
    <livewire:cv.sections.profile-summary-form :userCv="$userCv" />

    <!-- Education -->
    <form wire:submit.prevent="updateEducation">
        <x-input-label for="education" :value="__('Education')" />
        @foreach ($education as $index => $edu)
            <div class="space-y-4">
                <x-text-input placeholder="Institution" wire:model="education.{{ $index }}.institution"
                    type="text" class="block w-full mt-1" />
                <x-input-error class="mt-2" :messages="$errors->get('education.' . $index . '.institution')" />

                <x-text-input placeholder="Degree" wire:model="education.{{ $index }}.degree" type="text"
                    class="block w-full mt-1" />
                <x-input-error class="mt-2" :messages="$errors->get('education.' . $index . '.degree')" />

                <x-text-input placeholder="Start Year" wire:model="education.{{ $index }}.start_year"
                    type="number" class="block w-full mt-1" />
                <x-input-error class="mt-2" :messages="$errors->get('education.' . $index . '.start_year')" />

                <x-text-input placeholder="End Year" wire:model="education.{{ $index }}.end_year" type="number"
                    class="block w-full mt-1" />
                <x-input-error class="mt-2" :messages="$errors->get('education.' . $index . '.end_year')" />
            </div>
            <x-danger-button class="my-4" type="button" wire:click="removeEducation({{ $index }})">
                Remove
            </x-danger-button>
        @endforeach
        <x-primary-button class="my-4" wire:click.prevent="updateEducation">Save education</x-primary-button>
        <x-secondary-button type="button" wire:click="addEducation">Add education</x-secondary-button>
    </form>

    <!-- Work Experience -->
    <form wire:submit.prevent="updateWorkExperience">
        <x-input-label for="work_experience" :value="__('Work Experience')" />
        @foreach ($work_experience as $index => $work)
            <div class="space-y-4">
                <x-text-input placeholder="Company" wire:model="work_experience.{{ $index }}.company"
                    type="text" class="block w-full mt-1" />
                <x-input-error class="mt-2" :messages="$errors->get('work_experience.' . $index . '.company')" />
                <x-text-input placeholder="Position" wire:model="work_experience.{{ $index }}.position"
                    type="text" class="block w-full mt-1" />
                <x-input-error class="mt-2" :messages="$errors->get('work_experience.' . $index . '.position')" />
                <x-text-input placeholder="Start Date" wire:model="work_experience.{{ $index }}.start_date"
                    type="date" class="block w-full mt-1" />
                <x-input-error class="mt-2" :messages="$errors->get('work_experience.' . $index . '.start_date')" />
                <x-text-input placeholder="End Date" wire:model="work_experience.{{ $index }}.end_date"
                    type="date" class="block w-full mt-1" />
                <x-input-error class="mt-2" :messages="$errors->get('work_experience.' . $index . '.end_date')" />
                <textarea placeholder="Description of your role and achievements"
                    wire:model="work_experience.{{ $index }}.description" class="block w-full mt-1"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('work_experience.' . $index . '.description')" />
            </div>
            <x-danger-button class="my-4" type="button" wire:click="removeWorkExperience({{ $index }})">
                Remove
            </x-danger-button>
        @endforeach
        <x-primary-button class="my-4" wire:click.prevent="updateWorkExperience">Save work
            experience</x-primary-button>
        <x-secondary-button type="button" wire:click="addWorkExperience">Add work experience</x-secondary-button>
    </form>

    <!-- Skills -->
    <form wire:submit.prevent="updateSkills">
        <x-input-label for="skills" :value="__('Skills')" />
        @foreach ($skills as $index => $skill)
            <x-text-input placeholder="Skill" wire:model="skills.{{ $index }}" type="text"
                class="block w-full mt-1" />
            <x-danger-button class="my-4" type="button" wire:click="removeSkill({{ $index }})">
                Remove
            </x-danger-button>
        @endforeach
        <x-primary-button class="my-4" type="button" wire:click="updateSkills">Save skills</x-primary-button>
        <x-secondary-button type="button" wire:click="addSkill">Add skill</x-secondary-button>
    </form>

    <!-- Certifications -->
    <form wire:submit.prevent="updateCertifications">
        <x-input-label for="certifications" :value="__('Certifications')" />
        @foreach ($certifications as $index => $certification)
            <div class="space-y-4">
                <x-text-input placeholder="Certification Title" wire:model="certifications.{{ $index }}.title"
                    type="text" class="block w-full mt-1" />
                <x-text-input placeholder="Year" wire:model="certifications.{{ $index }}.year" type="number"
                    class="block w-full mt-1" />
            </div>
            <x-danger-button class="my-4" type="button" wire:click="removeCertification({{ $index }})">
                Remove
            </x-danger-button>
        @endforeach
        <x-primary-button class="my-4" wire:click.prevent="updateEducation">Save certifications</x-primary-button>
        <x-secondary-button type="button" wire:click="addCertification">Add certifications</x-secondary-button>
    </form>

    <!-- Languages -->
    <form wire:submit.prevent="updateLanguages">
        <x-input-label for="languages" :value="__('Languages')" />
        @foreach ($languages as $index => $language)
            <div class="space-y-4">
                <x-text-input placeholder="Language" wire:model="languages.{{ $index }}.language"
                    type="text" class="block w-full mt-1" />
                <x-text-input placeholder="Proficiency (e.g., Fluent, Intermediate)"
                    wire:model="languages.{{ $index }}.proficiency" type="text"
                    class="block w-full mt-1" />
            </div>
            <x-danger-button class="my-4" type="button" wire:click="removeLanguage({{ $index }})">
                Remove
            </x-danger-button>
        @endforeach
        <x-primary-button class="my-4" wire:click.prevent="updateLanguage">Save languages</x-primary-button>
        <x-secondary-button type="button" wire:click="addLanguage">Add languages</x-secondary-button>
    </form>
</div>
