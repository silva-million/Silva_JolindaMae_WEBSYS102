<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-[color:var(--color-text)] leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[color:var(--color-bg)] min-h-screen">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white p-8 rounded-xl shadow-md border-t-4 border-[color:var(--color-primary)]">
                <p class="text-[color:var(--color-text)] text-lg">
                    {{ __("You're logged in!") }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
