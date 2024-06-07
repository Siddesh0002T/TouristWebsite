<?php
// connect to database
include("../config/db_connect.php");

if (isset($_POST['login'])) {
    $uname = $_POST['uemail'];
    $pass = $_POST['pass'];

    // Query to retrieve user data
    $query = "SELECT * FROM `tuser` WHERE `uemail` = '$uemail' AND `pass` = '$pass'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // User exists, login successful
        $user_data = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['uname'] = $user_data['uname'];
        $_SESSION['uemail'] = $user_data['uemail'];
        header("Location: home.php",true);
        exit();
    } else {
        // User does not exist or password is incorrect
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Welcome to Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
      *,
*:before,
*:after{
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
    <form>
        <h3>Login Here</h3>
        <?php if (isset($error)) { ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php } ?>
        <label for="username">Email</label>
        <input type="email" placeholder="Email id" id="username" name="uemail" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="pass" required>

        <button>Log In</button>
        <a href="register.php">Register</a>
    </form>
</body>
</html>
