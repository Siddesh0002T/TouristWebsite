<?php
session_start();

if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true){
    header("location: adminlogin.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin</title>
   <?php 
        echo "Welcome ".$_SESSION['auname'] ."!";
        ?>
</head>
<body>
   
</body>
</html>