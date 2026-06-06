<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>
<body>
    <div class="container">
        <!-- Sign Up Form Section -->
        <div class="signup-box">
            <div class="logo">
                <img src="{{ asset('images/roket.png') }}" alt="Rocket Logo" class="logo-image">
                <h1>BOOK!</h1>
            </div>
            <h2>Sign Up</h2>
            <p>Sign up to enjoy the features of Revolute.</p>
            <form method="POST" action="{{ route('register') }}">
    @csrf <!-- Laravel CSRF Token for form security -->
    
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

    <!-- Name Field -->
    <label for="name">Your Name</label>
    <input type="text" id="name" name="name" placeholder="Full Name" required value="{{ old('name') }}">

    <!-- Date of Birth Field -->
    <label for="dob">Date of Birth</label>
    <input type="date" id="dob" name="dob" required value="{{ old('dob') }}">

    <!-- Email Field -->
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Email" required value="{{ old('email') }}">

    <!-- Password Field -->
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Password" required>

    <!-- Confirm Password Field -->
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>

    <!-- Sign Up Button -->
    <button type="submit" class="btn primary-btn">Sign Up</button>

    <!-- Separator -->
    <div class="separator">
        <hr class="line">
        <span class="or-text">or</span>
        <hr class="line">
    </div>

    <!-- Google Sign Up Button -->
    <button type="button" class="btn google-btn">Sign up with Google</button>

    <!-- Sign In Link -->
    <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
</form>

        </div>

        <!-- Image Section -->
        <div class="image-box">
            <img src="{{ asset('images/roket wall.jpeg') }}" alt="Rocket Launch">
        </div>
    </div>
    <script src="{{ asset('js/signup.js') }}"></script>
</body>
</html>
