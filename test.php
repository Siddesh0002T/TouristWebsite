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