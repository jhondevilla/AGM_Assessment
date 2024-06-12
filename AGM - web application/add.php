<?php
session_start();

$servername = "192.168.23.128";
$username = "User";
$password = "Pass1234";
$DB = "all_good_machinery";

// Create connection
$conn = new mysqli($servername, $username, $password, $DB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["submit"])){
    if($_POST["submit"] == "add"){
        add();
    }
    else if($_POST["submit"] == "edit"){
        edit();
    }
    else{
        delete();
    }
}

function add(){
    global $conn;
    $name = $_POST["name"];
    $desc = $_POST["desc"]; 
    $price = $_POST["price"];
    $filename = $_FILES["image"]["name"];
    $tmpname = $_FILES["image"]["tmp_name"];

    $newfilename =  $filename;

    move_uploaded_file($tmpname, 'image/'. $newfilename);
    $query = "INSERT INTO tbl_machinery (tbl_machinery_name, tbl_machinery_desc, tbl_machinery_price, tbl_machinery_image) VALUES ('$name', '$desc', '$price', '$newfilename')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Successfully added'); document.location.href = 'table.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add a Product</title>
</head>
<body>
    <div class="data-container">
    <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
        <h1 class="rent-h1">Add a Product</h1><br>
        <label for="name">Name: </label><br>
        <input type="text" name="name" id="name" required><br>

        <label for="price">Price: </label><br>
        <input type="text" name="price" id="price" required><br>

        
        <label for="desc">Description: </label><br>
        <textarea name="desc" id="desc" rows="6" cols="50" required></textarea><br>

        <label for="image">Image: </label>
        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required><br><br>

        <input class="log-button" type="submit" name="submit" value="add">
        <br><br>
        <a class="log-button" href="table.php">Table Data</a>
    </form>
    </div>

</body>
</html>
