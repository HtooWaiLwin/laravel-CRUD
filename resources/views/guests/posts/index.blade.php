
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Posts</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #333;
            margin: 30px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 9px 14px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font: inherit;
            text-decoration: none;
        }

        .btn:hover {
            background: #1d4ed8;
            text-decoration: none;
        }

        .delete-btn {
            background: #dc2626;
            font-size: 14px;
        }

        .delete-btn:hover {
            background: #b91c1c;
        }

        .edit-btn {
            background: #2563eb;
            font-size: 14px;
        }
        
        .edit-btn:hover {
            background: #1d4ed8;
        }
        
        .post-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }
        
        .post-actions form {
            margin: 0;
        }

        .message {
            padding: 10px;
            background: #dcfce7;
            color: #166534;
            border-radius: 4px;
            margin: 15px 0;
        }

        .post {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 18px;
            margin-bottom: 15px;
        }

        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
        }

        .post h3 {
            margin: 0;
            font-size: 18px;
            overflow-wrap: anywhere;
        }

        .post form {
            margin: 0;
            flex-shrink: 0;
        }

        .description {
            margin-top: 12px;
            color: #555;
            line-height: 1.6;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        @media (max-width: 600px) {
            body {
                margin: 10px;
            }

            .container {
                padding: 15px;
            }

            .post-header {
                align-items: flex-start;
            }
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
