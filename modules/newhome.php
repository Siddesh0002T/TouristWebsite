<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nashik Tourism</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/newstyle.css"> <!-- Link to your CSS file -->
</head>

<body>
  
    <!-- Navigation Bar -->
    <div class="Bar">
      <img src="../assets/img/extendBGblur.jpg" alt="">
        <nav class="navbar navbar-expand-lg">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="hisofnas.html">History of Nashik</a></li>
                <li class="nav-item"><a class="nav-link" href="destination.php">Destination</a></li>
                <li class="nav-item"><a class="nav-link" href="image.php">Images</a></li>
                <li><input class="search__input" type="text" placeholder="Search"></li>
            <li><button onclick=""  type="button" id="LogOutBtn">Logout</button></li>
            </ul>
        </nav>
    </div>

    <!-- Section 1 -->
    <div class="container-fluid maincontainer">
        <div class="title">
          
            <h1>Nashik</h1>
        </div>

        <div class="categories d-flex justify-content-center align-items-center flex-wrap">
            <a href="holy-places.php" class="d-flex flex-column align-items-center m-3">
                <div class="temple">
                    <img src="../assets/img/Temple1.jpg" alt="" class="small-image">
                    <p>Holy Places</p>
                </div>
            </a>

            <a href="nature.php" class="d-flex flex-column align-items-center m-3">
                <div class="nature">
                    <img src="../assets/img/Nature1.jpg" alt="" class="small-image">
                    <p>Nature</p>
                </div>
            </a>

            <div class="centre text-center m-3">
                <p class="flying-text">Scroll Down</p>
                <i class="fa-solid fa-arrow-down logo"></i>
            </div>

            <a href="food.php" class="d-flex flex-column align-items-center m-3">
                <div class="food">
                    <img src="../assets/img/food.jpg" alt="" class="small-image">
                    <p>Food</p>
                </div>
            </a>

            <a href="hotel.php" class="d-flex flex-column align-items-center m-3">
                <div class="hotel">
                    <img src="../assets/img/hotel.jpg" alt="" class="small-image">
                    <p>Hotel</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Section 2 -->
    <div class="container-fluid section tales" id="section2">
        <div class="row content-container">
            <div class="col-md-4 image">
                <img src="../assets/img/tales_of_nashik.jpg" class="img-fluid" alt="Tales of Nashik">
            </div>
            <div class="col-md-8 text">
                <h2>Tales of Nashik</h2>
                <p>
                    In the heart of Maharashtra, Nashik whispers tales of ancient times and divine legends. Nestled by the Godavari River, this city was once the refuge of Lord Rama during his exile. The sacred aura still lingers, especially at Panchavati, where pilgrims gather to seek blessings.
                    Every twelve years, Nashik springs to life with the Kumbh Mela, drawing millions for a holy dip in the Godavari's waters. The majestic Trimbakeshwar Temple and the ancient Pandavleni Caves echo stories of devotion and ancient commerce.
                </p>
                <div class="links">
                    <a href="ojhar.php" class="btn btn-link">Ojhar</a>
                    <a href="igatpuri.php" class="btn btn-link">Igatpuri</a>
                    <a href="yeola.php" class="btn btn-link">Yeola</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
