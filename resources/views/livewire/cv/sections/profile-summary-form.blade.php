<form wire:submit.prevent="updateProfileSummary">
    <x-input-label for="profile_summary" :value="__('Profile summary')" />
    <textarea rows=6 placeholder="Tell us a little about yourself!" wire:model="profile_summary" class="block w-full mt-1"
        autofocus autocomplete="profile_summary"></textarea>
    <x-input-error class="mt-2" :messages="$errors->get('profile_summary')" />
    <x-primary-button class="my-4 ml-auto" wire:click.prevent="updateProfileSummary">Save profile
        summary</x-primary-button>

    @if (session('profile_summary_updated'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="mb-4 text-green-600">
            {{ session('profile_summary_updated') }}
        </div>
    @endif
</form>