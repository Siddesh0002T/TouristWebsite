<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '../config/db_connect.php';
    $uemail = $_POST["uemail"];
    $pass = $_POST["pass"]; 
    
     
    // $sql = "Select * from users where username='$username' AND password='$password'";
    $query = "Select * from tuser where uemail='$uemail'";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if (password_verify($pass, $row['pass'])){ 
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['uname'] = $uname;
                header("location: home.php");
            } 
            else{
                $showError = "Invalid Credentials";
            }
        }
        
    } 
    else{
        $showError = "Invalid Credentials";
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
    <form method="POST">
        <h3>Login Here</h3>
        <?php if (isset($showError)) { ?>
            <p style="color: red;"><?php echo $showError; ?></p>
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
