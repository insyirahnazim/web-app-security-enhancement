<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="logo">
                <img src="{{ asset('images/roket.png') }}" alt="Rocket Logo" class="logo-image">
                <h1>BOOK!</h1>
            </div>

            <h2>Sign in</h2>
            <p>Please login to continue to your account.</p>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" autocomplete="off">
                @csrf

                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    required
                    maxlength="255"
                    pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$"
                >

                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Password"
                    required
                    minlength="8"
                    maxlength="100"
                >

                <div class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember" value="1">
                    <label for="remember">Keep me logged in</label>
                </div>

                <button type="submit" class="btn primary-btn">Sign in</button>

                <p>Need an account? <a href="{{ route('register') }}">Create one</a></p>
            </form>
        </div>

        <div class="image-box">
            <img src="{{ asset('images/roket wall.jpeg') }}" alt="Rocket Launch">
        </div>
    </div>

    <script src="{{ asset('js/signin.js') }}"></script>
</body>
</html>
