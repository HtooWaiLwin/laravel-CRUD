
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>

    <style>
        
* {
    box-sizing: border-box;
}

body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f1f5f9;
    color: #1e293b;
    margin: 0;
    padding: 40px 20px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1.6;
}

.container {
    width: 100%;
    max-width: 620px;
    margin: 0 auto;
    padding: 35px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 10px 35px rgba(15, 23, 42, 0.07);
}

h2 {
    margin: 0 0 12px;
    color: #0f172a;
    font-size: 28px;
    font-weight: 700;
    letter-spacing: -0.7px;
}

.guest-info {
    margin: 0 0 28px;
    padding: 13px 16px;
    color: #475569;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-left: 4px solid #2563eb;
    border-radius: 8px;
    font-size: 14px;
    overflow-wrap: anywhere;
}

.form-group {
    margin-bottom: 23px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #334155;
    font-size: 13px;
    font-weight: 600;
}

input,
textarea {
    display: block;
    width: 100%;
    padding: 12px 14px;
    color: #1e293b;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-family: inherit;
    font-size: 14px;
    line-height: 1.6;
    outline: none;
    transition: border-color 0.2s ease,
                box-shadow 0.2s ease;
}

input {
    min-height: 46px;
}

input:hover,
textarea:hover {
    border-color: #94a3b8;
}

input:focus,
textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

input::placeholder,
textarea::placeholder {
    color: #94a3b8;
}

textarea {
    min-height: 180px;
    resize: vertical;
    line-height: 1.7;
}

button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 44px;
    padding: 11px 20px;
    background: #2563eb;
    color: #ffffff;
    border: 1px solid #2563eb;
    border-radius: 8px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
}

button:hover {
    background: #1d4ed8;
    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
    transform: translateY(-1px);
}

button:active {
    transform: translateY(0);
}

a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 44px;
    margin-left: 10px;
    padding: 10px 15px;
    color: #475569;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: color 0.2s ease,
                background 0.2s ease,
                border-color 0.2s ease;
}

a:hover {
    color: #1d4ed8;
    background: #eff6ff;
    border-color: #bfdbfe;
    text-decoration: none;
}

.error {
    display: block;
    margin-top: 7px;
    color: #dc2626;
    font-size: 12px;
    font-weight: 500;
    overflow-wrap: anywhere;
}

input:focus-visible,
textarea:focus-visible,
button:focus-visible,
a:focus-visible {
    outline: 3px solid #93c5fd;
    outline-offset: 3px;
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
