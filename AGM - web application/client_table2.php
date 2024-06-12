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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client's Information</title>
</head>
<body>
    <header class="header">
            <form method="POST" action="login_index.php"><input class="login" type="submit" value="LOG IN"></form>
    </header>
    <div class="container2">
        <h1 class="rent-h1">CLIENT INFORMATION</h1>
        <table class="table-cont">
            <tr>
                <th>Customer ID</th>
                <th>Customer Details</th>
                <th>Products</th>
                <th>Start Date </th>
                 <th>End date</th>
            </tr>
            <?php
            $result = $conn->query("SELECT  tbl_rental.TBL_Rental_ID, tbl_client.TBL_Client_Name, tbl_client.TBL_Client_Address_Street, tbl_client.TBL_Client_Phone,  tbl_rental.tbl_category, tbl_rental.tbl_rental_start, tbl_rental.tbl_rental_end
            FROM tbl_rental
            INNER JOIN tbl_client ON tbl_rental.TBL_Rental_ID=tbl_client.TBL_Client_ID;");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['TBL_Rental_ID']; ?></td>
                        <td>
                            Name: <?php echo $row['TBL_Client_Name'];?><br>
                            Address: <?php echo $row['TBL_Client_Address_Street'];?><br>
                            Ph: <?php echo $row['TBL_Client_Phone'];?><br>
                        </td>
                        <td><?php echo $row['tbl_category']; ?></td>
                        <td><?php echo $row['tbl_rental_start']; ?></td>
                        <td><?php echo $row['tbl_rental_end']; ?></td>
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

</body>
</html>
