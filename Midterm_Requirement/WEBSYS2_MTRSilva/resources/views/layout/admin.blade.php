<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Wagging Wonders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f6f6f6;
        }

        .navbar {
            background-color: #6B705C;
        }

        .navbar-brand,
        .nav-link {
            color: #fff !important;
        }

        .logo-text {
            font-weight: 500;
            color: #fff;
        }

        .btn-primary {
            background-color: #CB997E;
            border-color: #CB997E;
        }

        .btn-primary:hover {
            background-color: #6B705C;
            border-color: #6B705C;
        }

        .main-container {
            padding: 2rem 3rem;
        }

        .table th {
            background-color: #6B705C;
            color: #fcfcfc;
            font-weight: 500;
            font-size: 0.95rem;
            text-align: center;
        }

        .table td {
            vertical-align: middle;
            font-size: 0.92rem;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 12px;
        }

        .btn-sm {
            font-size: 0.8rem;
            padding: 4px 10px;
        }

        .alert-success {
            background-color: #d6eadf;
            border-color: #c2dfcc;
            color: #3a6f4d;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg px-4">
        <a class="navbar-brand d-flex align-items-center" href="/admin">
            <img src="{{ asset('images/logo.png') }}" alt="Wagging Wonders Logo"
                style="background-color: white; padding: 5px; border-radius: 8px;" height="40">
            <span class="logo-text ms-2">Wagging Wonders Admin</span>
        </a>
        <div class="ms-auto">
            <a href="/logout" class="btn btn-light">Logout</a>
        </div>
    </nav>

    <main class="main-container">
        @yield('content')
    </main>

</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

