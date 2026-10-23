
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Posts</title>

    <style>
        
* {
    box-sizing: border-box;
}

body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f1f5f9;
    color: #1e293b;
    margin: 0;
    padding: 40px 24px;
    line-height: 1.6;
}

.container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 32px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
}

h2 {
    margin: 0 0 24px;
    color: #0f172a;
    font-size: 28px;
    font-weight: 700;
    letter-spacing: -0.7px;
    overflow-wrap: anywhere;
}

a {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease,
                background 0.2s ease,
                border-color 0.2s ease;
}

a:hover {
    color: #1d4ed8;
    text-decoration: none;
}

.top-actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 26px;
}

.top-actions > a:not(.btn) {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 40px;
    padding: 9px 14px;
    color: #475569;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
}

.top-actions > a:not(.btn):hover {
    color: #1d4ed8;
    background: #eff6ff;
    border-color: #bfdbfe;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 40px;
    padding: 9px 15px;
    background: #2563eb;
    color: #ffffff;
    border: 1px solid #2563eb;
    border-radius: 8px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    line-height: 1.4;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
}

.btn:hover {
    background: #1d4ed8;
    color: #ffffff;
    border-color: #1d4ed8;
    text-decoration: none;
}

.btn:active {
    transform: translateY(0);
}

.edit-btn {
    background: #eff6ff;
    color: #1d4ed8;
    border-color: #bfdbfe;
}

.edit-btn:hover {
    background: #dbeafe;
    color: #1e40af;
    border-color: #93c5fd;
}

.delete-btn {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fecaca;
    font-size: 13px;
}

.delete-btn:hover {
    background: #fee2e2;
    color: #b91c1c;
    border-color: #fca5a5;
}

.post-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    flex-wrap: wrap;
    gap: 8px;
    flex-shrink: 0;
}

.post-actions form {
    margin: 0;
    flex-shrink: 0;
}

.message {
    margin: 18px 0 24px;
    padding: 13px 16px;
    background: #f0fdf4;
    color: #166534;
    border: 1px solid #bbf7d0;
    border-left: 4px solid #22c55e;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    overflow-wrap: anywhere;
}

.post {
    margin-bottom: 18px;
    padding: 22px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.025);
    transition: border-color 0.2s ease,
                box-shadow 0.2s ease;
}

.post:hover {
    border-color: #cbd5e1;
    box-shadow: 0 5px 16px rgba(15, 23, 42, 0.045);
}

.post:last-child {
    margin-bottom: 0;
}

.post-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 18px;
    padding-bottom: 16px;
    border-bottom: 1px solid #e9eef5;
}

.post h3 {
    margin: 0;
    color: #0f172a;
    font-size: 19px;
    font-weight: 700;
    line-height: 1.5;
    overflow-wrap: anywhere;
    min-width: 0;
}

.post form {
    margin: 0;
    flex-shrink: 0;
}

.description {
    margin-top: 16px;
    color: #475569;
    font-size: 14px;
    line-height: 1.85;
    white-space: pre-wrap;
    overflow-wrap: anywhere;
    word-break: normal;
}

.container > p {
    margin: 24px 0 0;
    padding: 22px;
    color: #64748b;
    background: #f8fafc;
    border: 1px dashed #cbd5e1;
    border-radius: 10px;
    text-align: center;
    font-size: 14px;
}

button:focus-visible,
a:focus-visible {
    outline: 3px solid #93c5fd;
    outline-offset: 3px;
}
    </style>
</head>

<body>
    <div class="container">
        <h2>
            Posts by {{ $guest->firstname }} {{ $guest->lastname }}
        </h2>

        
        <div class="top-actions">
            <a href="{{ route('guests.index') }}">Back to Home</a>
            @if (auth()->user()->role == 'admin')
                <a class="btn" href="{{ route('guests.posts.create', $guest) }}">
                    Create Post
                </a>
            @endif
        </div> 

        @if (session('success'))
            <div id="flash-message" class="message">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function () {
                    const flash = document.getElementById('flash-message');

                    if (flash) {
                        flash.style.transition = 'opacity 0.5s ease';
                        flash.style.opacity = '0';

                        setTimeout(() => flash.remove(), 500);
                    }
                }, 2000);
            </script>
        @endif

        @if ($posts->isEmpty())
            <p>No posts yet.</p>
        @else
            @foreach ($posts as $post)
                <div class="post">
                    <div class="post-header">
                        <h3>{{ $post->title }}</h3>
                        @if (auth()->user()->role == 'admin')
                            <div class="post-actions">
                            <a
                                class="btn edit-btn"
                                href="{{ route('guests.posts.edit', [$guest, $post]) }}">
                                Edit
                            </a>
                        
                            <form
                                action="{{ route('guests.posts.destroy', [$guest, $post]) }}"
                                method="POST"
                                onsubmit="return confirm('Delete this post?')"
                            >
                                @csrf
                                @method('DELETE')
                        
                                <button class="btn delete-btn" type="submit">
                                    Delete
                                </button>
                            </form>
                        </div>
                        @endif    
                    </div>

                    <div class="description">{{ $post->description }}</div>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
