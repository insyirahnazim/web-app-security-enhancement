<div class="logo">
            <img src="images/roket.png" alt="Rocket Icon">
            <h1>BOOK!</h1>
        </div>
        <nav>
            <ul>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('badminton') }}">Badminton</a></li>
            </ul>
        </nav>
        <div class="search">
            <img src="images/search.png" alt="Search Icon" id="search-icon">
        </div>
        <div class="auth">
            @guest
                <!-- If the user is not logged in, show the Sign In button -->
                <button id="sign-in-btn">SIGN IN</button>
            @else
                <!-- If the user is logged in, show the Sign Out button -->
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" id="sign-out-btn">LOG OUT</button>
                </form>
            @endguest
            <div class="profile-pic">
                <img src="images/profile.png" alt="Profile Picture">
            </div>
        </div>
