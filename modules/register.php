<?php
// connect to database  
   include("../config/db_connect.php");
 //  if($_SERVER['REQUEST_METHOD']==$_POST)
 if(isset($_POST['register'])){
    $uname = $_POST['uname'];
    $uemail = $_POST['uemail'];
    $pass = $_POST['pass'];
 // debugging code 
 /*   echo "<h1 style='color:red'>". $uname ."</h1>";
    echo "<h1 style='color:red'>". $uemail ."</h1>";
    echo "<h1 style='color:red'>". $pass ."</h1>";*/
    $query = "INSERT INTO `tuser` (`id`, `uname`, `uemail`, `pass`, `register_date`) VALUES (NULL, '$uname', '$uemail', '$pass', current_timestamp());";
    mysqli_query($conn, $query);
    // echo "<h1 style='color:red'>done</h1>"; 
    header("Location: gotologin.html" ,true);
    exit();
}
?>
<!DOCTYPE html>
< lang="en">
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
    <form method="POST">
        <h3 style="margin-top: 50px;">Register Here</h3>
        <?php 
        // debugging code
     //   echo $_SERVER['REQUEST_METHOD'];
        ?>
        <label for="register-username">Username</label>
        <input type="text" placeholder="Create your username" id="register-username" name="uname" required>

        <label for="register-email">Email</label>
        <input type="email" placeholder="Enter your email" id="register-email" name="uemail" required>

        <label for="register-password">Password</label>
        <input type="password" placeholder="Create your strong password" id="register-password" name="pass" required>

        <button style="margin-top: 30px;" name="register">Register</button>
        <a href="login.php">login</a>
    </form>
</body>
