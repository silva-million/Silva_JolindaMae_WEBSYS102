<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #fff0f5, #f8e1e9);
            font-family: 'Poppins', sans-serif;
            color: #4a3c4e;
        }
        .container {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(255, 182, 193, 0.3);
        }
        h1 {
            color: #ff69b4;
            font-weight: 600;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #ff85c0;
            border-color: #ff85c0;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #ff4d94;
            border-color: #ff4d94;
            transform: scale(1.05);
        }
        .list-group-item {
            border: 1px solid #ffe4e1;
            border-radius: 10px;
            margin-bottom: 10px;
            background: #fff5f8;
            transition: all 0.3s ease;
        }
        .list-group-item:hover {
            background: #ffebf0;
            transform: translateY(-2px);
        }
        .btn-outline-secondary, .btn-outline-danger {
            border-radius: 10px;
            padding: 5px 15px;
        }
        .btn-outline-secondary {
            color: #dda0dd;
            border-color: #dda0dd;
        }
        .btn-outline-secondary:hover {
            background-color: #dda0dd;
            color: #fff;
        }
        .btn-outline-danger {
            color: #ff69b4;
            border-color: #ff69b4;
        }
        .btn-outline-danger:hover {
            background-color: #ff69b4;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>All Books</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary mb-4">Add New Book</a>
        <ul class="list-group">
            @foreach ($books as $book)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $book->title }} by {{ $book->author }} ({{ $book->published_date }})</span>
                    <div>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-secondary btn-sm me-2">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
