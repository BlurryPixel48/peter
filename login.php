<?php
session_start(); // Startar en session för att hantera inloggningsdata

// Databasanslutning
$server = "localhost";
$user = "root";
$pass = "";
$conn = mysqli_connect($server, $user, $pass, "bdl");

$error_message = ''; // Variabel för att lagra felmeddelanden

// Kontrollera om formuläret skickats
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);  // Kryptera lösenordet med MD5 (ej säkert i produktion)

    // SQL-fråga för att hitta användaren
    $sql = "SELECT * FROM rk WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Om användaren hittas, logga in och spara data i session
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];  
        $_SESSION['email'] = $user['email'];  
        header("Location: index.php"); // Skicka vidare till startsidan
        exit();
    } else {
        $error_message = "Fel e-post eller lösenord!"; // Felmeddelande om inloggning misslyckas
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css"> 
</head>
<body>

    <!-- Företagslogotyp -->
    <div class="logo">
        <img src="TechSolve AB logo.png" alt="TechSolve AB Logo">
    </div>

    <!-- Inloggningsformulär -->
    <div class="login-container">
        <form action="login.php" method="POST">
            <h2>Logga in</h2>

            <!-- Visa felmeddelande om det finns -->
            <?php if ($error_message): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <!-- E-postfält -->
            <div class="input-container">
                <input type="email" name="email" placeholder="Ange din e-post" required>
            </div>

            <!-- Lösenordsfält -->
            <div class="input-container">
                <input type="password" name="password" placeholder="Ange ditt lösenord" required>
            </div>

            <!-- Kom ihåg mig-ruta -->
            <div class="checkbox-container">
                <label>
                    <input type="checkbox" name="remember_me"> Kom ihåg mig
                </label>
            </div>

            <!-- Inloggningsknapp -->
            <button type="submit" name="submit" class="btn">Logga in</button>

            <!-- Länk till glömt lösenord -->
            <div class="forgot-password">
                <a href="#">Glömt lösenord?</a>
            </div>

            <!-- Länk till registrering -->
            <div class="register-link">
                <p>Har du inget konto? <a href="signup.php">Registrera dig här</a></p>
            </div>
        </form>
    </div>

</body>
</html>
