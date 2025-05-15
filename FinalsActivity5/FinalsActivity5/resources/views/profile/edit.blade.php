<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-[color:var(--color-text)] leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[color:var(--color-bg)]">
        <div class="max-w-4xl mx-auto space-y-6 px-6">
            <!-- Profile Info -->
            <div class="bg-[color:var(--color-primary)] p-6 rounded-xl shadow-md">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-[color:var(--color-primary)] p-6 rounded-xl shadow-md">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-[color:var(--color-primary)] p-6 rounded-xl shadow-md">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
