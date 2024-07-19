<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: ./modules/login.php");
    exit;
}
if(isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: ./modules/home.php");
    exit;
}

?>