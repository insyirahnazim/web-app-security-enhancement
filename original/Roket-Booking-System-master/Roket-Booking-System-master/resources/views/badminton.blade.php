<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badminton Court Booking</title>
    <!-- Use asset helper to link CSS file -->
    <link rel="stylesheet" href="{{ asset('css/badminton.css') }}">
</head>
<body 
    data-logged-in="{{ auth()->check() ? 'true' : 'false' }}" 
    data-logout-route="{{ route('logout') }}" 
    data-login-route="{{ route('login') }}" 
    data-booking-route="{{ route('court.booking') }}"
>
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
            <button id="sign-in-btn" data-action="login">SIGN IN</button>
        @else
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" id="sign-out-btn" data-action="logout">LOG OUT</button>
            </form>
        @endguest
        <div class="profile-pic">
            <img src="{{ asset('images/profile.png') }}" alt="Profile Picture">
        </div>
    </div>
</header>


    <!-- Main Content -->
    <main>
    <!-- Search Bar -->
    <div class="search-bar">
        <input id="search-input" type="text" placeholder="Search by day or court..." />
        <button id="search-button">Search</button>
    </div>

    <!-- Schedule Section -->
    <div id="schedule" class="schedule">
        @foreach(['Sunday' => '15/12/2024', 'Monday' => '16/12/2024', 'Tuesday' => '17/12/2024', 
                 'Wednesday' => '18/12/2024', 'Thursday' => '19/12/2024', 'Friday' => '20/12/2024', 
                 'Saturday' => '21/12/2024'] as $day => $date)
            <div class="day" data-day="{{ $day }}">
                <div class="day-header">{{ $day }}<br><span>{{ $date }}</span></div>
                <div class="courts">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="court" data-day="{{ $day }}" data-court-number="{{ $i }}">
                            <img src="{{ asset('images/badcout.png') }}" alt="Court Image">
                            <span>Court {{ $i }}</span>
                        </div>
                    @endfor
                </div>
            </div>
        @endforeach
    </div>
</main>

    <!-- Footer Section -->
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

    <!-- JavaScript -->
    <script src="{{ asset('js/badminton.js') }}"></script>
</body>
</html>
