document.addEventListener('DOMContentLoaded', () => {
    // Dynamically update court heading based on URL query parameter
    const urlParams = new URLSearchParams(window.location.search);
    const courtNumber = urlParams.get('court'); // Get court number from query parameter

    if (courtNumber) {
        const courtHeading = document.querySelector('.court h2');
        courtHeading.textContent = courtNumber; // Dynamically update the court name
    }

    const tableBody = document.querySelector('table tbody');

    const timeslots = [
        { time: "07:00 - 08:00", status: "Occupied", available: false },
        { time: "08:00 - 09:00", status: "Occupied", available: false },
        { time: "09:00 - 10:00", status: "Occupied", available: false },
        { time: "10:00 - 11:00", status: "Occupied", available: false },
        { time: "11:00 - 12:00", status: "Occupied", available: false },
        { time: "12:00 - 13:00", status: "Available", available: true },
        { time: "13:00 - 14:00", status: "Available", available: true },
        { time: "14:00 - 15:00", status: "Occupied", available: false },
        { time: "15:00 - 16:00", status: "Occupied", available: false },
        { time: "16:00 - 17:00", status: "Occupied", available: false },
        { time: "17:00 - 18:00", status: "Occupied", available: false },
        { time: "18:00 - 19:00", status: "Occupied", available: false },
        { time: "19:00 - 20:00", status: "Occupied", available: false },
        { time: "20:00 - 21:00", status: "Occupied", available: false },
        { time: "21:00 - 22:00", status: "Occupied", available: false },
        { time: "22:00 - 23:00", status: "Occupied", available: false },
        { time: "23:00 - 00:00", status: "Occupied", available: false },
        { time: "01:00 - 02:00", status: "Available", available: true },
        { time: "02:00 - 03:00", status: "Available", available: true },
    ];

    let selectedSlots = []; // Store selected slots

    // Populate table with timeslots
    const populateTable = () => {
        tableBody.innerHTML = ""; // Clear the table body
        timeslots.forEach((slot, index) => {
            const row = document.createElement('tr');

            const timeCell = document.createElement('td');
            timeCell.textContent = slot.time;
            row.appendChild(timeCell);

            const statusCell = document.createElement('td');
            statusCell.textContent = slot.status;
            statusCell.className = slot.available ? 'available' : 'not-available';
            row.appendChild(statusCell);

            const actionCell = document.createElement('td');
            if (slot.available) {
                const bookButton = document.createElement('button');
                bookButton.textContent = "Book";
                bookButton.className = "book-btn";
                bookButton.addEventListener('click', () => {
                    handleSlotSelection(slot, index, bookButton);
                });
                actionCell.appendChild(bookButton);
            } else {
                actionCell.textContent = "-";
            }
            row.appendChild(actionCell);

            tableBody.appendChild(row);
        });
    };

    // Handle slot selection logic
    const handleSlotSelection = (slot, index, bookButton) => {
        if (selectedSlots.includes(slot.time)) {
            alert(`You have already selected the timeslot: ${slot.time}`);
            return;
        }
        selectedSlots.push(slot.time); // Add the selected slot to the list
        bookButton.textContent = "Booked";
        bookButton.disabled = true;
        bookButton.classList.add("disabled");
        alert(`You have selected the timeslot: ${slot.time}`);
    };

    // Add event listener to "BOOK NOW!" button
const bookNowButton = document.getElementById('book-now-btn'); // Use the unique ID
bookNowButton.addEventListener('click', () => {
    if (selectedSlots.length === 0) {
        alert('Please select at least one timeslot to book.');
        return;
    }

    // Get the court number (from the query parameter in the URL)
    const courtNumber = urlParams.get('court');

    // Redirect to payment route, passing the selected slots via URL parameters
    alert(`You have selected these timeslots: ${selectedSlots.join(', ')}`);
    window.location.href = `/payment?court=${encodeURIComponent(courtNumber)}&timeslots=${encodeURIComponent(selectedSlots.join(','))}`;
});


    // Initialize the table on page load
    populateTable();

    // Check user login state
    const authButton = document.getElementById('sign-in-btn');
    const isLoggedIn = localStorage.getItem('isLoggedIn');

    if (isLoggedIn) {
        // User is logged in
        authButton.textContent = 'LOG OUT';
        authButton.addEventListener('click', function () {
            // Log out the user
            localStorage.removeItem('isLoggedIn');
            alert('You have successfully logged out.');
            window.location.href = 'signin.html'; // Redirect to sign-in page
        });
    } else {
        // User is not logged in
        authButton.textContent = 'SIGN IN';
        authButton.addEventListener('click', function () {
            window.location.href = 'signin.html'; // Redirect to sign-in page
        });
    }
});
