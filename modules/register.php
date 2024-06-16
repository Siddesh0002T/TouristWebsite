<?php
$emailEx = false;
$exists = false;
// connect to database  
include ("../config/db_connect.php");

if (isset($_POST['register'])) {
    $uname = $_POST['uname'];
    $uemail = $_POST['uemail'];
    $pass = $_POST['pass'];

    // Check if email already exists
    $existsSql = "SELECT * FROM `tuser` WHERE `uemail` = ?";
    $stmt = mysqli_prepare($conn, $existsSql);
    // echo $stmt;
    mysqli_stmt_bind_param($stmt, "s", $uemail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $numExistRow = mysqli_num_rows($result);

    if ($numExistRow > 0) {
        $exists = true;
    } else {
        $exists = false;
    }

    if ($exists == false) {
        $query = "INSERT INTO `tuser` (`id`, `uname`, `uemail`, `pass`, `register_date`) VALUES (NULL, ?, ?, ?, current_timestamp());";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $uname, $uemail, $pass);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: gotologin.html");
            exit();
        } else {
            echo "<p style='color:red'>Error registering user</p>";
        }
    } else {
        $emailEx = "<p style='color:red'>Email already exists</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Welcome to register</title>
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style>
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST">
        <h3 style="margin-top: 50px;">Register Here</h3>
        <?php
        // debugging code
        //   echo $_SERVER['REQUEST_METHOD'];
        ?>
        <label for="register-username">Username</label>
        <input type="text" placeholder="Create your username" id="register-username" name="uname" required>
        <?php echo $emailEx; ?>
        <label for="register-email">Email</label>
        <input type="email" placeholder="Enter your email" id="register-email" name="uemail" required>

        <label for="register-password">Password</label>
        <input type="password" placeholder="Create your strong password" id="register-password" name="pass" required>

        <button style="margin-top: 30px;" name="register">Register</button>
        <a href="login.php">login</a>
    </form>
</body>

</html>