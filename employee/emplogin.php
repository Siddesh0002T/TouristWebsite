<?php
session_start();
$login = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '../config/db_connect.php';
    $emp_email = $_POST["emp_email"];
    $emp_pass = $_POST["emp_pass"]; 

    // Prepare the query
    $stmt = $conn->prepare("Select * from emp where emp_email=?");
    $stmt->bind_param("s", $emp_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $num = $result->num_rows;
    
    if ($num == 1){
        $row = $result->fetch_assoc();
        $hashed_pass = $row['emp_pass'];
        
        // Verify the password
        if (password_verify($emp_pass, $hashed_pass)) {
            $login = true;
            $_SESSION['emploggedin'] = true;
            $_SESSION['emp_id'] = $row['emp_id'];
            $_SESSION['emp_email'] = $emp_email;
            $_SESSION['emp_name'] = $row['emp_name']; // Get the user's name from the database
            $_SESSION['emp_phone'] = $row['emp_phone'];
            $_SESSION['emp_type'] = $row['emp_type'];
            $_SESSION['emp_age'] = $row['emp_age'];
            $_SESSION['emp_gender'] = $row['emp_gender'];
            $_SESSION['emp_date'] = $row['emp_date'];
            header("location: employee.php");
            exit();
        } else {
            $showError = "Invalid Credentials";
        }
    } else {
        $showError = "Invalid Credentials";
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Welcome to Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
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
    <form method="POST">
        <h3>Employee Login</h3>
        <?php if (isset($showError)) { ?>
            <p style="color: red;"><?php echo $showError; ?></p>
        <?php } ?>
        <label for="username">Email</label>
        <input type="email" placeholder="Email id" id="username" name="emp_email" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="emp_pass" required>
     
        <button>Log In</button>
        <a href="register.php">Register</a>
    </form>
</body>
</html>
