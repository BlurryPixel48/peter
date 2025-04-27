<!DOCTYPE html>
<?php
$server = "localhost";
$user = "root";
$pass = "";
$conn = mysqli_connect($server, $user, $pass, "bdl");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);  // Användning av MD5, tänk på säkerhet för framtida system
    $remember_me = isset($_POST['remember_me']) ? 1 : 0;

    // Exempel på att lagra användare, anpassa query för din databasstruktur
    $sql = "INSERT INTO rk (email, password, remember_me) VALUES ('$email', '$password', '$remember_me')";
    $result = mysqli_query($conn, $sql);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="logo">
        <img src="TechSolve AB logo.png" alt="logo">
    </div>

    <div class="login-container">
        <form action="login.php" method="POST">
            <h2>Logga in</h2>
            <div class="input-container">
                <input type="email" name="email" placeholder="Ange din e-post" required>
            </div>
            <div class="input-container">
                <input type="password" name="password" placeholder="Ange ditt lösenord" required>
            </div>
            <div class="checkbox-container">
                <label>
                    <input type="checkbox" name="remember_me"> Kom ihåg mig
                </label>
            </div>
            <button type="submit" name="submit" class="btn">Logga in</button>
            <div class="forgot-password">
                <a href="#">Glömt lösenord?</a>
            </div>
        </form>
    </div>
</body>
</html>
