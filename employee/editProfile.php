<?php
session_start();

if (!isset($_SESSION['emploggedin']) || $_SESSION['emploggedin'] != true) {
    header("location: emplogin.php");
    exit;
}

// connect to database  
include ("../config/db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // update the record
    $emp_id = $_SESSION['emp_id'];
    $emp_name = $_POST['emp_nameEdit'];
    $emp_email = $_POST['emp_emailEdit'];
    $emp_phone = $_POST['emp_phoneEdit'];
    $emp_type = $_POST['emp_typeEdit'];
    $emp_age = $_POST['emp_ageEdit'];
    $emp_gender = $_POST['emp_genderEdit'];

    $stmt = $conn->prepare("UPDATE `emp` SET `emp_name` = ?, `emp_email` = ?, `emp_phone` = ?, `emp_type` = ?, `emp_age` = ?, `emp_gender` = ? WHERE `emp`.`emp_id` = ?");
    $stmt->bind_param("ssssssi", $emp_name, $emp_email, $emp_phone, $emp_type, $emp_age, $emp_gender, $_SESSION['emp_id']);
    if ($stmt->execute()) {
       // echo '<p>New record created successfully  </p>';
       $_SESSION['emp_name'] = $emp_name;
       $_SESSION['emp_email'] = $emp_email;
       $_SESSION['emp_phone'] = $emp_phone;
       $_SESSION['emp_type'] = $emp_type;
       $_SESSION['emp_age'] = $emp_age;
       $_SESSION['emp_gender'] = $emp_gender;
      header("location: empprofile.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="datatables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../modules/home.php">TouristWebsite</a>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
                    </li>
                    <li class="nav-item">

                    </li>
                </ul>
                <div class="d-flex" role="search">
                    <button class="btn btn-outline-success" style="margin-right:10px;" type="button"> <?php
                    echo "Welcome " . $_SESSION['emp_name'] . "!";
                    ?></button>
                    <button class="btn btn-outline-danger" type="button"
                        onclick="location.href='emplogout.php'">Logout</button>
                </div>
            </div>
        </div>
    </nav>
    <nav style="--bs-breadcrumb-divider: '>'; margin-left:20px;" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="employee.php">Home</a></li>
            <li class="breadcrumb-item"><a href="empprofile.php">My Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <hr>
                <hr>
                <h1>Edit Profile</h1>
                <hr>
                <hr>
                <form action="editProfile.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="unameEdit" class="form-label" >Name</label>
                            <input type="text" class="form-control" id="unameEdit"  name="emp_nameEdit" value="<?php echo $_SESSION['emp_name']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="uemailEdit" class="form-label">Email</label>
                            <input type="email" class="form-control" id="uemailEdit" name="emp_emailEdit" value="<?php echo $_SESSION['emp_email']; ?>"  required>
                        </div>
                        <div class="mb-3">
                            <label for="uemailEdit" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="uemailEdit" name="emp_phoneEdit" value="<?php echo $_SESSION['emp_phone']; ?>"  required>
                        </div>
                        <div class="mb-3">
                            <label for="uemailEdit" class="form-label">Employee Type</label>
                            <input type="text" class="form-control" id="uemailEdit" name="emp_typeEdit" value="<?php echo $_SESSION['emp_type']; ?>"  required>
                        </div>
                        <div class="mb-3">
                            <label for="uemailEdit" class="form-label">Age</label>
                            <input type="number" class="form-control" id="uemailEdit" name="emp_ageEdit" value="<?php echo $_SESSION['emp_age']; ?>"  required>
                        </div>
                        <div class="mb-3">
                            <label for="uemailEdit" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="uemailEdit" name="emp_genderEdit" value="<?php echo $_SESSION['emp_gender']; ?>"  required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="location.href='empprofile.php'">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

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