<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="bg-[color:var(--color-primary)] p-8 rounded-xl shadow-xl max-w-md w-full mx-auto">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="text-[color:var(--color-text)] text-sm font-semibold block mb-1">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="bg-white text-black rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[color:var(--color-accent)]" />
            @error('name')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mt-4">
            <label for="email" class="text-[color:var(--color-text)] text-sm font-semibold block mb-1">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                class="bg-white text-black rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[color:var(--color-accent)]" />
            @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="text-[color:var(--color-text)] text-sm font-semibold block mb-1">Password</label>
            <input id="password" name="password" type="password" required autocomplete="new-password"
                class="bg-white text-black rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[color:var(--color-accent)]" />
            @error('password')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="text-[color:var(--color-text)] text-sm font-semibold block mb-1">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                class="bg-white text-black rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[color:var(--color-accent)]" />
            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="underline text-sm text-[color:var(--color-text)] hover:text-[color:var(--color-text)] transition">
                Already registered?
            </a>

            <button type="submit" class="bg-[color:var(--color-secondary)] text-black px-4 py-2 rounded hover:bg-[color:var(--color-accent)] transition">
                Register
            </button>
        </div>
    </form>
</x-guest-layout>
