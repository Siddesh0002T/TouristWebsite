<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "touristweb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    //  echo"<h1 style='color:red'>Connected</h1>";
}
?>