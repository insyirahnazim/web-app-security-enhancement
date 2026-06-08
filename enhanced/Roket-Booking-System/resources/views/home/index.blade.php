<!DOCTYPE html>
<html lang="en">
<head>
@include('home.css')
</head>
<body>
    <header>
        @include('home.header')
    </header>
    <main>
        <section class="content">
            <div class="card" id="card1">
                <img src="images/badminton-court-Teamsports-Arena-at-Suntec.webp" alt="Example Image 1">
                <div class="card-text">
                    <h3>Premium Badminton Courts</h3>
                    <p>
                        Experience the best badminton courts at Rocket Court! Designed with professional-grade flooring, exceptional lighting, and 
                        ample space for competitive play, our courts ensure a seamless playing experience. Whether you're training, competing, or 
                        just enjoying a casual game, Rocket Court is the perfect destination for badminton enthusiasts.
                    </p>
                </div>
            </div>
            <div class="card" id="card2">
                <img src="images/IMG-20230207-WA0010.jpg" alt="Example Image 2">
                <div class="card-text">
                    <h3>Book Your Court Today</h3>
                    <p>
                        Make your game day hassle-free with our easy-to-use booking system. Reserve your court in 
                        just a few clicks and enjoy the convenience of flexible scheduling. Don't miss out on your 
                        chance to play at Rocket Court, the ultimate destination for badminton players of all skill levels.
                    </p>
                </div>
            </div>
        </section>
    </main>
    <footer>
       @include('home.footer')
    </footer>
</body>
</html>
