<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include './config/db_connect.php';
    $auname = $_POST["auname"];
    $apass = $_POST["apass"]; 
    
     
    $query = "Select * from admin where auname='$auname' AND apass='$apass'";
    //Debug $query = "Select * from tuser where uemail='$uemail'";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
           
                $login = true;
                session_start();
                $_SESSION['adminloggedin'] = true;
                $_SESSION['auname'] = $auname;
              //  $_SESSION['uname'] = $row['uname']; // Get the user's name from the database
                header("location: admin.php");
         //debug        echo  $_SESSION['uname'];

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
    <link rel="stylesheet" href="./assets/css/adminlogin.css">
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
        <h3>Admin Login</h3>
        <?php if (isset($showError)) { ?>
            <p style="color: red;"><?php echo $showError; ?></p>
        <?php } ?>
        <label for="username">Username</label>
        <input type="text" placeholder="Username" id" id="username" name="auname" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="apass" required>
     
        <button>Log In As Admin</button>
    </form>
</body>
</html>
