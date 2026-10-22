
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #333;
            margin: 30px;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        .guest-info {
            color: #666;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input, textarea {
            box-sizing: border-box;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font: inherit;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        button {
            padding: 10px 16px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font: inherit;
        }

        button:hover {
            background: #1d4ed8;
        }

        a {
            color: #2563eb;
            text-decoration: none;
            margin-left: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            display: block;
            color: #dc2626;
            margin-top: 5px;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            body {
                margin: 10px;
            }

            .container {
                margin: 10px auto;
                padding: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Create Post</h2>

        <p class="guest-info">
            Guest: {{ $guest->firstname }} {{ $guest->lastname }}
        </p>

        <form
            action="{{ isset($post) ? route('guests.posts.update', [$guest, $post]) : route('guests.posts.store', $guest) }}"
            method="POST"
        >
            @csrf

            @if (isset($post))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="title">Title</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $post->title ?? '') }}"
                    required
                >

                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <textarea
                    id="description"
                    name="description"
                    required
                >{{ old('description', $post->description ?? '') }}</textarea>

                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">
                {{ isset($post) ? 'Save Changes' : 'Create' }}
            </button>

            <a href="{{ route('guests.posts.index', $guest) }}">
                Cancel
            </a>
        </form>
    </div>
</body>
</html>
