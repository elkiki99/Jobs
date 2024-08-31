<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-white hover:text-red-600 hover:border-red-600 active:text-white active:bg-red-600 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
