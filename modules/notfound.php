<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>

body {
    background-color: rgb(46, 46, 46);
    margin: 0;
    padding: 0;
}
        .Bar {
    position: relative;
}

.Bar img {
    position: absolute;


    /* This will make the image cover the entire container */
    width: 100%;
    height: 100%;
    object-fit: cover;

    /* This makes the image responsive */
    max-width: 100%;
    height: auto;

    /* This will place the image behind other elements */
    z-index: -1;
}


/* CSS for larger screens */
nav ul {
    padding-right: 10px;
    padding-top: 10px;
    color: white;
    list-style-type: none;
    display: flex;
}

nav ul li {
    margin-right: 50px;
    font-family: "Roboto", sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 20px;
}

nav ul li a {
    color: white;
    text-decoration: none;
}

nav ul li a:hover {
    color: orange;
}


#LogOutBtn {
    margin-left: 800px;
}

.search__input {
    color: #FFFFFF;
    background: transparent;
    border: 1px solid #FFFFFF;
    border-radius: 20px;
    padding: 5px 20px;
    width: 200px;
    height: 30px;
    outline: none;
    font-size: 14px;
}

.welcome:hover {
    color: #feac40;
    cursor: pointer;
}



.search__input::placeholder {
    color: #FFFFFF;
    font-size: 14px;
}

.search__input:focus {
    border-color: #feac40;
    background-color: transparent;
    color: #ffac40;
}


#LogOutBtn {
    background: none;
    border: none;
    font-weight: 400;
    font-style: normal;
    font-size: 20px;
    cursor: pointer;
    padding-left: 200px;
    color: #ffffff;
}

#LogOutBtn:hover {
    color: #feac40;
}

h1{
    margin-right: 50px;
    font-family: "Roboto", sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 20px;
    color: White;
    margin-top: 200px;
    font-size:30px;
}

#goBackButton {
            background-color: #0074D9;
            color: #FFFFFF;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Hover effect */
        #goBackButton:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<section class="Bar">
        <div class="imgage">
            <img src="../assets/img/bg5.jpg" alt="">
        </div>
        
       <nav>
       <div class="hamburger-menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="Destination.html">Destination</a></li>
            <li><a href="image.html">Images</a></li>
            <li class='welcome'> <?php 
        echo "".$_SESSION['uname'] ."!";
        ?></li> 
            <li><input class="search__input" type="text" placeholder="Search"></li>
            <li><button onclick=""  type="button" id="LogOutBtn">Logout</button></li>
        </ul>
       </nav>

    </section>

    <center><h1>Apologies, but our tourist guides are currently unavailable. Please try again later.</h1>
    <button id="goBackButton">Go Back</button>

</center>

<script>// Add an event listener to the "Go Back" button
document.getElementById('goBackButton').addEventListener('click', function() {
    // Navigate back to the previous page
    window.history.back();
});
</script>
</body>
</html>