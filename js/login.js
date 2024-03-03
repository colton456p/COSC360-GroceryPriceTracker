document.getElementById('loginForm').addEventListener('submit', function(e) {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
    
    if (!emailPattern.test(username)) {
        alert("Please enter a valid email address.");
        e.preventDefault(); 
        return false;
    }

    if (password.length < 8) { 
        alert("Password must be at least 8 characters long.");
        e.preventDefault(); 
        return false;
    }

    return true; 
});
