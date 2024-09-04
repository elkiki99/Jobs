<form wire:submit.prevent="updateSkills">
    <h2 class="pb-4 text-4xl">{{ __('Skills') }}</h2>
    <div class="block">
        <x-input-label for="skills" :value="__('Skills')" />
        <x-text-input class="w-full mt-1" id="skills" wire:model="skillsInput" type="text"
            placeholder="Enter your skills separated by commas" />
        <x-input-error class="mt-2" :messages="$errors->get('skillsInput')" />
    </div>
    <x-primary-button class="block mt-4" type="submit">Save Skills</x-primary-button>

    @if (session('skills_updated'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="mt-4 text-green-600">
            {{ session('skills_updated') }}
        </div>
    @endif
</form>
