
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-primary text-white p-3">
        <h1>Silva, Assignment2</h1>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/customer') }}">Customer</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/item') }}">Item</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/order') }}">Order</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/orderdetails') }}">Order Details</a></li>
            </ul>
        </nav>
    </header>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="bg-light text-center p-3">
        <p>&copy; {{ date('Y') }} Silva, Jolinda Mae A.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>