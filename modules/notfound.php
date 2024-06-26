<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

?>

<h1>
    Sorry !
<br>    
All Employees are busy at that time so try agin later 
</h1>