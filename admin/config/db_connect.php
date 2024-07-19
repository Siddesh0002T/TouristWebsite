<?php
$servername = "sql107.infinityfree.com";
$username = "if0_36867302";
$password = "TBs9z4iqHq9riOD";
$db = "if0_36867302_touristweb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
   //  echo"<h1 style='color:red'>Connected</h1>";
   }
?>