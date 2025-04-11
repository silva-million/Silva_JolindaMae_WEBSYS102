<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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
        .form-control {
            border: 2px solid #ffe4e1;
            border-radius: 10px;
            background: #fff5f8;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #ff85c0;
            box-shadow: 0 0 8px rgba(255, 133, 192, 0.3);
            background: #ffffff;
        }
        .form-label {
            color: #ff69b4;
            font-weight: 600;
        }
        .btn-success {
            background-color: #ff85c0;
            border-color: #ff85c0;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            background-color: #ff4d94;
            border-color: #ff4d94;
            transform: scale(1.05);
        }
        .btn-secondary {
            background-color: #dda0dd;
            border-color: #dda0dd;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #c78dc7;
            border-color: #c78dc7;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Book</h1>
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $book->title }}" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" id="author" name="author" class="form-control" value="{{ $book->author }}" required>
            </div>
            <div class="mb-3">
                <label for="published_date" class="form-label">Published Date</label>
            <input type="date" id="published_date" name="published_date" class="form-control" value="{{ $book->published_date }}" required>
            </div>
            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
