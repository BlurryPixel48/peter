<!DOCTYPE html>
<?php
$server="localhost";
$user="root";
$pass="";

$conn=mysqli_connect($server, $user, $pass, "mydb");

if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql="INSERT INTO tbluser(username, password) VALUES ('$username', '$password')";
    $result=mysqli_query($conn, $sql);
}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="DELETE FROM tbluser WHERE id=$id";
    $result=mysqli_query($conn, $sql);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peter</title>
</head>
<body>
    <h1>No, this is Peter</h1>

<?php
$sql="SELECT * FROM tbluser ORDER BY username ASC";
$result=mysqli_query($conn, $sql);
while($rad=mysqli_fetch_assoc($result)){ ?>

    <p>
        <b>Användarnamn:</b> <?=$rad['username']?> <b>Level:</b> <?=$rad['userlevel']?><br>
        <b>Lösenord:</b> <?=$rad['password']?><br>
        <a href="index.php?id=<?=$rad['id']?>">Delete</a>
    </p>

<?php }
?>
<form action="index.php" method="POST">
    <input type="text" name="username" placeholder="Användarnamn">
    <input type="password" name="password" placeholder="Lösenord">
    <input type="submit" name="submit" value="Skicka">
</form>

</body>
</html>