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
            
            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>

                <div class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Keep me logged in</label>
                </div>

                <button type="submit" class="btn primary-btn">Sign in</button>

                <div class="separator">
                    <hr class="line">
                    <span class="or-text">or</span>
                    <hr class="line">
                </div>

                <button type="button" class="btn google-btn">Sign in with Google</button>
                <p>Need an account? <a href="{{ route('register') }}">Create one</a></p>
            </form>
        </div>
        
        <!-- Image Section -->
        <div class="image-box">
            <img src="{{ asset('images/roket wall.jpeg') }}" alt="Rocket Launch">
        </div>
    </div>

    <script src="{{ asset('js/signin.js') }}"></script>
</body>
</html>
