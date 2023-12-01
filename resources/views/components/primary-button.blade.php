<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 bg-gray-700 rounded-full font-semibold text-xs uppercase transition-all ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
