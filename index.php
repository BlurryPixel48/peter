<?php
$server = "localhost";  // Databasserver
$user = "root";         // Användarnamn
$pass = "";             // Lösenord (tomt i detta fall)

// Skapar en databasanslutning
$conn = mysqli_connect($server, $user, $pass, "bdl");

// Kontroll om anslutningen misslyckas
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL-fråga för att hämta alla ärenden
$sql = "SELECT * FROM ärenden"; 
$result = mysqli_query($conn, $sql); // Kör frågan
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8"> <!-- Teckenuppsättning -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsiv design -->
    <title>Ärendehanteringssystemet</title>
    <link rel="stylesheet" href="index.css"> <!-- Länk till CSS -->
</head>
<body>
    <div class="welcome">
        <h1>Välkommen till Ärendehanteringssystemet</h1> <!-- Välkomstmeddelande -->
    </div>

    <div class="ticket-container">
        <table> <!-- Tabell för att visa ärenden -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titel</th>
                    <th>Status</th>
                    <th>Prioritet</th>
                    <th>Skapad av</th>
                    <th>Datum</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Kontroll om det finns rader att visa
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Bestämmer färgklass baserat på status
                        $status_color = "";
                        if ($row['status'] == 'Löst') {
                            $status_color = "green";
                        } elseif ($row['status'] == 'Pågående') {
                            $status_color = "yellow";
                        } elseif ($row['status'] == 'Brådskande') {
                            $status_color = "red";
                        }
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['titel']; ?></td>
                            <td class="<?php echo $status_color; ?>"><?php echo $row['status']; ?></td>
                            <td><?php echo $row['prioritet']; ?></td>
                            <td><?php echo $row['skapad_av']; ?></td>
                            <td><?php echo $row['datum']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    // Om inga ärenden finns
                    echo "<tr><td colspan='6'>Inga ärenden finns.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="create-ticket">
        <!-- Länk till skapa-ärende-sidan -->
        <a href="create_ticket.php" class="btn">Skapa nytt ärende</a>
    </div>
</body>
</html>

<?php
mysqli_close($conn); // Stänger databasanslutningen
?>
