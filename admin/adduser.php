<?php
session_start();

if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true){
    header("location: adminlogin.php");
    exit;
}
$emailEx = false;
$exists = false;
// connect to database  
include("./config/db_connect.php");

if(isset($_POST['createUser'])){
    $uname = $_POST['uname'];
    $uemail = $_POST['uemail'];
    $pass = $_POST['pass'];

    // Check if email already exists
    $existsSql = "SELECT * FROM `tuser` WHERE `uemail` = ?";
    $stmt = mysqli_prepare($conn, $existsSql);
   // echo $stmt;
    mysqli_stmt_bind_param($stmt, "s", $uemail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $numExistRow = mysqli_num_rows($result);

    if($numExistRow > 0){
        $exists = true;
    } else {
        $exists = false;
    }

    if($exists == false){
        $query = "INSERT INTO `tuser` (`id`, `uname`, `uemail`, `pass`, `register_date`) VALUES (NULL, ?, ?, ?, current_timestamp());";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $uname, $uemail, $pass);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: manageuser.php");
            exit();
        } else {
            echo "<p style='color:red'>Error registering user</p>";
        }
    } else {
      $emailEx ="<p style='color:red'>Email already exists</p>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="datatables.min.css" >
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
   
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TouristWebsite</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                  
                    </li>
                </ul>
                <div class="d-flex" role="search">
                  <button  class="btn btn-outline-success"style="margin-right:10px;" type="button" > <?php 
        echo "Welcome ".$_SESSION['auname'] ."!";
        ?></button>               
                  <button class="btn btn-outline-danger" type="button" onclick="location.href='adminlogout.php'" >Logout</button>
                </div>
            </div>
        </div>
    </nav>
    <nav style="--bs-breadcrumb-divider: '>'; margin-left:20px;" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add User</li>
  </ol>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
            <hr>
            <hr>
            <hr>
            <br>
           <h1>Manage Users</h1>
            <br>
            <hr>
            <hr>
            <hr>
                <form method="post">
                    <div class="mb-3">
                        <label for="uname" class="form-label">Name</label>
                        <input type="text" class="form-control" id="uname" name="uname" required>
                    </div>
                    <div class="mb-3">
                    <?php echo  $emailEx; ?>
                        <label for="uemail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="uemail" name="uemail" required>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input class="form-control" id="pass" name="pass" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="createUser">Add User</button>
                </form>
            </div>
            <br>
            <hr>
            <hr>
            <hr>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gybBud7RduPuemT//+jJXB16zg6i8UQD3lV5uDC3Yc7bz1Eeow" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script src="datatables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.dataTables.min.js"></script>

    <script>
      /*  $(document).ready(function() {
            $('#myTable').DataTable();
        });

        const myModal = document.getElementById('editModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})*/
    </script>
     <script>
   /*  edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click", (e)=>{
                console.log("edit", );
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title,description);
                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                console.log("Btn Sno : ",e.target.id);
                $('#editModal').modal('toggle');
        })
        })
        deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element)=>{
    element.addEventListener("click", (e)=>{
        console.log("edit", );
        sno = e.target.id.substr(1,);
        if(confirm("Delete Note !")){
            console.log("yes");
            window.location = 'index.php?delete=' + sno;
        }
        else{
            console.log("no");
        }
    })
})*/
    </script>
</body>
</html>