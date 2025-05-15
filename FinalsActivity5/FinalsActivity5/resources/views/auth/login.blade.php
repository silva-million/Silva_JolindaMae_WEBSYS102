<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="bg-[color:var(--color-primary)] p-8 rounded-xl shadow-xl max-w-md w-full mx-auto">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="text-[color:var(--color-text)] text-sm font-semibold block mb-1">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="bg-white text-black rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[color:var(--color-accent)]" />
            @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
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

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-[color:var(--color-accent)] text-[color:var(--color-primary)] shadow-sm focus:ring-[color:var(--color-accent)]" name="remember">
                <span class="ms-2 text-sm text-gray-700">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Submit / Forgot -->
        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-[color:var(--color-text)] hover:text-[color:var(--color-text)] transition" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="bg-[color:var(--color-secondary)] text-black px-4 py-2 rounded hover:bg-[color:var(--color-accent)] transition">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
