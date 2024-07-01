<?php
session_start();

if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] != true) {
    header("location: adminlogin.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashbord</title>
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
                        <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
                    </li>
                    <li class="nav-item">

                    </li>
                </ul>
                <div class="d-flex" role="search">
                    <button class="btn btn-outline-success" style="margin-right:10px;" type="button"> <?php
                    echo "Welcome " . $_SESSION['auname'] . "!";
                    ?></button>
                    <button class="btn btn-outline-danger" type="button"
                        onclick="location.href='adminlogout.php'">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">

            <hr>
            <hr>
            <hr>
            <br>
            <h1> <?php
            echo "Welcome " . $_SESSION['auname'] . "!";
            ?></h1>
            <br>
            <hr>
            <hr>
            <hr>
            <div class="col-md-12">
                <h3>Users</h3>
                <hr>
                <table class="table" id="adminFunction">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Use</th>
                            <th scope="col">Button</th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h3><b>Create User</b></h3>
                            </td>
                            <td>Create User in Database</td>
                            <td><button class="btn btn-outline-primary" type="button"
                                    onclick="location.href='adduser.php'">Go !</button></td>
                        </tr>
                        <tr>
                            <td>
                                <h3><b>Manage User</b></h3>
                            </td>
                            <td>Manage User edit,block/unblock,and delete user from database</td>
                            <td><button class="btn btn-outline-primary" type="button"
                                    onclick="location.href='manageuser.php'">Go !</button></td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h3>Admins</h3>
                <hr>
                <table class="table" id="adminFunction">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Use</th>
                            <th scope="col">Button</th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h3><b>Create Admin</b></h3>
                            </td>
                            <td>Create Admin in Database</td>
                            <td><button class="btn btn-outline-primary" type="button"
                                    onclick="location.href='addadmin.php'">Go !</button></td>
                        </tr>
                        <tr>
                            <td>
                                <h3><b>Manage Admins</b></h3>
                            </td>
                            <td>Manage Admin edit,block/unblock,and delete user from database</td>
                            <td><button class="btn btn-outline-primary" type="button"
                                    onclick="location.href='manageadmin.php'">Go !</button></td>

                        </tr>
                    </tbody>
                </table>
                <h3>Employees</h3>
                <hr>
                <table class="table" id="adminFunction">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Use</th>
                            <th scope="col">Button</th>


                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr>
                            <td>
                                <h3><b>Manage Emp</b></h3>
                            </td>
                            <td>Manage Emp edit,block/unblock,and delete user from database</td>
                            <td><button class="btn btn-outline-primary" type="button"
                                    onclick="location.href='manageEmp.php'">Go !</button></td>
                        </tr>
                    </tbody>
               
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

    <script src="./assets/js/dataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.dataTables.min.js"></script>
    <script>
    </script>
</body>

</html>