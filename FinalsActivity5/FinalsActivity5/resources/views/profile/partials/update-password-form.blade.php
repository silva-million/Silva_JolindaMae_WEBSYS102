<section>
    <header>
        <h2 class="text-lg font-semibold text-[color:var(--color-text)]">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-[color:var(--color-text)]">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block text-sm font-semibold text-[color:var(--color-text)]">Current Password</label>
            <input id="current_password" name="current_password" type="password" autocomplete="current-password"
                class="w-full bg-white text-black border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[color:var(--color-accent)]" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-[color:var(--color-text)]">New Password</label>
            <input id="password" name="password" type="password" autocomplete="new-password"
                class="w-full bg-white text-black border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[color:var(--color-accent)]" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-[color:var(--color-text)]">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                class="w-full bg-white text-black border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[color:var(--color-accent)]" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-[color:var(--color-secondary)] text-black px-4 py-2 rounded hover:bg-[color:var(--color-accent)] transition">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-[color:var(--color-text)]">Saved.</p>
            @endif
        </div>
    </form>
</section>
