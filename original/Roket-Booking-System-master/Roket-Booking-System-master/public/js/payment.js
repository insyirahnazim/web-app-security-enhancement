document.addEventListener('DOMContentLoaded', () => {
    // Retrieve court name from query parameters
    const urlParams = new URLSearchParams(window.location.search);
    const courtName = urlParams.get('court'); // Get court name from query parameter

    // Dynamically update the court name
    const courtNameElement = document.querySelector('.court-name');
    if (courtNameElement) {
        courtNameElement.textContent = courtName ? courtName : "Court Not Selected"; // Default court name if none is provided
    }

    // Get the selected timeslots from the URL
    const timeslots = urlParams.get('timeslots');
    const timeslotsElement = document.getElementById('selected-timeslots');
    const totalAmountElement = document.getElementById('total-amount');
    const pricePerHour = 12; // Price for 1 hour
    const proceedButton = document.getElementById('proceed-payment');

    // Display the selected timeslots and calculate the total amount
    if (timeslots) {
        const timeslotArray = timeslots.split(','); // Convert the timeslots into an array
        let totalHours = timeslotArray.length; // Calculate total hours

        // Clear previous timeslot entries
        timeslotsElement.innerHTML = '';

        // Display each selected timeslot
        timeslotArray.forEach(timeslot => {
            const listItem = document.createElement('li');
            listItem.textContent = timeslot;
            timeslotsElement.appendChild(listItem);
        });

        // Calculate and display the total amount
        const totalAmount = totalHours * pricePerHour;
        totalAmountElement.textContent = `RM ${totalAmount.toFixed(2)}`;
    } else {
        // If no timeslots are selected, show a default message
        timeslotsElement.textContent = "No timeslots selected.";
        totalAmountElement.textContent = "RM 0.00";
        proceedButton.disabled = true; // Disable the button if no timeslots
        proceedButton.style.cursor = "not-allowed";
    }

    // Add event listener for the "Pay Booking" button
    proceedButton.addEventListener('click', () => {
        if (!timeslots) {
            alert('No timeslots selected. Please go back and select a timeslot.');
            timeslotsElement.style.color = "red"; // Highlight error in timeslots section
            timeslotsElement.textContent = "Please select timeslots to proceed.";
            return;
        }

        proceedButton.textContent = "Processing...";
        proceedButton.disabled = true;

        setTimeout(() => {
            const isConfirmed = confirm('You have successfully booked your timeslot! Click "OK" to return to the main page.');
            if (isConfirmed) {
                window.location.href = 'home'; // Redirect to main page
            } else {
                proceedButton.textContent = "Pay Booking";
                proceedButton.disabled = false;
            }
        }, 2000); // Simulate a 2-second delay for the payment process
    });

    // Check user login state
    const authButton = document.getElementById('sign-in-btn'); // Ensure your button has this ID
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
