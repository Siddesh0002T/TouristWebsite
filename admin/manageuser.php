<?php
$insert = false;
 // Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "NoteWeb_DB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: ". $conn->connect_error);
}
else{
 // echo"Connected";
}
if(isset($_GET['delete'])){
    $sno = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM `notes` WHERE `sno` =?");
    $stmt->bind_param("i", $sno);
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error: ". $stmt->error;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {
        // update the record
        $sno = $_POST["snoEdit"];
        $title = $_POST['titleEdit'];
        $description = $_POST['descriptionEdit'];
        $insert = false;
        if ($title!= "") {
            $stmt = $conn->prepare("UPDATE `notes` SET `title` =?, `description` =? WHERE `notes`.`sno` =?");
            $stmt->bind_param("ssi", $title, $description, $sno);
            if ($stmt->execute()) {
                //echo '<p>New record created successfully  </p>';
                $insert = true;
            } else {
                echo "Error: ". $stmt->error;
            }
        }
    } else {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $insert = false;
        if ($title!= "") {
            $stmt = $conn->prepare("INSERT INTO `notes`(`title`, `description`, `tstamp`) VALUES (?,?, NOW())");
            $stmt->bind_param("ss", $title, $description);
            if ($stmt->execute()) {
                //echo '<p>New record created successfully  </p>';
                $insert = true;
            } else {
                echo "Error: ". $stmt->error;
            }
        } else {
            echo "empty";
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NoteWeb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="datatables.min.css" >
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
   
</head>

<body>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit Note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="index.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit"> 
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="titleEdit" name="titleEdit" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Note</button>
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">NoteWeb</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">About Us</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
           
            <br>
            <hr>
            <hr>
            <hr>
            <div class="col-md-12">

                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date And Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM notes";
                        $result = mysqli_query($conn, $sql);
                        $sno = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sno = $sno + 1;
                            echo "<tr>
                                    <th scope='row'>".$sno." </th>
                                    <td>" . $row['title'] . "</td>
                                    <td>" . $row['description'] . "</td>
                                    <td>" . $row['tstamp'] . "</td>
                                    <td><button class='btn btn-sm btn-primary edit' id=".$row['sno'].">Edit</button> <button class='btn btn-sm btn-primary delete' id=d".$row['sno'].">Delete</button></td>
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

    <script src="datatables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
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
})
    </script>
</body>
</html>