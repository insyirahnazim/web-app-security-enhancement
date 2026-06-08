<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
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
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('badminton') }}">Badminton</a></li>
            </ul>
        </nav>

        <div class="auth">
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" id="sign-out-btn">LOG OUT</button>
            </form>
        </div>
    </header>

    <main>
        <section class="booking-details">
            <h2>Your Booking</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="court-info">
                <img src="{{ asset('images/badcout.png') }}" alt="Court Image">

                <div class="details">
                    <p><strong class="court-name">{{ $courtName }}</strong></p>
                    <p>Details:</p>

                    <ul id="selected-timeslots">
                        @foreach ($timeslotArray as $slot)
                            <li>{{ $slot }}</li>
                        @endforeach
                    </ul>

                    <p><strong>Total:</strong> RM {{ number_format($totalAmount, 2) }}</p>
                </div>
            </div>
        </section>

        <section class="payment-method">
            <h2>Payment Method</h2>

            <form method="POST" action="{{ route('payment.process') }}" id="payment-form">
                @csrf

                <input type="hidden" name="court" value="{{ $courtNumber }}">
                <input type="hidden" name="timeslots" value="{{ $timeslots }}">

                <div class="payment-options">
                    @foreach (['Maybank2u', 'CIMB Click', 'RHB Now', 'Bank Islam', 'Bank Rakyat'] as $method)
                        <label>
                            <input
                                type="radio"
                                name="payment_method"
                                value="{{ $method }}"
                                required
                            >
                            <span>{{ $method }}</span>
                        </label>
                    @endforeach
                </div>

                <button type="submit" id="proceed-payment" class="pay-button">
                    Pay Booking
                </button>
            </form>
        </section>
    </main>

    <footer>
        <div class="footer-info">
            <p>Roket Booking Sdn Bhd</p>
            <p>Roket Court, Batu Caves, Selangor, Malaysia</p>
            <p>Contact Us: +60 182451670</p>
        </div>
    </footer>

    <script src="{{ asset('js/payment.js') }}"></script>
</body>
</html>
