<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Wagging Wonders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {  
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            background-color: #f9f9f9;
        }

        .login-container {
            display: flex;
            height: 100vh;
        }

        .login-image {
            flex: 1;
            background: url('{{ asset('images/image1.png') }}') no-repeat center center;
            background-size: cover;
        }

        .login-form {
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

        .btn-login {
            background-color: #6B705C;
            border: none;
        }

        .btn-login:hover {
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

        /* Style for the password input group */
        .input-group .btn {
            border: 1px solid #ced4da;
            border-left: 0;
            background-color: #fff;
        }

        .input-group .btn:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-image">
    </div>

    <div class="login-form">
        <div class="form-wrapper text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Wagging Wonders Logo"
                 style="height: 100px; padding: 10px; border-radius: 12px;">
            <h2>Admin Log in to Wagging Wonders</h2>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/admin/login" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label for="username" class="form-label">Username</label>
                    <input name="username" type="text" class="form-control" value="{{ old('username') }}" required>
                </div>
                <div class="mb-2 text-start">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input name="password" type="password" class="form-control" id="password" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                            <i class="bi bi-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-login w-100 py-2 text-white">Log In</button>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    }
</script>

</body>
</html>
