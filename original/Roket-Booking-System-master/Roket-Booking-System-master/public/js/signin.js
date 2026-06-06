// Handle form submission
document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Validate form inputs
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (email && password) {
        // Save the user login state in localStorage
        localStorage.setItem("isLoggedIn", true);
        localStorage.setItem("userEmail", email); // Optional: Save user email

        // Redirect to the main page
        window.location.href = "index.html";
    } else {
        // Show an alert if inputs are missing
        alert("Please fill in both email and password.");
    }
});

// Handle Google Sign In button click (optional functionality)
document.querySelector(".google-btn").addEventListener("click", function() {
    alert("Google Sign-In is not implemented yet."); // Placeholder for Google Sign-In
});
