
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ isset($guest) ? 'Edit Guest' : 'Create Guest' }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #333;
            margin: 30px;
        }

        .container {
            max-width: 450px;
            margin: 30px auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
        }

        input {
            display: block;
            box-sizing: border-box;
            width: 100%;
            padding: 9px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
        }

        button {
            padding: 10px 16px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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
            margin-top: 5px;
            color: red;
            font-size: 14px;
        }

        .current-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
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
