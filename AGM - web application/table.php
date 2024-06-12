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

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM tbl_machinery WHERE tbl_machinery_id = $id");
    header('location:table.php');
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
</head>
<body>
<header class="header">
            <form method="POST" action="login_index.php"><input class="login" type="submit" value="LOG IN"></form>
    </header>
<div class="container2">
    <h1 class="rent-h1">ADMIN AREA</h1>
    <div class="add-head">
        <a class="log-button" href="client_table2.php">Client's Rental Info</a><br><br><br>
        <a class="log-button" href="add.php">Add a product</a><br>    
    </div>
    <table class="table-cont">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Update</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM tbl_machinery");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['tbl_machinery_id']; ?></td>
                    <td><?php echo $row['tbl_machinery_name']; ?></td>
                    <td><?php echo $row['tbl_machinery_desc']; ?></td>
                    <td><?php echo $row['tbl_machinery_price']; ?></td>
                    <td><img src="image/<?php echo $row['tbl_machinery_image']; ?>" width="200"></td>
                    
                    <td>
                        <div class="edit-btm"><a class="log-button" href="edit.php?id=<?php echo $row['tbl_machinery_id']; ?>">Edit</a><br><br></div>
                        <div class="edit-btm"><a class="log-button" href="table.php?delete=<?php echo $row['tbl_machinery_id']; ?>" >Delete</a></div>
                    </td>
                </tr>
                <?php
            }
        } 
        $conn->close();
        ?>
    </table>
</div>
</body>
</html>
