<?php
session_start(); 

$server = "localhost";
$user = "root";
$pass = "";
$conn = mysqli_connect($server, $user, $pass, "bdl");

$error_message = ''; 

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);  

    
    $sql = "SELECT * FROM rk WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];  
        $_SESSION['email'] = $user['email'];  
        header("Location: index.php"); 
        exit();
    } else {
        $error_message = "Fel e-post eller lösenord!";
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
    
    <div class="logo">
        <img src="TechSolve AB logo.png" alt="TechSolve AB Logo">
    </div>

    <div class="login-container">
        <form action="login.php" method="POST">
            <h2>Logga in</h2>
            
            
            <?php if ($error_message): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

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
            
            <div class="register-link">
                <p>Har du inget konto? <a href="signup.php">Registrera dig här</a></p>
            </div>
        </form>
    </div>

</body>
</html>
