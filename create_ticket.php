<?php
session_start(); // Startar en session

$server = "localhost"; // Servernamn
$user = "root";        // Användarnamn till databasen
$pass = "";            // Lösenord (inget lösen)
$conn = mysqli_connect($server, $user, $pass, "bdl"); // Ansluter till databasen "bdl"

if (!isset($_SESSION['user_id'])) { // Kontroll om användaren är inloggad
    header("Location: login.php"); // Om inte skicka tillbaka till login
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Om formuläret skickas med POST
    $titel = $_POST['titel']; // Hämtar titel
    $beskrivning = $_POST['beskrivning']; // Hämtar beskrivning
    $kategori = $_POST['kategori']; // Hämtar kategori
    $prioritet = $_POST['prioritet']; // Hämtar prioritet
    $skapad_av = $_SESSION['email']; // Hämtar e-post från sessionen
    $datum = date('Y-m-d H:i:s');  // Skapar aktuell tidsstämpel

    // förhindrar SQL-injektion
    $stmt = mysqli_prepare($conn, "INSERT INTO ärenden (titel, beskrivning, kategori, prioritet, skapad_av, datum) VALUES (?, ?, ?, ?, ?, ?)");

    // Binder parametrar till frågan
    mysqli_stmt_bind_param($stmt, "ssssss", $titel, $beskrivning, $kategori, $prioritet, $skapad_av, $datum);

    // Kör frågan
    if (mysqli_stmt_execute($stmt)) { 
        header("Location: index.php"); // skickar till startsida vid succe
        exit();
    } else {
        echo "Fel vid skapande av ärende: " . mysqli_error($conn); // Visar felmeddelande om något går fel
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8"> <!-- Teckenkodning -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsivitet -->
    <title>Skapa Ärende</title> <!-- Sidtitel -->
    <link rel="stylesheet" href="create_ticket.css"> <!-- Länk till CSS -->
</head>
<body>

<div class="ticket-container"> <!-- Huvudcontainer för ärendet -->
    <div class="logo-container"> 
        <img src="TechSolve AB logo.png" alt="TechSolve AB" class="logo">
    </div>

    <h2>Skapa Nytt Ärende</h2> <!-- Rubrik -->

    <form action="create_ticket.php" method="POST"> <!-- Formulär för att skicka ärendet -->
        <div class="input-container">
            <label for="titel">Titel</label>
            <input type="text" name="titel" id="titel" required> <!-- Titel -->
        </div>

        <div class="input-container">
            <label for="beskrivning">Beskrivning</label>
            <textarea name="beskrivning" id="beskrivning" rows="4" required></textarea> <!-- Beskrivning -->
        </div>

        <div class="input-container">
            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" required> <!-- Kategorival -->
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
            <label>Prioritet</label> <!-- Prioritetsval -->
            <div class="priority">
                <label><input type="radio" name="prioritet" value="Låg" required>Låg</label>
                <label><input type="radio" name="prioritet" value="Medium">Medium</label>
                <label><input type="radio" name="prioritet" value="Hög">Hög</label>
            </div>
        </div>

        <button type="submit" class="btn">Skapa Ärende</button> <!-- Skicka-knapp -->
    </form>
</div>

</body>
</html>
