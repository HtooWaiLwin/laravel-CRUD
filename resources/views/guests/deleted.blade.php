
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Guests</title>

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

        .back-link {
            display: inline-block;
            margin-bottom: 15px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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

        .actions {
            display: flex;
            align-items: center;
            gap: 12px;
            white-space: nowrap;
        }

        .actions form {
            display: inline;
            margin: 0;
        }

        button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .restore-btn {
            background: #2563eb;
            color: white;
        }

        .restore-btn:hover {
            background: #1d4ed8;
        }

        .delete-btn {
            background: #dc2626;
            color: white;
        }

        .delete-btn:hover {
            background: #b91c1c;
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
        <h2>Deleted Guests</h2>

        <a class="back-link" href="{{ route('guests.index') }}">
            &larr; Back to Home
        </a>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if ($guests->isEmpty())
            <p>No deleted records found.</p>
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
                                        <form
                                            action="{{ route('guests.restore', $guest->id) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                class="restore-btn"
                                                type="submit"
                                            >
                                                Restore
                                            </button>
                                        </form>

                                        <form
                                            action="{{ route('guests.forceDelete', $guest->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Permanently delete this guest? This cannot be undone.')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="delete-btn"
                                                type="submit"
                                            >
                                                Delete
                                            </button>
                                        </form>
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
