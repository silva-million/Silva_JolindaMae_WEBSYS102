<x-guest-layout>
    <form method="POST" action="{{ route('password.email') }}" class="form-card max-w-md w-full mx-auto">
        @csrf

        <div class="mb-4 text-sm text-[color:var(--color-text)]">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-green-600" :status="session('status')" />

        <!-- Email Address -->
        <div>
            <label for="email" class="text-[color:var(--color-text)] text-sm font-semibold block mb-1">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="bg-white text-black rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[color:var(--color-accent)]" />
            @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="btn-primary px-4 py-2 rounded">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>
