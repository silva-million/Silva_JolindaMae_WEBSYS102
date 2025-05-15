<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome</title>
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[color:var(--color-bg)] text-[color:var(--color-text)] min-h-screen flex flex-col items-center justify-center px-4 py-10">

    <div class="w-full max-w-3xl bg-[color:var(--color-primary)] p-10 rounded-xl shadow-xl text-center">
        <h1 class="text-3xl font-bold mb-4">Welcome to Assignment 5!</h1>
        <p class="text-md mb-6">
            Silva, Jolinda Mae A.
        </p>

        <div class="flex justify-center space-x-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-primary px-4 py-2 rounded-md">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-primary px-4 py-2 rounded-md">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-primary px-4 py-2 rounded-md">Register</a>
                @endif
            @endauth
        </div>
    </div>

</body>
</html>
