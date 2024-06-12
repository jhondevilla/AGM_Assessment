
<?php
session_start();
$servername = "192.168.23.128";
$username = "User";
$password = "Pass1234";
$DB = "all_good_machinery";


$nameErr = $emailErr = $passwordErr ="";
$name = $email = $password ="";


if ($_SERVER["REQUEST_METHOD"] =="POST"){
    if (empty($_POST["name"])) {
        $nameErr = "* Name is required";
    } else{
        $name = $_POST["name"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "* Only letters and white space allowed";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "* Enter your password";
    } else {
        $password = $_POST["password"];
        // Check if the password meets the criteria
        if (strlen($password) < 8 || !preg_match("/[0-9]/", $password)) {
            $passwordErr = "* Password must be at least 8 characters and contain at least one number";
        }
    }

    
    if (empty($nameErr) && empty($passwordErr)) {
        // All fields are filled, redirect to second page
        $_SESSION['name'] = $name;
        $_SESSION['TBL_Login_ID'] = true;
        header("Location: table.php");
        exit();
    }
}
?>
<DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="form-cont">
        <h1 class="log-h1">All Good Machinery Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <!--Username--> 
                    <input type="text" placeholder="Username" name="name"><br>
                    <div class="error-cont">
                        <span class="error"> <?php echo $nameErr;?></span>
                    </div>
                    <br><br>
            <!--Password-->  
            <div class="password-cont">
                <input type="password" placeholder="Password" name="password"><br>
                <div class="error-cont">
                    <span class="error"> <?php echo $passwordErr;?></span>
                </div>
                
            </div>

                <br><br>
            <!--Button-->           
                <input class="log-button" type="submit" name="submit" value="Login" >

        </form>
        <img class="car" src="image/car1.png" alt="logo" class="car">
    </div>
</body>
</html>
