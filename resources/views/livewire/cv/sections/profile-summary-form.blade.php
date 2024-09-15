<form wire:submit.prevent="updateProfileSummary">
    <h2 class="pb-4 text-4xl">{{ __('Profile summary') }}</h2>
    <div class="space-y-2">
        <x-input-label for="profile_summary" :value="__('Academic description *')" />
        {{-- <div x-data="{ resize() { $refs.textarea.style.height = 'auto';
                $refs.textarea.style.height = $refs.textarea.scrollHeight + 'px'; } }" x-init="resize()">
            <textarea rows="4" x-ref="textarea" wire:model="profile_summary" @input="resize"
                class="w-full mt-1 border border-gray-300 rounded-md resize-none" placeholder="Tell us a little about yourself!"
                autofocus autocomplete="profile_summary"></textarea>
        </div> --}}
        <div wire:ignore>
            <textarea 
                id="profile_summary"
                wire:model="profile_summary"
                placeholder="Tell us your story!">
            {{ $profile_summary }}</textarea>
        </div>
        
        <x-input-error class="mt-2" :messages="$errors->get('profile_summary')" />
    </div>
    <x-primary-button class="my-4 ml-auto" wire:click.prevent="updateProfileSummary">
        Save summary
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="ml-1 size-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
        </svg>
    </x-primary-button>

    @if (session('profile_summary_updated'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="mb-4 text-green-600">
            {{ session('profile_summary_updated') }}
        </div>
    @endif
</form>

@script
    <script>
        ClassicEditor
            .create(document.querySelector('#profile_summary'))
            .then(profile_summary => {
                profile_summary.model.document.on('change:data', () => {
                @this.set('profile_summary', profile_summary.getData());
                })
        })
            .catch(error => {
                console.error(error);
            });
    </script>
@endscript
