<!DOCTYPE html>
<?php
$server = "localhost";
$user = "root";
$pass = "";
$conn = mysqli_connect($server, $user, $pass, "bdl");

$error_message = ''; 

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);  
    $password_confirm = md5($_POST['password_confirm']);

    if ($password === $password_confirm) {
        
        $sql = "INSERT INTO rk (email, password) VALUES ('$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "Registrering lyckades!";
        } else {
            echo "Fel vid registrering: " . mysqli_error($conn);
        }
    } else {
        $error_message = 'Lösenorden matchar inte!';  
    }
}
?>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrera Konto</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>

    
    <div class="logo">
        <img src="TechSolve AB logo.png" alt="TechSolve AB Logo">
    </div>

    <div class="signup-container">
        <form action="signup.php" method="POST">
            <h2>Registrera Konto</h2>
            
            
            <?php if ($error_message): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <div class="input-container">
                <input type="email" name="email" placeholder="Ange din e-post" required>
            </div>
            <div class="input-container">
                <input type="password" name="password" placeholder="Ange ditt lösenord" required>
            </div>
            <div class="input-container">
                <input type="password" name="password_confirm" placeholder="Bekräfta ditt lösenord" required>
            </div>
            <button type="submit" name="submit" class="btn">Registrera</button>
            <div class="login-link">
                <p>Har du redan ett konto? <a href="login.php">Logga in här</a></p>
            </div>
        </form>
    </div>

</body>
</html>
