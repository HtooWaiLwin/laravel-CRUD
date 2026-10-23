
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guests</title>

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

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    padding-bottom: 22px;
    border-bottom: 1px solid #e2e8f0;
}

h2 {
    margin: 0;
    color: #0f172a;
    font-size: 28px;
    font-weight: 700;
    letter-spacing: -0.7px;
}

.header > div {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 14px;
}

a {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

a:hover {
    color: #1d4ed8;
    text-decoration: none;
}

.user-info {
    font-size: 13px;
    color: #64748b;
    overflow-wrap: anywhere;
}

.nav {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin: 26px 0;
}

.nav a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 17px;
    background: #2563eb;
    color: #ffffff;
    border: 1px solid #2563eb;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    box-shadow: 0 2px 5px rgba(37, 99, 235, 0.15);
    transition: background 0.2s ease, transform 0.2s ease;
}

.nav a:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
    transform: translateY(-1px);
}

button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 9px 16px;
    background: #2563eb;
    color: #ffffff;
    border: 1px solid #2563eb;
    border-radius: 8px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease, box-shadow 0.2s ease;
}

button:hover {
    background: #1d4ed8;
    box-shadow: 0 3px 8px rgba(37, 99, 235, 0.2);
}

button:focus-visible,
a:focus-visible {
    outline: 3px solid #93c5fd;
    outline-offset: 3px;
}

.delete-btn {
    background: transparent;
    color: #dc2626;
    border: none;
    padding: 0;
    font: inherit;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: none;
}

.delete-btn:hover {
    background: transparent;
    color: #991b1b;
    text-decoration: underline;
    box-shadow: none;
}

.actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 14px;
    white-space: nowrap;
}

.actions a {
    font-size: 13px;
    font-weight: 600;
}

.actions form {
    display: inline-flex;
    align-items: center;
    margin: 0;
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;
    margin-top: 24px;
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
    border-bottom: 1px solid #e9eef5;
    vertical-align: middle;
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

.success {
    margin: 20px 0;
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

.container > p:not(.user-info):not(.success) {
    color: #64748b;
    font-size: 14px;
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
