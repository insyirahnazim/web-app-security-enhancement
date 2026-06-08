<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Rocket Court</title>
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/roket.png') }}" alt="Rocket Icon">
            <h1>BOOK!</h1>
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('home.index') }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="active">About Us</a></li>
                <li><a href="{{ route('badminton') }}">Badminton</a></li>
            </ul>
        </nav>
        <div class="search">
            <img src="{{ asset('images/search.png') }}" alt="Search Icon" id="search-icon">
        </div>
        <div class="auth">
            @guest
                <button id="sign-in-btn">SIGN IN</button>
            @else
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" id="sign-out-btn">LOG OUT</button>
                </form>
            @endguest
            <div class="profile-pic">
                <img src="{{ asset('images/profile.png') }}" alt="Profile Picture">
            </div>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero-heading">
                <img src="{{ asset('images/rok.png') }}" alt="Rocket Icon">
                <h1>Rocket Court</h1>
            </div>
            <div class="image-placeholder">
                <img src="{{ asset('images/badminton hall.jpg') }}" alt="About Rocket Court">
            </div>
            <p class="description">
                Welcome to Rocket Court! We are dedicated to providing state-of-the-art sports facilities for badminton enthusiasts. Located in Batu Caves, Selangor, Rocket Court is your ultimate destination for premium courts and exceptional services.
            </p>
        </section>

        <section class="info">
            <div class="info-card">
                <span>⏰</span>
                <p><strong>Operating Hours:</strong> Daily: 7:00 AM - 3:00 AM</p>
            </div>
            <div class="info-card">
                <span>📍</span>
                <p><strong>Address:</strong> Rocket Court, Batu Caves, Selangor, Malaysia</p>
            </div>
            <div class="info-card">
                <span>📞</span>
                <p><strong>Contact Number:</strong> 018-2451670 (Binya)</p>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-info">
            <p>Roket Booking Sdn Bhd</p>
            <p>Roket Court, Batu Caves, Selangor, Malaysia</p>
            <p>Contact Us: +60 182451670</p>
        </div>
        <div class="social-section">
            <span class="follow-text">Follow Us:</span>
            <div class="social-icons">
                <a href="#"><img src="{{ asset('images/fb white.png') }}" alt="Facebook"></a>
                <a href="#"><img src="{{ asset('images/whatsapp white.png') }}" alt="WhatsApp"></a>
                <a href="#"><img src="{{ asset('images/telegram white.png') }}" alt="Telegram"></a>
                <a href="#"><img src="{{ asset('images/insta.png') }}" alt="Instagram"></a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/about.js') }}"></script>
</body>
</html>
