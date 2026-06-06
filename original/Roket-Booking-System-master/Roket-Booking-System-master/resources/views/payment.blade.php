<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <img src="{{ asset('images/roket.png') }}" alt="Rocket Icon">
            <h1>BOOK!</h1>
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('home.index') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('badminton') }}" class="active">Badminton</a></li>
            </ul>
        </nav>
        <div class="search">
            <img src="{{ asset('images/search.png') }}" alt="Search Icon" id="search-icon">
        </div>
        <div class="auth">
            @guest
                <button id="sign-in-btn" onclick="window.location='{{ route('login') }}'">SIGN IN</button>
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

    <!-- Main Content -->
    <main>
        <section class="booking-details">
            <h2>Your Booking</h2>
            <div class="court-info">
                <img src="{{ asset('images/badcout.png') }}" alt="Court Image">
                <div class="details">
                    <p><strong class="court-name">{{ $courtName ?? 'Court Name' }}</strong></p>
                    <p>Details:</p>
                    <ul id="selected-timeslots">
                        <!-- Timeslots will be dynamically populated here -->
                    </ul>
                    <p><strong>Total:</strong> <span id="total-amount">RM 0.00</span></p>
                </div>
            </div>
        </section>

        <section class="payment-method">
            <h2>Payment Method</h2>
            <div class="payment-options">
                <label>
                    <input type="radio" name="payment" value="Maybank2u">
                    <span>Maybank2u</span>
                </label>
                <label>
                    <input type="radio" name="payment" value="CIMB Click">
                    <span>CIMB Click</span>
                </label>
                <label>
                    <input type="radio" name="payment" value="RHB Now">
                    <span>RHB Now</span>
                </label>
                <label>
                    <input type="radio" name="payment" value="Bank Islam">
                    <span>Bank Islam</span>
                </label>
                <label>
                    <input type="radio" name="payment" value="Bank Rakyat">
                    <span>Bank Rakyat</span>
                </label>
            </div>
        </section>
        <button id="proceed-payment" class="pay-button">Pay Booking</button>
    </main>

    <!-- Footer -->
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

    <!-- Link to External JS File -->
    <script src="{{ asset('js/payment.js') }}"></script>
</body>
</html>
