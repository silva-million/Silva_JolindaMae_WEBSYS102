<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up - Wagging Wonders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            background-color: #f9f9f9;
        }

        .signup-container {
            display: flex;
            height: 100vh;
        }

        .signup-image {
            flex: 1;
            background: url('{{ asset('images/image1.png') }}') no-repeat center center;
            background-size: cover;
        }

        .signup-form {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            background-color: #fff;
        }

        .form-wrapper {
            width: 100%;
            max-width: 400px;
        }

        .form-wrapper img {
            height: 60px;
            margin-bottom: 20px;
        }

        .form-wrapper h2 {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #6B705C;
        }

        .btn-signup {
            background-color: #6B705C;
            border: none;
        }

        .btn-signup:hover {
            background-color: #CB997E;
        }

        .form-text a {
            text-decoration: none;
            font-size: 0.9rem;
            color: #333;
        }

        .form-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="signup-container">
        <div class="signup-image">
        </div>

        <div class="signup-form">
            @if ($errors->any())
                <div class="alert alert-danger text-start">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="form-wrapper text-center">
                <img src="{{ asset('images/logo.png') }}" alt="Wagging Wonders Logo"
                    style="height: 100px; padding: 10px; border-radius: 12px; ">
                <h2>Create Your Account</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger text-start">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="/signup">
                    @csrf
                    <div class="mb-3 text-start">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>

                    <div class="mb-3 text-start">
                        <label for="name" class="form-label">Full Name</label>
                        <input name="name" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input name="password_confirmation" type="password" class="form-control" required>
                    </div>


                    <button type="submit" class="btn btn-signup w-100 py-2 text-white">Sign Up</button>

                    <div class="mt-3">
                        <small>Already have an account? <a href="/login">Login here</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
