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
 
 
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $category = $_POST['category'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

 
        $query = mysqli_query($conn, "INSERT INTO tbl_client (TBL_Client_name, TBL_client_Address_Street, TBL_Client_Phone, TBL_Client_eMail) VALUES ('$name', '$address', '$phone', '$email')");
 
        $query = mysqli_query($conn, "INSERT INTO tbl_rental (tbl_rental_start, tbl_rental_end, tbl_category ) VALUES ('$start_date', '$end_date', '$category')");

        if($query){
            echo "<script>alert('Successfully rent'); document.location.href = 'booking2.php';</script>";
        }
    }
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="data-container">
        <form method="POST">
                <h1 class="rent-h1">Client Rental Information</h1><br>
                <input type="text" name="name" placeholder="Name" class="box">
                <br>
                <input type="text" name="address" placeholder="Address" class="box">
                <br>
                <input type="text" name="email" placeholder="Email" class="box">
                <br>
                <input type="text" name="phone" placeholder="Phone" class="box">
                <br>
                <label >Product:</label>
                <select name="category">
                    <?php
                        $categories = mysqli_query($conn, "SELECT * FROM tbl_machinery");
                        while ($row = mysqli_fetch_array($categories)) {
                    ?>
                    <option value="<?php echo $row['tbl_machinery_name']; ?>"><?php echo $row['tbl_machinery_name']; ?></option>
                    <?php } ?>
                </select><br>
                <label>Start date:</label>
                    <input type="date" name="start_date" /> <br>
                <label>End date:</label>
                    <input type="date" name="end_date"/> <br><br>
                <input class="log-button" type="submit" name="submit" value="Rent Now!"><br><br>
                <a class="log-button" href="table_customer.php">Go Back</a>
            </form>
    </div>
    
 
   
</body>
</html>
 
