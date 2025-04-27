<?php
// Databasanslutning
$server = "localhost";
$user = "root";
$pass = "";
$conn = mysqli_connect($server, $user, $pass, "bdl");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Hämta alla ärenden från databasen
$sql = "SELECT * FROM ärenden"; // Byt ut 'ärenden' mot din tabellnamn
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ärendehanteringssystemet</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="welcome">
        <h1>Välkommen till Ärendehanteringssystemet</h1>
    </div>

    <div class="ticket-container">
        <table>
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
                // Loop genom alla ärenden
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Färger för status
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
                    echo "<tr><td colspan='6'>Inga ärenden finns.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="create-ticket">
        <a href="create_ticket.php" class="btn">Skapa nytt ärende</a>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
