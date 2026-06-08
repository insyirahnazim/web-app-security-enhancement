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
        <div class="signup-box">
            <div class="logo">
                <img src="{{ asset('images/roket.png') }}" alt="Rocket Logo" class="logo-image">
                <h1>BOOK!</h1>
            </div>

            <h2>Sign Up</h2>
            <p>Create your BOOK! account securely.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}" autocomplete="off">
                @csrf

                <label for="name">Your Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Full Name"
                    required
                    minlength="3"
                    maxlength="100"
                    pattern="[A-Za-z\s.'-]+"
                    value="{{ old('name') }}"
                >

                <label for="dob">Date of Birth</label>
                <input
                    type="date"
                    id="dob"
                    name="dob"
                    required
                    value="{{ old('dob') }}"
                    max="{{ now()->subDay()->format('Y-m-d') }}"
                >

                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Email"
                    required
                    maxlength="255"
                    pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$"
                    value="{{ old('email') }}"
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
                    pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}"
                    title="Password must contain uppercase, lowercase, number, and symbol."
                >

                <label for="password_confirmation">Confirm Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    required
                    minlength="8"
                    maxlength="100"
                >

                <button type="submit" class="btn primary-btn">Sign Up</button>

                <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
            </form>
        </div>

        <div class="image-box">
            <img src="{{ asset('images/roket wall.jpeg') }}" alt="Rocket Launch">
        </div>
    </div>

    <script src="{{ asset('js/signup.js') }}"></script>
</body>
</html>
