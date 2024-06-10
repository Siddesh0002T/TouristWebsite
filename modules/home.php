<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=REM:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=REM:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>TouristWebsite</title>
</head>
<body>



 <div class="Bar">
    <nav>
        <ul>
            <li><a href="hisofnas.php">History of Nashik</a></li>
            <li><a href="destination.php">Destination</a></li>
            <li><a href="image.php">Images</a></li> 
            <li> <?php 
        echo "<p style='color:#fff;'>Welcome ".$_SESSION['uname'] ."!</p>";
        ?></li> 
        </ul>
    </nav>
    <input class="search__input" type="text" placeholder="Search">
   
    
    <button onclick=""  type="button" id="LogOutBtn">
        Logout
  </button>
 </div>



  <div class="maincontainer">
 
  <div class="title">
    
        <h1>Nashik</h1>
     
    </div> 
    


    <div class="categories">

<a href="holy-places.php">
    <div class="temple">
        <img src="../assets/img/Temple1.jpg" alt="" class="small-image">
        <p>Holy Places</p>
    </div>
</a>

<a href="nature.php">
    <div class="nature">
        <img src="../assets/img/Nature1.jpg" alt="" class="small-image">
        <p>Nature</p>
    </div>
</a>


<div class="centre">
<p class="flying-text">Scroll Down</p>
<i class="fa-solid fa-arrow-down logo"></i>
</div>


<a href="food.php">
    <div class="food">
        <img src="../assets/img/food.jpg" alt="" class="small-image">
        <p>Food</p>
    </div>
</a>

<a href="hotel.php">
    <div class="hotel">
        <img src="../assets/img/hotel.jpg" alt="" class="small-image">
        <p>Hotel</p>
    </div>
</a>

</div>


  </div>
    
    

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="../assets/js/logout.js"></script>
</body>
</html>


