// Add hover effect on cards
const cards = document.querySelectorAll('.card');
cards.forEach((card) => {
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'scale(1.05)';
        card.style.transition = 'transform 0.3s';
    });
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'scale(1)';
    });
});

// Simulate search functionality
document.getElementById('search-icon').addEventListener('click', () => {
    const searchTerm = prompt('Enter your search term:');
    if (searchTerm) {
        alert(`Searching for "${searchTerm}"...`);
    }
});

// Check user login state
const isLoggedIn = localStorage.getItem("isLoggedIn");
const authButton = document.getElementById("sign-in-btn");

if (isLoggedIn) {
    // User is logged in
    authButton.textContent = "LOG OUT";
    authButton.addEventListener("click", function() {
        // Log out the user
        localStorage.removeItem("isLoggedIn");
        localStorage.removeItem("userEmail"); // Optional: Remove user email
        window.location.href = "signin.html"; // Redirect to sign-in page
    });
} else {
    // User is not logged in
    authButton.textContent = "SIGN IN";
    authButton.addEventListener("click", function() {
        window.location.href = "signin.html"; // Redirect to sign-in page
    });
}
