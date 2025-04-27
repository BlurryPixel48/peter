<!DOCTYPE html>
<?php
$server="localhost";
$user="root";
$pass="";

$conn=mysqli_connect($server, $user, $pass, "bdl");

if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql="INSERT INTO rk(username, password) VALUES ('$username', '$password')";
    $result=mysqli_query($conn, $sql);
}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="DELETE FROM rk WHERE id=$id";
    $result=mysqli_query($conn, $sql);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class = "logo">
    <img src="TechSolve AB logo.png" = alt="logo">
</div>




    
</body>
</html>
