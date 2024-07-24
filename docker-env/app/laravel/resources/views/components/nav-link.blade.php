@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-indigo-400 text-sm font-medium leading-5 text-white focus:outline-none transition duration-150 hover:border-gray-300 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-transparent text-sm font-medium leading-5 text-white hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
