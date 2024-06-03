
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Welcome to register</title>
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style>
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
   </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form>
        <h3 style="margin-top: 50px;">Register Here</h3>

        <label for="register-username">Username</label>
        <input type="text" placeholder="Enter your username" id="register-username">

        <label for="register-email">Email</label>
        <input type="email" placeholder="Enter your email" id="register-email">

        <label for="register-password">Password</label>
        <input type="password" placeholder="Enter your password" id="register-password">

        <button style="margin-top: 30px;">Register</button>
        <a href="login.php">login</a>
    </form>
</body>
</html>