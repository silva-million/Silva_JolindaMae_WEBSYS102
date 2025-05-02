<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finals Activty 3</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3e8ff;
            color: #4b006e;
        }

        header {
            background-color: #d8b4fe;
            padding: 1rem;
            text-align: center;
            font-size: 1rem;
            font-weight: 600;
            color: #4b006e;
        }

        main {
            padding: 2rem;
        }

        .button {
            background-color: #c084fc;
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1.5rem;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #a855f7;
        }

        .card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        footer {
            background-color: #d8b4fe;
            padding: 1rem;
            text-align: center;
            margin-top: 2rem;
            color: #4b006e;
            font-size: 0.9rem;
        }

        a {
            color: #7c3aed;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        WEBSYS2 - Finals Activity 3
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
