document.addEventListener('DOMContentLoaded', () => {
    // Authentication Button Handling
    function handleAuthButtons() {
        const signInBtn = document.querySelector('#sign-in-btn');
        const signOutForm = document.querySelector('#sign-out-btn')?.closest('form');
        const isLoggedIn = document.body.dataset.loggedIn === 'true';

        // Handle Sign In
        if (signInBtn && !isLoggedIn) {
            signInBtn.addEventListener('click', () => {
                const loginRoute = document.body.dataset.loginRoute;
                window.location.href = loginRoute;
            });
        }

        // Handle Log Out
        if (signOutForm && isLoggedIn) {
            const signOutBtn = signOutForm.querySelector('#sign-out-btn');
            if (signOutBtn) {
                signOutBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    signOutForm.submit(); // Submit the logout form securely
                });
            }
        }
    }

    // Court Booking Functionality
    function handleCourtBooking() {
        const courts = document.querySelectorAll('.court');
        const bookingRoute = document.body.dataset.bookingRoute;
        const isLoggedIn = document.body.dataset.loggedIn === 'true';

        courts.forEach(court => {
            court.addEventListener('click', () => {
                const day = court.dataset.day;
                const courtNumber = court.dataset.courtNumber;

                if (!isLoggedIn) {
                    alert('Please log in to book a court.');
                    return;
                }

                const confirmBooking = confirm(`Do you want to book Court ${courtNumber} on ${day}?`);
                if (confirmBooking) {
                    const url = `${bookingRoute}?day=${encodeURIComponent(day)}&court=${encodeURIComponent(courtNumber)}`;
                    alert(`Redirecting to booking page for Court ${courtNumber} on ${day}.`);
                    window.location.href = url;
                }
            });
        });
    }

    // Search Functionality
    function handleSearch() {
        const searchInput = document.querySelector('#search-input');
        const searchButton = document.querySelector('#search-button');
        const schedule = document.querySelector('#schedule');

        // Perform the search when the button is clicked or input changes
        function performSearch() {
            const query = searchInput.value.toLowerCase().trim();

            if (!query) {
                // If the search is empty, reset all days and courts to visible
                const days = schedule.querySelectorAll('.day');
                days.forEach(day => day.style.display = '');
                days.forEach(day => {
                    const courts = day.querySelectorAll('.court');
                    courts.forEach(court => (court.style.display = ''));
                });
                return;
            }

            // Filter days and courts based on the query
            const days = schedule.querySelectorAll('.day');
            days.forEach(day => {
                const dayName = day.dataset.day.toLowerCase();
                const courts = day.querySelectorAll('.court');
                let dayMatches = false;

                courts.forEach(court => {
                    const courtName = court.querySelector('span').textContent.toLowerCase();
                    if (dayName.includes(query) || courtName.includes(query)) {
                        court.style.display = ''; // Show court if it matches
                        dayMatches = true;
                    } else {
                        court.style.display = 'none'; // Hide court if it doesn't match
                    }
                });

                // Show or hide the entire day based on court matches
                day.style.display = dayMatches ? '' : 'none';
            });
        }

        // Add event listeners for search
        searchButton.addEventListener('click', performSearch);
        searchInput.addEventListener('input', performSearch);
    }

    // Initialize All Handlers
    handleAuthButtons();
    handleCourtBooking();
    handleSearch();
});
