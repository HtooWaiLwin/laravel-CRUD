<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        
* {
    box-sizing: border-box;
}

body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f1f5f9;
    color: #1e293b;
    margin: 0;
    padding: 24px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1.6;
}

.auth-card {
    width: 100%;
    max-width: 420px;
    margin: auto;
    padding: 36px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 12px 40px rgba(15, 23, 42, 0.07);
}

h1 {
    margin: 0 0 8px;
    color: #0f172a;
    font-size: 28px;
    font-weight: 700;
    text-align: center;
    letter-spacing: -0.7px;
}

.subtitle {
    margin: 0 0 28px;
    color: #64748b;
    font-size: 14px;
    text-align: center;
}

form {
    width: 100%;
    max-width: none;
    margin: 0;
    padding: 0;
    background: transparent;
    border-radius: 0;
    box-shadow: none;
}

.form-group {
    margin-bottom: 21px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #334155;
    font-size: 13px;
    font-weight: 600;
}

input:not([type="checkbox"]) {
    display: block;
    width: 100%;
    min-height: 46px;
    margin: 0;
    padding: 12px 14px;
    color: #1e293b;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-family: inherit;
    font-size: 14px;
    outline: none;
    transition: border-color 0.2s ease,
                box-shadow 0.2s ease;
}

input:not([type="checkbox"])::placeholder {
    color: #94a3b8;
}

input:not([type="checkbox"]):hover {
    border-color: #94a3b8;
}

input:not([type="checkbox"]):focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

.remember {
    display: flex;
    align-items: center;
    gap: 9px;
    margin: 2px 0 23px;
}

.remember input[type="checkbox"] {
    width: 16px;
    height: 16px;
    margin: 0;
    accent-color: #2563eb;
    cursor: pointer;
    flex-shrink: 0;
}

.remember label {
    margin: 0;
    color: #475569;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
}

button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    min-height: 46px;
    padding: 12px 16px;
    background: #2563eb;
    color: #ffffff;
    border: 1px solid #2563eb;
    border-radius: 8px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
}

button:hover {
    background: #1d4ed8;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
}

button:active {
    transform: translateY(1px);
}

.alert {
    margin: 0 0 20px;
    padding: 12px 14px;
    border-radius: 8px;
    font-size: 13px;
    overflow-wrap: anywhere;
}

.alert ul {
    margin: 0;
    padding-left: 20px;
}

.alert li + li {
    margin-top: 4px;
}

.alert.success {
    color: #166534;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-left: 4px solid #22c55e;
}

.alert.error {
    color: #b91c1c;
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-left: 4px solid #ef4444;
}

.footer {
    margin: 25px 0 0;
    color: #64748b;
    font-size: 13px;
    text-align: center;
}

a {
    color: #2563eb;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.2s ease;
}

a:hover {
    color: #1d4ed8;
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="auth-card">
        <p class="subtitle">Log in to your account</p>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <div class="remember">
                <input id="remember" type="checkbox" name="remember" value="1">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit">Login</button>
        </form>

        <p class="footer">
            Don't have an account?
            <a href="{{ route('register') }}">Register</a>
        </p>
    </div>
</body>
</html>