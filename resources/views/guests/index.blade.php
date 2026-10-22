
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guests</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #333;
            margin: 30px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        h2 {
            margin-top: 0;
        }

        a {
            color: #2563eb;
            text-decoration: none;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .nav {
            margin: 20px 0;
        }

        .nav a {
            display: inline-block;
            padding: 9px 14px;
            background: #2563eb;
            color: white;
            border-radius: 4px;
            margin-bottom: 5px;
        }

        .nav a:hover {
            background: #1d4ed8;
            text-decoration: none;
        }

        button {
            padding: 8px 14px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .delete-btn {
            background: none;
            color: #dc2626;
            padding: 0;
            font: inherit;
        }

        .delete-btn:hover {
            background: none;
            text-decoration: underline;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 12px;
            white-space: nowrap;
        }

        .actions a {
            margin: 0;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px 14px;
            text-align: left;
        }

        th {
            background: #f4f4f4;
        }

        tr:hover {
            background: #fafafa;
        }

        img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-info {
            font-size: 14px;
            color: #666;
        }

        .success {
            padding: 10px;
            background: #dcfce7;
            color: #166534;
            border-radius: 4px;
        }

        @media (max-width: 600px) {
            body {
                margin: 10px;
            }

            .container {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Home</h2>

            <div>
                <span class="user-info">
                    {{ auth()->user()->name }}/ {{ auth()->user()->role }}
                </span>

                <form action="{{ route('logout') }}" method="POST"
                      style="display: inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>

        <p class="user-info">
            Logged in as: {{ auth()->user()->email }}
        </p>

        @if (session('success'))
            <p id="flash-message" class="success">{{ session('success') }}</p>
        @endif

        <script>
        setTimeout(function() {
            let flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.transition = 'opacity 0.5s ease';
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500);
            }
        }, 2000); 
    </script>
        @if (auth()->user()->role == 'admin')
        <div class="nav">
            <a href="{{ route('guests.create') }}">Create Guest</a>
            <a href="{{ route('guests.deleted') }}">Deleted Guests</a>
        </div>
        @endif

        @if ($guests->isEmpty())
            <p>No records found.</p>
        @else
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($guests as $guest)
                            <tr>
                                <td>{{ $guest->id }}</td>

                                <td>
                                    @if ($guest->profile_image)
                                        <img
                                            src="{{ asset('storage/' . $guest->profile_image) }}"
                                            alt="Profile photo"
                                        >
                                    @else
                                        No photo
                                    @endif
                                </td>

                                <td>{{ $guest->firstname }}</td>
                                <td>{{ $guest->lastname }}</td>
                                <td>{{ $guest->email }}</td>

                                <td>
                                    <div class="actions">   
                                        @if (auth()->user()->role == 'admin')
                                            <a href="{{ route('guests.edit', $guest) }}">
                                                Edit
                                            </a>
                                            <form
                                            action="{{ route('guests.destroy', $guest) }}"
                                            method="POST"
                                            onsubmit="return confirm('Delete this record?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            
                                            
                                            <button class="delete-btn" type="submit">
                                                Delete
                                            </button>
                                        </form>
                                        @endif

                                        <a href="{{ route('guests.posts.index', $guest) }}">
                                            Posts
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>
