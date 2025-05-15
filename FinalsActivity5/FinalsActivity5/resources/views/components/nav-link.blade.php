@props(['active'])

@php
    $classes = $active
                ? 'nav-link-active-class'
                : 'nav-link-default-class';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
