<?php
session_start(); 

$server = "localhost";
$user = "root";
$pass = "";
$conn = mysqli_connect($server, $user, $pass, "bdl");


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titel = $_POST['titel'];
    $beskrivning = $_POST['beskrivning'];
    $kategori = $_POST['kategori'];
    $prioritet = $_POST['prioritet'];
    $skapad_av = $_SESSION['email']; 
    $datum = date('Y-m-d H:i:s');  

    
    $stmt = mysqli_prepare($conn, "INSERT INTO ärenden (titel, beskrivning, kategori, prioritet, skapad_av, datum) VALUES (?, ?, ?, ?, ?, ?)");
    
    
    mysqli_stmt_bind_param($stmt, "ssssss", $titel, $beskrivning, $kategori, $prioritet, $skapad_av, $datum);

    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Fel vid skapande av ärende: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skapa Ärende</title>
    <link rel="stylesheet" href="create_ticket.css">
</head>
<body>

<div class="ticket-container">
    <div class="logo-container">
        <img src="TechSolve AB logo.png" alt="TechSolve AB" class="logo">
    </div>

    <h2>Skapa Nytt Ärende</h2>

    <form action="create_ticket.php" method="POST">
        <div class="input-container">
            <label for="titel">Titel</label>
            <input type="text" name="titel" id="titel" required>
        </div>

        <div class="input-container">
            <label for="beskrivning">Beskrivning</label>
            <textarea name="beskrivning" id="beskrivning" rows="4" required></textarea>
        </div>

        <div class="input-container">
    <label for="kategori">Kategori</label>
    <select name="kategori" id="kategori" required>
        <option value="Tekniskt Problem">Tekniskt Problem</option>
        <option value="Faktura">Faktura</option>
        <option value="Kontoärende">Kontoärende</option>
        <option value="Supportförfrågan">Supportförfrågan</option>
        <option value="Produktfråga">Produktfråga</option>
        <option value="Feedback">Feedback</option>
        <option value="Buggrapport">Buggrapport</option>
        <option value="Försäljningsfråga">Försäljningsfråga</option>
        <option value="Annat">Annat</option>
    </select>
</div>


        <div class="input-container">
            <label>Prioritet</label>
            <div class="priority">
                <label><input type="radio" name="prioritet" value="Låg" required>Låg</label>
                <label><input type="radio" name="prioritet" value="Medium">Medium</label>
                <label><input type="radio" name="prioritet" value="Hög">Hög</label>
            </div>
        </div>

        <button type="submit" class="btn">Skapa Ärende</button>
    </form>
</div>

</body>
</html>
