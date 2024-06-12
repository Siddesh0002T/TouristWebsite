<?php
session_start();

if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true){
    header("location: adminlogin.php");
    exit;
}

$insert = false;
include './config/db_connect.php';
if(isset($_GET['delete'])){
    $sno = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM `tuser` WHERE `id` =?");
    $stmt->bind_param("i", $sno);
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error: ". $stmt->error;
    }
}
// Alter User By Admin
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (isset($_POST['snoEdit'])) {
        // update the record
        $id = $_POST["snoEdit"];
        $uname = $_POST['unameEdit'];
        $uemail = $_POST['uemailEdit'];
        $insert = false;
        if ($uname!= "") {
            $stmt = $conn->prepare("UPDATE `tuser` SET `uname` =?, `uemail` =? WHERE `tuser`.`id` =?");
            $stmt->bind_param("ssi", $uname, $uemail, $idS);
            if ($stmt->execute()) {
                //echo '<p>New record created successfully  </p>';
                $insert = true;
            } else {
                echo "Error: ". $stmt->error;
            }
        }
    } 
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manageusers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/dataTables/datatables.min.css" >
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
   
</head>

<body>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="manageuser.php" method="post">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Alter User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     
        <input type="hidden" name="snoEdit" id="snoEdit"> 
                    <div class="mb-3">
                        <label for="unameEdit" class="form-label">Name</label>
                        <input type="text" class="form-control" id="unameEdit" name="unameEdit" required>
                    </div>
                    <div class="mb-3">
                        <label for="uemailEdit" class="form-label">Email</label>
                        <input type="email" class="form-control" id="uemailEdit" name="uemailEdit"  required>
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Alter User</button>
      </div>
      </form>
    </div>
  </div>
</div>
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
                    <input class="form-control me-2" type="search" placeholder="Search"class="dt-input">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </div>
        </div>
    </nav>
    <?php 
        echo "Welcome ".$_SESSION['auname'] ."!";
        ?>
    <div class="container">
        <div class="row">
        <hr>
            <hr>
            <hr>
            <br>
           <h1>Manage Users</h1>
            <br>
            <hr>
            <hr>
            <hr>
            <div class="col-md-12">

                <table class="table" id="myUserManage">
                    <thead>
                        <tr>
                            <th scope="col">Sr.No.</th>
                            <th scope="col">Name </th>
                            <th scope="col">Email</th>
                            <th scope="col">Date And Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tuser";
                        $result = mysqli_query($conn, $sql);
                        $sno = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sno = $sno + 1;
                            echo "<tr>
                                    <td scope='row'>".$sno." </td>
                                    <td>" . $row['uname'] . "</td>
                                    <td>" . $row['uemail'] . "</td>
                                    <td>" . $row['register_date'] . "</td>
                                    <td><button class='btn btn-sm btn-primary edit' id=".$row['id'].">Edit</button> <button class='btn btn-sm btn-danger delete' id=d".$row['id'].">Delete</button></td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
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

    <script src="./assets/js/dataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myUserManage').DataTable();
        });

        const myModal = document.getElementById('editModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
    </script>
     <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click", (e)=>{
                console.log("edit", );
                tr = e.target.parentNode.parentNode;
                uname = tr.getElementsByTagName("td")[1].innerText;
                uemail = tr.getElementsByTagName("td")[2].innerText;
                console.log(uname,uemail);
                unameEdit.value = uname;
                uemailEdit.value = uemail;
                snoEdit.value = e.target.sno;
                console.log("Btn Sno : ",e.target.id);
                $('#editModal').modal('toggle');
        })
        })
        deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element)=>{
    element.addEventListener("click", (e)=>{
        console.log("delete", );
        sno = e.target.id.substr(1,);
        if(confirm("Delete Note !")){
            console.log("yes");
            window.location = 'manageuser.php?delete=' + sno;
        }
        else{
            console.log("no");
        }
    })
})
    </script>
</body>
</html>