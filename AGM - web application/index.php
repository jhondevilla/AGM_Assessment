<?php
session_start();

$servername = "192.168.23.128";
$username = "User";
$password = "Pass1234";
$DB = "all_good_machinery";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
</head>
<body>
    <header class="header">
            <form method="POST" action="login_index.php"><input class="login" type="submit" value="LOG IN"></form>
    </header>

    <div class="container">
        <h1>All Good Machinery</h1>
        <img src="image/logo.png" alt="logo" class="logo">

        <div class="button-cont">
            <form method="POST" action="table_customer.php"><input class="log-button2" type="submit" name="submit" value="View the rental products!" ></form>
            
        </div>



    </div>





</body>
</html>
