
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ isset($guest) ? 'Edit Guest' : 'Create Guest' }}</title>

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
    max-width: 480px;
    margin: 0 auto;
    padding: 35px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 10px 35px rgba(15, 23, 42, 0.07);
}

h2 {
    margin: 0 0 28px;
    color: #0f172a;
    font-size: 27px;
    font-weight: 700;
    letter-spacing: -0.6px;
    line-height: 1.3;
}

.form-group {
    margin-bottom: 22px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #334155;
    font-size: 13px;
    font-weight: 600;
}

input {
    display: block;
    width: 100%;
    min-height: 45px;
    padding: 11px 13px;
    font-family: inherit;
    font-size: 14px;
    color: #1e293b;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    outline: none;
    transition: border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
}

input:hover {
    border-color: #94a3b8;
}

input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

input::placeholder {
    color: #94a3b8;
}

input[type="file"] {
    min-height: auto;
    padding: 9px;
    background: #f8fafc;
    border: 1px dashed #cbd5e1;
    cursor: pointer;
    font-size: 12px;
}

input[type="file"]:hover {
    background: #f1f5f9;
    border-color: #2563eb;
}

input[type="file"]::file-selector-button {
    margin-right: 12px;
    padding: 8px 12px;
    color: #1d4ed8;
    background: #eff6ff;
    border: none;
    border-radius: 6px;
    font-family: inherit;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease;
}

input[type="file"]::file-selector-button:hover {
    background: #dbeafe;
}

button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 43px;
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
    min-height: 43px;
    margin-left: 10px;
    padding: 10px 14px;
    color: #475569;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: background 0.2s ease,
                color 0.2s ease;
}

a:hover {
    color: #1d4ed8;
    background: #eff6ff;
    text-decoration: none;
    border-color: #bfdbfe;
}

button:focus-visible,
a:focus-visible,
input:focus-visible {
    outline: 3px solid #93c5fd;
    outline-offset: 3px;
}

.error {
    display: block;
    margin-top: 7px;
    color: #dc2626;
    font-size: 12px;
    font-weight: 500;
    overflow-wrap: anywhere;
}

input[aria-invalid="true"] {
    border-color: #dc2626;
}

.current-image {
    display: block;
    width: 76px;
    height: 76px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 12px;
    border: 3px solid #e2e8f0;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
}

@media (max-width: 520px) {
    body {
        padding: 20px 12px;
        align-items: flex-start;
    }

    .container {
        margin: auto 0;
        padding: 25px 20px;
        border-radius: 12px;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 24px;
    }

    .form-group {
        margin-bottom: 19px;
    }

    button,
    a {
        min-height: 42px;
    }
}

@media (max-width: 360px) {
    .container {
        padding: 22px 15px;
    }

    button {
        padding: 10px 14px;
    }

    a {
        margin-left: 5px;
        padding: 10px;
    }
}

@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        transition: none !important;
    }
}

    </style>
</head>

<body>
    <div class="container">
        <h2>{{ isset($guest) ? 'Update Guest' : 'Create Guest' }}</h2>

        <form
            action="{{ isset($guest) ? route('guests.update', $guest) : route('guests.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            @if (isset($guest))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="firstname">First Name</label>
                <input
                    type="text"
                    id="firstname"
                    name="firstname"
                    value="{{ old('firstname', $guest->firstname ?? '') }}"
                >
                @error('firstname')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input
                    type="text"
                    id="lastname"
                    name="lastname"
                    value="{{ old('lastname', $guest->lastname ?? '') }}"
                >
                @error('lastname')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $guest->email ?? '') }}"
                >
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="profile_image">
                    {{ isset($guest) ? 'Choose a New Image' : 'Profile Image' }}
                </label>

                <input
                    type="file"
                    id="profile_image"
                    name="profile_image"
                    accept="image/jpeg,image/png,image/gif,image/webp"
                >

                @error('profile_image')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">
                {{ isset($guest) ? 'Save Changes' : 'Create' }}
            </button>

            <a href="{{ route('guests.index') }}">
                {{ isset($guest) ? 'Cancel' : 'Home' }}
            </a>
        </form>
    </div>
</body>
</html>
