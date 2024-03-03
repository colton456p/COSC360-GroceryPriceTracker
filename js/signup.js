document.getElementById('signupForm').onsubmit = function(e) {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm-password').value;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email pattern checker

    // Validate Email
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        e.preventDefault(); // Prevent form from submitting
        return false;
    }

    // Validate Password Length
    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        e.preventDefault(); // Prevent form from submitting
        return false;
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        e.preventDefault(); // Prevent form from submitting
        return false;
    }

    return true; // Allow form submission if all checks pass
};
