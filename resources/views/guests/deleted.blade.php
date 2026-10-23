
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Guests</title>

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
    max-width: 1200px;
    margin: 0 auto;
    padding: 32px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
}

h2 {
    margin: 0 0 22px;
    color: #0f172a;
    font-size: 28px;
    font-weight: 700;
    letter-spacing: -0.7px;
}

a {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease, background 0.2s ease;
}

a:hover {
    color: #1d4ed8;
    text-decoration: none;
}

.back-link {
    display: inline-flex;
    align-items: center;
    margin: 0 0 22px;
    padding: 9px 14px;
    background: #f8fafc;
    color: #475569;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
}

.back-link:hover {
    background: #eff6ff;
    color: #1d4ed8;
    border-color: #bfdbfe;
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;
    margin-top: 22px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    background: #ffffff;
}

table {
    width: 100%;
    min-width: 760px;
    border-collapse: separate;
    border-spacing: 0;
    margin: 0;
    background: #ffffff;
}

th,
td {
    padding: 15px 18px;
    text-align: left;
    vertical-align: middle;
    border-bottom: 1px solid #e9eef5;
}

th {
    background: #f8fafc;
    color: #475569;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.7px;
    white-space: nowrap;
}

td {
    color: #334155;
    font-size: 14px;
}

tbody tr {
    transition: background 0.2s ease;
}

tbody tr:hover {
    background: #f8fbff;
}

tbody tr:last-child td {
    border-bottom: none;
}

td img {
    display: block;
    width: 46px;
    height: 46px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #e2e8f0;
    background: #f1f5f9;
}

.actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    white-space: nowrap;
}

.actions form {
    display: inline-flex;
    align-items: center;
    margin: 0;
}

button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 9px 14px;
    border: 1px solid transparent;
    border-radius: 7px;
    font-family: inherit;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
}

button:hover {
    transform: translateY(-1px);
}

button:active {
    transform: translateY(0);
}

.restore-btn {
    background: #eff6ff;
    color: #1d4ed8;
    border-color: #bfdbfe;
}

.restore-btn:hover {
    background: #dbeafe;
    box-shadow: 0 2px 6px rgba(37, 99, 235, 0.12);
}

.delete-btn {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fecaca;
}

.delete-btn:hover {
    background: #fee2e2;
    box-shadow: 0 2px 6px rgba(220, 38, 38, 0.1);
}

button:focus-visible,
a:focus-visible {
    outline: 3px solid #93c5fd;
    outline-offset: 3px;
}

.success {
    margin: 18px 0;
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

.container > p:not(.success) {
    color: #64748b;
    font-size: 14px;
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
