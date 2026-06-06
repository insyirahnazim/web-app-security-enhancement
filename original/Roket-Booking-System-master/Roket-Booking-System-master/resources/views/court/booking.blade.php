<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court Booking</title>
    <link rel="stylesheet" href="{{ asset('css/court.css') }}">
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
            @auth
                <div class="profile-pic">
                    <img src="{{ asset('images/profile.png') }}" alt="Profile Picture">
                </div>
                <button id="sign-in-btn" onclick="window.location='{{ route('logout') }}'">LOG OUT</button>
            @else
                <button id="sign-in-btn" onclick="window.location='{{ route('login') }}'">SIGN IN</button>
            @endauth
        </div>
    </header>

    <main>
        <section class="court">
            <h2>{{ $courtName ?? 'Court Name' }}</h2>
            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($timeSlots))
                        @foreach ($timeSlots as $slot)
                            <tr>
                                <td>{{ $slot['time'] }}</td>
                                <td>{{ $slot['status'] }}</td>
                                <td>
                                    @if ($slot['status'] === 'Available')
                                        <button class="book-now" data-time="{{ $slot['time'] }}">Book</button>
                                    @else
                                        <button class="book-now" disabled>Booked</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">No time slots available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <button class="book-now">BOOK NOW!</button>
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

    <script src="{{ asset('js/court.js') }}"></script>
</body>
</html>
