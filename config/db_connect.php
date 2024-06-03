<?php
$servername = "localhost";
$username = "username";
$password = "password";
$db = "dbname";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>