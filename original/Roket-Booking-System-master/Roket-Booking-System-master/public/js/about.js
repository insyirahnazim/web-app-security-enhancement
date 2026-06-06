// Check user login state
const isLoggedIn = localStorage.getItem("isLoggedIn");
const authButton = document.getElementById("sign-in-btn");

if (isLoggedIn) {
  // User is logged in
  authButton.textContent = "LOG OUT";
  authButton.addEventListener("click", function () {
    // Log out the user
    localStorage.removeItem("isLoggedIn");
    window.location.href = "signin.html"; // Redirect to sign-in page
  });
} else {
  // User is not logged in
  authButton.textContent = "SIGN IN";
  authButton.addEventListener("click", function () {
    window.location.href = "signin.html"; // Redirect to sign-in page
  });
}
