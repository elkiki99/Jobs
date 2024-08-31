<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-transparent font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-800 hover:text-white hover:border-white active:text-gray-800 active:bg-white transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
