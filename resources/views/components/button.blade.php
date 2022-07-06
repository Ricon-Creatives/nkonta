<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
     focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</button>
