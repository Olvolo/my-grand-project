@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-amber-400 text-left text-base font-medium text-brand-cream bg-sky-900/50 focus:outline-none transition'
                : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-sky-200 hover:text-brand-cream hover:bg-sky-900/50 hover:border-sky-300 focus:outline-none transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
