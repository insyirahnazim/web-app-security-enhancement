<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court Booking</title>
    <link rel="stylesheet" href="{{ asset('css/court.css') }}">
</head>
<body
    data-payment-route="{{ route('payment.show') }}"
    data-court-number="{{ $courtNumber }}"
>
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
        <section class="court">
            <h2>{{ $courtName }}</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($timeSlots as $slot)
                        <tr>
                            <td>{{ $slot['time'] }}</td>
                            <td>{{ $slot['status'] }}</td>
                            <td>
                                @if ($slot['status'] === 'Available')
                                    <button
                                        type="button"
                                        class="book-btn"
                                        data-time="{{ $slot['time'] }}"
                                    >
                                        Book
                                    </button>
                                @else
                                    <button type="button" class="book-btn" disabled>
                                        Booked
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button id="book-now-btn" class="book-now-btn" type="button">BOOK NOW!</button>
        </section>
    </main>

    <footer>
        <div class="footer-info">
            <p>Roket Booking Sdn Bhd</p>
            <p>Roket Court, Batu Caves, Selangor, Malaysia</p>
            <p>Contact Us: +60 182451670</p>
        </div>
    </footer>

    <script src="{{ asset('js/court.js') }}"></script>
</body>
</html>
