<?php
$server = "localhost";
$user = "root";
$pass = "";
$conn = mysqli_connect($server, $user, $pass, "bdl");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titel = $_POST['titel'];
    $beskrivning = $_POST['beskrivning'];
    $kategori = $_POST['kategori'];
    $prioritet = $_POST['prioritet'];
    $skapad_av = "Admin";  
    $datum = date('Y-m-d H:i:s');  // Sätt aktuellt datum och tid

    
    $sql = "INSERT INTO ärenden (titel, beskrivning, kategori, prioritet, skapad_av, datum) 
            VALUES ('$titel', '$beskrivning', '$kategori', '$prioritet', '$skapad_av', '$datum')";

   
    if (mysqli_query($conn, $sql)) {
        echo "Ärendet har skapats!";
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
