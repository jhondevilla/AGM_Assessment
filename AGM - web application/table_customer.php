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
    <title>Product Information</title>
</head>
<body>
    <header class="header">
            <form method="POST" action="login_index.php"><input class="login" type="submit" value="LOG IN"></form>
    </header>
    <div class="container2">
        <h1 class="rent-h1">RENTAL INFORMATION</h1>
        <table class="table-cont">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
            </tr>
            <?php
            $result = $conn->query("SELECT * FROM tbl_machinery");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['tbl_machinery_name']; ?></td>
                        <td><?php echo $row['tbl_machinery_desc']; ?></td>
                        <td><?php echo $row['tbl_machinery_price']; ?></td>
                        <td>
                            <?php 
                            if (isset($_SESSION['TBL_Login_ID'])){
                                $imagePath = "image/".$row['tbl_machinery_image'];
                                if (file_exists($imagePath)) {
                                    echo '<img src="'.$imagePath.'" width="200">';
                                } else {
                                    echo 'Image not found';
                                }
                            } else {
                                echo 'You need to log in to view the image';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
    <div class="rent-desc">
        <?php
        if (isset($_SESSION['TBL_Login_ID'])){
            echo '<form method="POST" action="booking2.php">
                <div class="edit-btm"><button type="submit" class="log-button" name="booking">Book now</button></div>
                </form>';
        } else {
            echo "You need to log in to be able to rent one of our rental products!";
        }
        ?>
    </div>

</body>
</html>.
