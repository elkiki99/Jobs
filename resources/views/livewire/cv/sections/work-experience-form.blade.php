<form wire:submit.prevent="updateWorkExperience">
    <h2 class="pb-4 text-4xl">{{ __('Work experience') }}</h2>
    @foreach ($work_experience as $index => $work)
        <div class="space-y-2">
            <x-input-label for="work_experience" :value="__('Company name *')" />
            <x-text-input placeholder="Your company name" wire:model="work_experience.{{ $index }}.company"
                type="text" class="block w-full mt-1" />
            <x-input-error class="mt-2" :messages="$errors->get('work_experience.' . $index . '.company')" />

            <x-input-label for="work_experience" :value="__('Position *')" />
            <x-text-input placeholder="Your position" wire:model="work_experience.{{ $index }}.position"
                type="text" class="block w-full mt-1" />
            <x-input-error class="mt-2" :messages="$errors->get('work_experience.' . $index . '.position')" />

            <x-input-label for="work_experience" :value="__('Description *')" />
            <div x-data="{
                resize() {
                    $refs.textarea.style.height = 'auto';
                    $refs.textarea.style.height = $refs.textarea.scrollHeight + 'px';
                }
            }" x-init="resize()">
                <textarea rows="4" placeholder="Description of your role and achievements" x-ref="textarea"
                    wire:model="work_experience.{{ $index }}.description" @input="resize"
                    class="w-full mt-1 border border-gray-300 rounded-md resize-none"></textarea>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('work_experience.' . $index . '.description')" />

            <x-input-label for="work_experience" :value="__('Start date *')" />
            <x-text-input wire:model="work_experience.{{ $index }}.start_date" type="date"
                class="block w-full mt-1" />
            <x-input-error class="mt-2" :messages="$errors->get('work_experience.' . $index . '.start_date')" />

            <x-input-label for="work_experience" :value="__('End date')" />
            <x-text-input wire:model="work_experience.{{ $index }}.end_date" type="date"
                class="block w-full mt-1" />
            <x-input-error class="mt-2" :messages="$errors->get('work_experience.' . $index . '.end_date')" />
        </div>
        <x-danger-button class="my-4" type="button" wire:click="removeWorkExperience({{ $index }})">
            Remove
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="ml-1 size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" />
            </svg>
        </x-danger-button>
    @endforeach
    <x-primary-button class="my-4" wire:click.prevent="updateWorkExperience">
        Save experience
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="ml-1 size-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
        </svg>
    </x-primary-button>
    <x-secondary-button type="button" wire:click="addWorkExperience">
        Add experience
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="ml-1 size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </x-secondary-button>

    @if (session('work_experience_updated'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="mb-4 text-green-600">
            {{ session('work_experience_updated') }}
        </div>
    @endif
</form>
