<div class="logo">
    <img src="{{ asset('images/roket.png') }}" alt="Rocket Icon">
    <h1>BOOK!</h1>
</div>

<nav>
    <ul>
        <li>
            <a href="{{ route('home.index') }}">
                Home
            </a>
        </li>

        <li>
            <a href="{{ route('about') }}">
                About Us
            </a>
        </li>

        <li>
            <a href="{{ route('badminton') }}">
                Badminton
            </a>
        </li>
    </ul>
</nav>

<div class="search">
    <img
        src="{{ asset('images/search.png') }}"
        alt="Search Icon"
        id="search-icon"
    >
</div>

<div class="auth">

    @guest
        <!-- Show Sign In if NOT logged in -->
        <button
            type="button"
            id="sign-in-btn"
            onclick="window.location='{{ route('login') }}'"
        >
            SIGN IN
        </button>
    @else
        <!-- Show Log Out if logged in -->
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf

            <button type="submit" id="sign-out-btn">
                LOG OUT
            </button>
        </form>
    @endguest

    <div class="profile-pic">
        <img
            src="{{ asset('images/profile.png') }}"
            alt="Profile Picture"
        >
    </div>
</div>
