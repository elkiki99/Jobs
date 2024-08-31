<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-white hover:text-gray-800 hover:border-gray-800 active:bg-gray-900 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
