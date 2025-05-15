<a {{ $attributes->merge([
    'class' => 'block px-4 py-2 text-sm text-[color:var(--color-text)] hover:bg-[color:var(--color-secondary)] hover:text-black transition rounded-md'
]) }}>
    {{ $slot }}
</a>
