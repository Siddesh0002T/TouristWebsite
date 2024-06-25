<?php
session_start();

if (!isset($_SESSION['emploggedin']) || $_SESSION['emploggedin'] != true) {
    header("location: emplogin.php");
    exit;
}

include '../config/db_connect.php';
$emp_id = $_SESSION['emp_id']; 
// Check if the request is AJAX
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update the status in the database
    $stmt = $conn->prepare("UPDATE tour_assignments SET status =? WHERE id =?");
    $stmt->bind_param("ii", $status, $id);
    $stmt->execute();

 
    if($status == 1){
        $sql = "UPDATE emp SET is_free = TRUE WHERE emp_id = $emp_id";
        $conn->query($sql);
    }
    else{
        $sql = "UPDATE emp SET is_free = FALSE WHERE emp_id = $emp_id";
        $conn->query($sql);
    }
       // Return a success message
       echo 'Status updated successfully!';
       exit;
   
}

$emp_id = $_SESSION['emp_id'];

$stmt = $conn->prepare("SELECT tuser.uname, tuser.uemail, tour_assignments.tour_date, tour_assignments.status, tour_assignments.id
                        FROM tour_assignments 
                        JOIN tuser ON tour_assignments.user_id = tuser.id 
                        WHERE tour_assignments.emp_id =?");
$stmt->bind_param("i", $emp_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/dataTables/datatables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/dataTables/datatables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../modules/home.php">TouristWebsite</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="employee.php">Home</a>
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
            <li class="breadcrumb-item active" aria-current="page">My Tasks</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <hr>
            <hr>
            <hr>
            <br>
            <h1>Manage Tasks</h1>
            <br>
            <hr>
            <hr>
            <hr>
            <div class="col-md-12">

                <table class="table" id="myUserManage">
                    <thead>
                        <tr>
                            <th scope="col">Sr.No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tour Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $emp_id = $_SESSION['emp_id']; // Added semicolon
                        
                        $stmt = $conn->prepare("SELECT tuser.uname, tuser.uemail, tour_assignments.tour_date, tour_assignments.status ,tour_assignments.id
                        FROM tour_assignments 
                        JOIN tuser ON tour_assignments.user_id = tuser.id 
                        WHERE tour_assignments.emp_id =?");
                        $stmt->bind_param("i", $emp_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        $sno = 0;
                        while ($row = $result->fetch_assoc()) {
                            $sno = $sno + 1;
                            echo "<tr>
                                    <td scope='row'>" . $sno . " </td>
                                    <td>" . $row['uname'] . "</td>
                                    <td>" . $row['uemail'] . "</td>
                                    <td>" . $row['tour_date'] . "</td>
                                    <td><button class='status-btn btn btn-dark' data-task-id='" . $row['id'] . "' data-status='" . $row['status'] . "'>" . ($row['status'] == 1 ?  'Completed' : 'Pending') . "</button></td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.dataTables.min.js"></script>
    <script>
    </script>

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

    <script src="./assets/js/dataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.dataTables.min.js"></script>
    <script>
    // Add an event listener to the status buttons
    document.addEventListener('DOMContentLoaded', function() {
        const statusBtns = document.querySelectorAll('.status-btn');

        statusBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const taskId = this.getAttribute('data-task-id');
                const status = this.getAttribute('data-status') == 1? 0 : 1;

                // Send an AJAX request to update the status
                fetch('<?php echo $_SERVER['PHP_SELF'];?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${taskId}&status=${status}`
                })
               .then(response => response.text())
               .then(message => {
                    console.log(message);
                    // Update the button text
                    this.textContent = status == 1?  'Completed':'Pending';
                })
               .catch(error => console.error(error));
            });
        });
    });
</script>
    <script>
        $(document).ready(function () {
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
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit",);
                tr = e.target.parentNode.parentNode;
                uname = tr.getElementsByTagName("td")[1].innerText;
                uemail = tr.getElementsByTagName("td")[2].innerText;
                console.log(uname, uemail);
                unameEdit.value = uname;
                uemailEdit.value = uemail;
                snoEdit.value = e.target.id;
                console.log("Btn Sno : ", e.target.id);
                $('#editModal').modal('toggle');
            })
        })
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete",);
                sno = e.target.id.substr(1,);
                if (confirm("Delete User !")) {
                    console.log("yes");
                    window.location = 'manageuser.php?delete=' + sno;
                }
                else {
                    console.log("no");
                }
            })
        })
    </script>
</body>

</html>