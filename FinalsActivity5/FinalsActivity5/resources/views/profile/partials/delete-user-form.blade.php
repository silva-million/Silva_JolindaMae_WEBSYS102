<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-[color:var(--color-text)]">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-[color:var(--color-text)]">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-[color:var(--color-text)]">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-[color:var(--color-text)]">
                {{ __('Please enter your password to confirm.') }}
            </p>

            <div class="mt-6">
                <input id="password" name="password" type="password" placeholder="{{ __('Password') }}"
                    class="w-3/4 bg-white text-black border border-gray-300 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[color:var(--color-accent)]" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')"
                    class="px-4 py-2 rounded bg-gray-200 text-[color:var(--color-text)] hover:bg-gray-300">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
