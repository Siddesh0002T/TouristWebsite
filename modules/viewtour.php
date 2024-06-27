<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

include '../config/db_connect.php';

$user_id = $_SESSION['user_id'];
// echo $user_id;

?>


<!-- table start-->
<table class="table" border="1px" id="myUserManage">
                    <thead>
                        <tr>
                            <th scope="col">Tour Sr.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Tour Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                    
                        $stmt = $conn->prepare("SELECT emp.emp_name, emp.emp_email, emp.emp_phone, emp.emp_age, emp.emp_gender, tour_assignments.tour_date, tour_assignments.status ,tour_assignments.id
                        FROM tour_assignments 
                        JOIN emp ON tour_assignments.emp_id = emp.emp_id 
                        WHERE tour_assignments.user_id =?");
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        $sno = 0;
                        while ($row = $result->fetch_assoc()) {
                            $sno = $sno + 1;
                            echo "<tr>
                                    <td scope='row'>" . $sno . " </td>
                                    <td>" . $row['emp_name'] . "</td>
                                    <td>" . $row['emp_email'] . "</td>
                                    <td>" . $row['emp_phone'] . "</td>
                                    <td>" . $row['emp_age'] . "</td>
                                    <td>" . $row['emp_gender'] . "</td>
                                    <td>" . $row['tour_date'] . "</td>
                                    <td><span class='status-btn btn btn-dark' data-task-id='" . $row['id'] . "' data-status='" . $row['status'] . "'>" . ($row['status'] == 1 ?  'Pending' :'Completed' ) . "</span></td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>