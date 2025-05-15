<x-guest-layout>
    <form method="POST" action="{{ route('password.confirm') }}" class="form-card max-w-md w-full mx-auto">
        @csrf

        <div class="mb-4 text-sm text-[color:var(--color-text)]">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="text-[color:var(--color-text)] text-sm font-semibold block mb-1">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password"
                class="bg-white text-black rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[color:var(--color-accent)]" />
            @error('password')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="btn-primary px-4 py-2 rounded">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
