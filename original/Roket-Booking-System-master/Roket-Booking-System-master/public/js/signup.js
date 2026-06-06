document.getElementById("signup-form").addEventListener("submit", function(event) {
    event.preventDefault();
    const name = document.getElementById("name").value;
    const dob = document.getElementById("dob").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (name && dob && email && password) {
        alert("Sign up successful!");
    } else {
        alert("Please fill in all fields.");
    }
});
