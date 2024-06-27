<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

$emailEx = false;
$exists = false;

// Connect to database
include("../config/db_connect.php");

// Mail 
include('smtp/PHPMailerAutoload.php');
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 2; 
	$mail->Username = "rubbysoft.co@gmail.com";
	$mail->Password = "wvug hwjq phdj vbuh";
	$mail->SetFrom("rubbysoft.co@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
	//	echo $mail->ErrorInfo;
	}else{
//	return 'Sent';
	}
}

// echo smtp_mailer('to_email','Subject','html');


if (isset($_POST['apply'])) {
    $emp_name = $_POST['emp_name'];
    $emp_email = $_POST['emp_email'];
    $emp_phone = $_POST['emp_phone'];
    $emp_pass = $_POST['emp_pass'];
    $emp_type = $_POST['emp_type'];
    $emp_age = $_POST['emp_age'];
    $emp_gender = $_POST['emp_gender'];

    // Validate form data
    if (empty($emp_name) || empty($emp_email) || empty($emp_phone) || empty($emp_pass) || empty($emp_type) || empty($emp_age) || empty($emp_gender)) {
        echo "<p style='color:red'>Please fill in all fields</p>";
        exit();
    }

    // Check if email already exists
    $existsSql = "SELECT * FROM `emp` WHERE `emp_email` =?";
    $stmt = mysqli_prepare($conn, $existsSql);
    mysqli_stmt_bind_param($stmt, "s", $emp_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $numExistRow = mysqli_num_rows($result);

    if ($numExistRow > 0) {
        $exists = true;
    } else {
        $exists = false;
    }

    if ($exists == false) {
        // Hash password using bcrypt
        $hashed_pass = password_hash($emp_pass, PASSWORD_BCRYPT);

        $query = "INSERT INTO `emp` (`emp_id`, `emp_name`, `emp_email`, `emp_phone`, `emp_type`, `emp_age`, `emp_gender`, `emp_pass`, `emp_date`, `is_free`) VALUES (NULL,?,?,?,?,?,?,?, current_timestamp(), 1);";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssss", $emp_name, $emp_email, $emp_phone, $emp_type, $emp_age, $emp_gender, $hashed_pass);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: ../employee/gotologin.html");
            exit();
        } else {
            echo "<p style='color:red'>Error registering user</p>";
        }
    } else {
        $emailEx = "<p style='color:red'>Email already exists</p>";
    }
}
if (isset($_POST['book'])){
    $user_id = $_SESSION['user_id'];
    $tour_date = $_POST['tour_date'];

    // Get User Details 
    $userSql = "SELECT * FROM `tuser` WHERE `id` = $user_id";
    $result = $conn->query($userSql);
    if ($result->num_rows == 0) {
            die("User not found.");
    }
    $user = $result->fetch_assoc();

    // Find a free guide
    $empSql = "SELECT * FROM emp WHERE is_free = TRUE LIMIT 1";
    $result = $conn->query($empSql);
    if ($result->num_rows == 0) {
        header("location: notfound.php"); // notfound.php
    }
    $emp = $result->fetch_assoc();
    $emp_id = $emp['emp_id'];
    
    // Create assignment
    $sql = "INSERT INTO tour_assignments (user_id, emp_id, tour_date) VALUES ($user_id, $emp_id, '$tour_date')";
    $conn->query($sql);

    // Mark guide as busy
    $sql = "UPDATE emp SET is_free = FALSE WHERE emp_id = $emp_id";
    $conn->query($sql);


    // Send email to user
    $to = $user['uemail'];
    $subject = "Tour Guide Assigned";
    $message = "Dear " . $user['uname'] . ",\n\nYou have been assigned a tour guide.\n\nGuide Details:\nName: " . $emp['emp_name'] . "\nEmail: " . $emp['emp_email'] ."\nPhone: " . $emp['emp_phone'] ."\nAge: " . $emp['emp_age'] . "\nGender: " . $emp['emp_gender'] . "\nTour Date: $tour_date\n\nBest Regards,\nTouritWeb";
    //mail($to, $subject, $message);
    echo smtp_mailer($to,$subject,$message);

    // Send email to guide
    $to = $emp['emp_email'];
    $subject = "New Tour Assignment";
    $message = "Dear " . $emp['emp_name'] . ",\n\nYou have been assigned a new tour.\n\nUser Details:\nName: " . $user['uname'] . "\nEmail: " . $user['uemail'] . "\nTour Date: $tour_date\n\nBest Regards,\nTouritWeb";
    // mail($to, $subject, $message);
    echo smtp_mailer($to,$subject,$message);
   // echo "Tour booked successfully. You will receive an email with your guide details.";
   header("location: viewtour.php");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tou</title>
    <link rel="stylesheet" href="../assets/css/styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=REM:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=REM:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/widgetContact.css">
    <link rel="stylesheet" href="../assets/css/widgetApply.css">



</head>

<body id="bggg">


    <section class="Bar">

        <img src="../assets/img/extendBGblur.jpg" alt="">
        <nav>
            <div class="hamburger-menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <ul>
                <li><a href="hisofnas.html">History</a></li>
                <li><a href="Destination.html">Destination</a></li>
                <li><a href="image.html">Images</a></li>
                <li onclick="location.href='../employee/employee.php'" class='welcome'> <?php
                echo "" . $_SESSION['uname'] . "!";
                ?></li>
                <li><input class="search__input" type="text" placeholder="Search"></li>
                <li id="LogOutBtn"><a href="logout.php">Logout</a></li>


            </ul>
        </nav>

    </section>


    <div class="Main">
        <h1>Nashik</h1>

        <div class="categories">

            <a href="holy.html">
                <div class="temple">
                    <img src="../assets/img/Temple1.jpg" alt="" class="small-image">
                    <p>Holy Places</p>
                </div>
            </a>

            <a href="nature.html">
                <div class="nature">
                    <img src="../assets/img/Nature1.jpg" alt="" class="small-image">
                    <p>Nature</p>
                </div>
            </a>


            <div class="centre">
                <p class="flying-text">Scroll Down</p>
                <a href="#About_Section"><i class="fa-solid fa-arrow-down logo"></i></a>
            </div>


            <a href="https://www.tripadvisor.in/Restaurants-g303883-Nashik_Nashik_District_Maharashtra.html">
                <div class="food">
                    <img src="../assets/img/food.jpg" alt="" class="small-image">
                    <p>Food</p>
                </div>
            </a>

            <a href="https://www.tripadvisor.in/Hotels-g303883-Nashik_Nashik_District_Maharashtra-Hotels.html">
                <div class="hotel">
                    <img src="../assets/img/hotel.jpg" alt="" class="small-image">
                    <p>Hotel</p>
                </div>
            </a>

        </div>

    </div>


    <div id="About_Section">
        <div class="About">
            <div class="bg"></div>
            <img src="../assets/img/riksha.jpg" alt="">
            <div class="text-content"> <!-- Add this div -->
                <h2>Tales of Nashik</h2>
                <p>In the heart of Maharashtra, lies a city named Nashik,
                    A place of divine wine and temples, where traditions mix. <br>
                    The city is known for its grapes, sweet and sour,
                    And the vineyards that bloom, every day, every hour. <br>
                    Sula Vineyards stands tall, a testament to the city's fame,
                    Where the finest of wines, earn Nashik its name. <br>
                    The Godavari River flows, serene and calm,
                    Adding to Nashik's charm, like a soothing balm. <br>
                    The Kumbh Mela takes place, every twelve years,
                    Where millions gather, overcoming their fears. <br>
                    They bathe in the holy river, washing away their sin,
                    In the hope of a new life, a fresh start, a new spin. <br>
                    Ramkund is the spot, where Lord Rama had bathed,
                    A place of significance, where memories have not faded. <br>
                    The Pandavleni Caves, a marvel of architecture,
                    Stand as a symbol of history, a part of our culture. <br>
                    Nashik's street food is a delight, a treat to the taste,
                    From spicy misal pav to sweet jalebi, nothing goes to waste. <br>
                    The city is a blend of the old and the new,
                    A place of diversity, presenting a beautiful view. <br>
                    From the bustling markets to the tranquil Ghats,
                    Nashik has it all, including habitats for bats. <br>
                    So here's to Nashik, a city vibrant and mystic,
                    A city of tales, both modern and historic.</p>

                <div class="list">
                    <h4><a href="#Ojhar">Ojhar</a></h4>
                    <h4><a href="#Igatpuri">Igatpuri</a></h4>
                    <h4><a href="#Yeola">Yeola</a></h4>
                </div>



            </div>
        </div>
    </div>


    <div id="Places_Section">
        <div class="Place">
            <h1>Popular Places in Nahik</h1>
            <center>
                <div class="image-container">
                    <img src="../assets/img/panchvati.jpg" alt="">
                    <div class="image-info">Panchavati</div>
                </div>
                <div class="image-container">
                    <img src="../assets/img/leni.jpg" alt="">
                    <div class="image-info">Pandavleni</div>
                </div>
                <div class="image-container">
                    <img src="../assets/img/shalimar-chowk.jpg" alt="">
                    <div class="image-info">Shalimar</div>
                </div>
                <div class="image-container">
                    <img src="../assets/img/ccm.jpg" alt="">
                    <div class="image-info">City Centre Mall</div>
                </div>
            </center>
        </div>
    </div>


    <div id="Toursit_Section">
        <div class="Toursit">
            <div class="video">
                <video autoplay loop muted plays-inline class="background-clip">
                    <source src="../assets/img/walking man_2.mp4" type="video/mp4">
                </video>
            </div>
            <div class="content">
                <h1>Want Tourist?</h1>
                <center><i class="fa-solid fa-arrow-down arrow"></i></center>
                <a onclick="openBookForm()">Yes</a>
            </div>
        </div>
    </div>


    <div class="wrapper">
        <div class="content">
            <!-- Your main content goes here -->
        </div>
        <button class="open-button" onclick="openForm()">Contact Us</button>
        <!-- Contact Form Widget Here -->


        <div class="form-popup" id="myForm">
            <form action="https://api.web3forms.com/submit" method="POST" class="form-container">
                <h3 style="margin-top: 50px;">Contact Us</h3>
                <input type="hidden" name="access_key" value="88c2995c-6a9d-41c4-ba16-a3bc06a8bbdb">
                <label for="register-username">Full Name</label>
                <input type="text" placeholder="Enter Your Full Name" id="register-username" name="Name" required>

                <label for="register-email">Email</label>
                <input type="email" placeholder="Enter Your Email" id="register-email" name="Email" required>

                <label for="register-password">Message</label>
                <textarea class="textArea" type="text" placeholder="Message" name="Message"
                    style=" display: block; height: 50px; width: 100%; background-color: rgba(255,255,255,0.07); border-radius: 3px; padding: 0 10px; margin-top: 8px; font-size: 14px; font-weight: 300;"
                    rows="10" id="msg" name="msg" required></textarea>

                <button type="submit" style="margin-top: 30px;" name="Send Message">Message</button>
                <button style="margin-top: 30px;" name="close" onclick="closeForm()">close</button>
            </form>
        </div>
<!-- Booking Form Widget Here -->


<div class="form-popup" id="myApplyForGuideForm">
            <form method="POST" class="form-container">
                <h3 style="margin-top: 50px;">Book Tour Guide</h3>
               
                <label for="register-date">Tour Date</label>
                <input type="date"  id="register-email" name="tour_date" required>
                <button type="submit" style="margin-top: 30px;" name="book">Book</button>
                <button style="margin-top: 30px;" name="myBooking" onclick="location.href='viewtour.php'" name="book">My Booking</button>
                <button style="margin-top: 30px;" name="close" onclick="closeBookForm()">close</button> 
            </form>
        </div>
        <!-- Apply Form Widget Here -->

        <div class="apply-form-popup" id="myApplyForm">
            <form method="POST" class="form-container form-apply-body">
                <h3 style="margin-top: 50px;">Apply</h3>

                <label for="register-username">Full Name</label>
                <input type="text" placeholder="Enter Your Full Name" id="register-username" name="emp_name" required>

                <label for="register-email">Email</label>
                <input type="email" placeholder="Enter Your Email" id="register-email" name="emp_email" required>

                <label for="register-number">Contact No</label>
                <input type="phone" placeholder="Enter Your Phone No." id="register-number" name="emp_phone" required>

                <label for="register-password">Password</label>
                <input type="password" placeholder="Create Your Password" id="register-password" name="emp_pass" required>

                <label for="employmentType">Employment Type</label>
                <select id="employmentType" name="emp_type">
                    <option class="optionss" value="Full-time">Full-time</option>
                    <option class="optionss" value="Part-time">Part-time</option>
                </select>

                <label for="age">Age</label>
                <input type="number" placeholder="Enter Your Age" name="emp_age" id="age">
             
                <label for="gender">Gender</label>
                <select id="gender" name="emp_gender">
                    <option class="optionss" value="Male">Male</option>
                    <option class="optionss" value="Female">Female</option>
                </select>

                <button type="submit" style="margin-top: 30px;" name="apply">Appy For Job</button>
                <button style="margin-top: 30px;" name="close" onclick="closeApplyForm()">close</button>
            </form>
        </div>


        <footer class="text-white text-center text-lg-start bg-dark mt-auto">
            <!-- Grid container -->
            <div class="container p-4">
                <!--Grid row-->
                <div class="row mt-4">
                    <!--Grid column-->
                    <div class="col-lg-4 col-md-12 mb-4 mb-md-0 px-4">
                        <h5 class="text-uppercase mb-4">Apply for Job</h5>

                        <p>
                            A Travel Agent is a professional who simplifies the process of arranging travel, acting as a
                            customer advocate, coordinator, and problem-solver. </p>

                        <!-- Job Apply Form Widget Here -->
                        <button onclick="openApplyForm()" type="button" id="Appbtn" name="apply">Apply</button>


                        <div class="mt-4">
                            <!-- Facebook -->
                            <a type="button" class="btn btn-floating btn-light btn-lg"><i
                                    class="fab fa-facebook-f"></i></a>
                            <!-- Dribbble -->
                            <a type="button" class="btn btn-floating btn-light btn-lg"><i
                                    class="fab fa-dribbble"></i></a>
                            <!-- Twitter -->
                            <a type="button" class="btn btn-floating btn-light btn-lg"><i
                                    class="fab fa-twitter"></i></a>
                            <!-- Google + -->
                            <a type="button" class="btn btn-floating btn-light btn-lg"><i
                                    class="fab fa-google-plus-g"></i></a>
                            <!-- Linkedin -->
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0 px-4">
                        <h5 class="text-uppercase mb-4 pb-1">Contact us</h5>

                        <ul class="fa-ul" style="margin-left: 1.65em;">
                            <li class="mb-3">
                                <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">3R9Q+9JF,
                                    Mhasrul-Varvandi Road,Satpur MIDC <br> Rd, Near S.M.E.S.Sanghavi College of
                                    Engineering,Nashik, Maharashtra 422202</span>
                            </li>
                            <li class="mb-3">
                                <span class="fa-li"><i class="fas fa-envelope"></i></span><span
                                    class="ms-2">gadaj209@gmail.com</span>
                            </li>
                            <li class="mb-3">
                                <span class="fa-li"><i class="fas fa-phone"></i></span><span
                                    class="ms-2">00000000000</span>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0 px-4">
                        <h5 class="text-uppercase mb-4">Opening hours</h5>

                        <table class="table text-center text-white">
                            <tbody class="fw-normal">
                                <tr>
                                    <td>Mon - Thu:</td>
                                    <td>8am - 9pm</td>
                                </tr>
                                <tr>
                                    <td>Fri - Sat:</td>
                                    <td>8am - 1am</td>
                                </tr>
                                <tr>
                                    <td>Sunday:</td>
                                    <td>9am - 10pm</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </div>
            <!-- Grid container -->


            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2020 Copyright:
                <p class="name">The Boys</p>
            </div>
            <!-- Copyright -->
        </footer>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../assets/js/logout.js"></script>
        <script>
            $(document).ready(function () {
                $('.hamburger-menu').click(function () {
                    $('nav ul').toggle();
                });
            });
        </script>
        <script>
            function openForm() {
                document.getElementById("myForm").style.display = "block";
            }

            function closeForm() {
                document.getElementById("myForm").style.display = "none";
            }
            function openApplyForm() {
                document.getElementById("myApplyForm").style.display = "block";
            }

            function closeApplyForm() {
                document.getElementById("myApplyForm").style.display = "none";
            }
            function openBookForm() {
                document.getElementById("myApplyForGuideForm").style.display = "block";
            }

            function closeBookForm() {
                document.getElementById("myApplyForGuideForm").style.display = "none";
            }

           /* function myBooking() {
                window.location('viewtour.php');
            }*/
        </script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>

</html>