if ($_SERVER["REQUEST_METHOD"] == "POST"){
$email = $_POST['email'];
$password = $_POST['password'];

<!-- if ($email ==="this@email.com" && $password === "password"){
    header("Location: dashboard.html");
        exit();
} -->

echo "email: ".$email." password: ".$password;
}