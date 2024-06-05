<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=REM:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>TouristWebsite</title>
</head>
<body>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #222;
  color: #fff;
  margin: 0;
}

.container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.header {
  background-color: #222;
  color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  width: 100%;
}

.header a {
  color: #fff;
  text-decoration: none;
  margin: 0 1rem;
}

.header input {
  background-color: #333;
  color: #fff;
  border: none;
  padding: 0.5rem;
  border-radius: 5px;
}

.header button {
  background-color: #ff6600;
  color: #fff;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 5px;
  cursor: pointer;
}

.hero {
  background-image: url("./assets/img/extendBGblur.jpg");
  background-size: cover;
  height: 400px;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.hero h1 {
  font-size: 5rem;
  font-weight: bold;
  text-shadow: 2px 2px 5px #000;
}

.categories {
  display: flex;
  justify-content: space-around;
  align-items: center;
  padding: 1rem;
  width: 100%;
}

.category {
  display: flex;
  align-items: center;
  gap: 1rem;
  cursor: pointer;
}

.category img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}

.section {
  padding: 2rem;
  width: 100%;
}

.section h2 {
  font-size: 2rem;
  margin-bottom: 1rem;
}

.section p {
  line-height: 1.5;
  margin-bottom: 2rem;
}

.places {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  gap: 1rem;
}

.place {
  width: 200px;
  height: 200px;
  background-size: cover;
  cursor: pointer;
}

.call-to-action {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 2rem;
}

.call-to-action button {
  background-color: #ff6600;
  color: #fff;
  border: none;
  padding: 1rem 2rem;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1.5rem;
  transition: all 0.3s ease;
}

.call-to-action button:hover {
  background-color: #ff9933;
}

</style>
</head>
<body>
<div class="container">
  <header class="header">
    <div>
      <a href="#">History of Nashik</a>
      <a href="#">Destination</a>
      <a href="#">Images</a>
    </div>
    <div>
      <input type="text" placeholder="Search...">
      <button>Explore</button>
    </div>
  </header>

  <div class="hero">
    <h1>Nashik</h1>
  </div>

  <div class="categories">
    <div class="category">
      <img src="https://cdn.pixabay.com/photo/2018/02/01/13/48/temple-3125342_960_720.jpg" alt="Holy Places">
      <p>Holy Places</p>
    </div>
    <div class="category">
      <img src="https://cdn.pixabay.com/photo/2015/03/26/09/55/nature-691872_960_720.jpg" alt="Nature">
      <p>Nature</p>
    </div>
    <div class="category">
      <img src="https://cdn.pixabay.com/photo/2017/04/28/13/00/indian-food-2271350_960_720.jpg" alt="Food">
      <p>Food</p>
    </div>
    <div class="category">
      <img src="https://cdn.pixabay.com/photo/2017/07/28/18/43/hotel-2546496_960_720.jpg" alt="Hotel">
      <p>Hotel</p>
    </div>
  </div>

  <div class="section">
    <h2>Tales of Nashik</h2>
    <p>In the heart of Maharashtra, Nashik whispers tales of ancient times and divine legends. Nestled by the Godavari River, this city was once the refuge of Lord Rama during his exile. The sacred aura still lingers, especially at Panchavati, where pilgrims gather to seek blessings.
    Every twelve years, Nashik springs to life with the Kumbh Mela, drawing millions for a holy dip in the Godavari's waters. The majestic Trimbakeshwar Temple and the ancient Pandavleni Caves echo stories of devotion and ancient commerce.</p>
  </div>

  <div class="section">
    <h2>Popular Places In Nashik</h2>
    <div class="places">
      <div class="place" style="background-image: url('https://cdn.pixabay.com/photo/2017/12/09/14/52/shopping-mall-3011475_960_720.jpg')"></div>
      <div class="place" style="background-image: url('https://cdn.pixabay.com/photo/2017/09/29/18/08/street-2793138_960_720.jpg')"></div>
      <div class="place" style="background-image: url('https://cdn.pixabay.com/photo/2016/11/29/15/22/india-1871470_960_720.jpg')"></div>
    </div>
  </div>

  <div class="call-to-action">
    <h2>Want Tourist?</h2>
    <a href="#"><button>Yes!</button></a>
  </div>

</div>
</body>
</html>