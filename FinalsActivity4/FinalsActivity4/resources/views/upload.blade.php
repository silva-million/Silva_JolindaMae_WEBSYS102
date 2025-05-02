<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Image Upload</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #fce4ec, #f3e5f5);
            margin: 0;
            padding: 40px;
            color: #4a2f3b;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1, h2, h3 {
            color: #d81b60;
            font-family: 'Arial', sans-serif;
            margin: 15px 0;
        }

        h1 {
            font-size: 2em;
            text-align: center;
            width: 100%;
        }

        h2 {
            font-size: 1.5em;
            text-align: left;
            width: 100%;
        }

        h3 {
            font-size: 1.2em;
            text-align: left;
            width: 100%;
        }

        .upload-section {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        form {
            background: #fff5f7;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
            margin: 10px 0;
            box-shadow: 0 3px 8px rgba(216, 27, 96, 0.15);
            border: 1px solid #f8bbd0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        input[type="file"] {
            margin: 10px 0 20px 0;
            padding: 10px;
            border: 1px solid #f8bbd0;
            border-radius: 6px;
            background: #fff;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #d81b60;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
            font-family: 'Arial', sans-serif;
        }

        button:hover {
            background-color: #c2185b;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 20px;
            width: 100%;
        }

        .photo-card {
            background: #fff5f7;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(216, 27, 96, 0.15);
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #f8bbd0;
            flex: 0 0 calc(14.28% - 16px); /* Adjusted for 7 items per row with gap */
            box-sizing: border-box;
        }

        .photo-card img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            margin-bottom: 12px;
            border: 1px solid #fce4ec;
        }

        .photo-card form {
            width: 60%;
        }

        .photo-card button {
            width: 100%;
            background-color: #ef5350;
        }

        .photo-card button:hover {
            background-color: #e53935;
        }

        .success-message {
            color: #d81b60;
            font-weight: 500;
            font-family: 'Arial', sans-serif;
            margin: 10px 0;
            text-align: left;
            width: 100%;
        }

        .pagination {
            margin-top: 20px;
            width: 100%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding-bottom: 20px;
        }

        .pagination a,
        .pagination span {
            color: #d81b60;
            text-decoration: none;
            padding: 8px 12px;
            margin: 0 4px;
            border: 1px solid #f8bbd0;
            border-radius: 6px;
            background: #fff;
            transition: background 0.3s, color 0.3s;
            font-size: 0.9em;
            line-height: 1;
        }

        .pagination a:hover {
            background: #fce4ec;
            color: #c2185b;
        }

        .pagination .current {
            background: #d81b60;
            color: #fff;
            border-color: #d81b60;
        }

        .pagination svg {
            height: 18px;
            vertical-align: middle;
        }
    </style>
</head>
<body>

    <div class="upload-section">
        @if(session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        <h3>Single Image Upload</h3>
        <form action="{{ route('photos.store.single') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" required>
            <button type="submit">Upload</button>
        </form>

        <h3>Multiple Images Upload</h3>
        <form action="{{ route('photos.store.multiple') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="images[]" multiple required>
            <button type="submit">Upload</button>
        </form>

        <h2>Uploaded Photos</h2>
        <div class="gallery">
            @foreach($photos as $photo)
                <div class="photo-card">
                    <img src="{{ asset('images/' . $photo->image) }}" alt="Uploaded Photo">
                    <form action="{{ route('photos.destroy', $photo) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $photos->links() }}
        </div>
    </div>

</body>
</html>
