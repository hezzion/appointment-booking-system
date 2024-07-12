<?php
include("../includes/db.php");

$sql = "SELECT * FROM doctors";
$result = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor_id'];

    $delete_sql = "DELETE FROM doctors WHERE id = '$doctor_id'";
    $delete_result = mysqli_query($conn, $delete_sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zion Admin</title>
            <!-- favicon -->
        <link rel="icon"  href="../assets/images/logo 1.png" type="image/png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Reason for Declining Modal -->
<div class="modal fade" id="declineModal" tabindex="-1" role="dialog" aria-labelledby="declineModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="declineModalLabel">Reason for Declining</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="reason">Enter Reason:</label>
                    <textarea class="form-control" id="reason" rows="4"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" type="button" id="submitDecline">Submit</button>
        </div>
    </div>
</div>
</div>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: rgba(0, 108, 187, 1);color: white;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon ">
                   <img src="./img/logo 1.png" type="image/png" style="width: 70px; height: 50px;" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">Admin </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Appointments</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                       
                    <a class="collapse-item" href="appointment.php">All Appointments</a>
                        <a class="collapse-item" href="approved.php">Aproved Apointments</a>
                        <a class="collapse-item" href="declined.php">Declined Apointments</a>
                        <a class="collapse-item" href="pending.php">Pending Apointments</a>
                    </div>
                </div>
            </li>
             <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="true" aria-controls="collapseThree">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Manage Patients</span>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                        
                            <a class="collapse-item" href="view_patients.php">View Patients</a>
                            
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThre"
                        aria-expanded="true" aria-controls="collapseThre">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Manage Doctors</span>
                    </a>
                    <div id="collapseThre" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                        
                            <a class="collapse-item" href="view_doctors.php">View Doctors</a>
                            <a class="collapse-item" href="add_doctor.php">Add Doctor</span></a>
                            
                        </div>
                    </div>
                </li>
            
            
          

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

           
             <!-- Sidebar Toggler (Sidebar) -->
             <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn" type="button" style="background-color: rgba(0, 108, 187, 1);color: white;">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">5</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">5 Notifications</span>
                            <div class="dropdown-divider"></div>
                            
                            <div class="dropdown-divider"></div>
                            <a href="appointment.php" class="dropdown-item dropdown-footer">See All Notifications</a>
                            </div>
                        </li>

                       

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">View Doctors</h1>
                    </div>

                    <!-- Content Row -->
                    
                
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="table-responsive bg-white shadow rounded">
                            <table class="table mb-0 table-center table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="border-bottom p-3">S/N</th>
                                        <th class="border-bottom p-3" style="min-width: 150px;">Full Name</th>
                                        <th class="border-bottom p-3">Email</th>
                                        <th class="border-bottom p-3">Department</th>
                                        <th class="border-bottom p-3" style="min-width: 150px;">Phone No</th>
                                        <th class="border-bottom" style="min-width: 140px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        $sn = 1;
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<th class='p-3'>{$sn}</th>";
                                            echo "<td class='p-3'>{$row['fullname']}</td>";
                                            echo "<td class='p-3'>{$row['email']}</td>";
                                            echo "<td class='p-3'>{$row['department']}</td>";
                                            echo "<td class='p-3'>{$row['phone']}</td>";
                                            echo "<td class='text-end p-3'>";
                                            echo "<form method='post'><input type='hidden' name='doctor_id' id='doctor_id' value={$row['id']} /> <button type='submit' class='btn btn-icon btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?')\"><i class='fas fa-trash'></i></button></form>";
                                            echo "</td>";
                                            echo "</tr>";
                                            $sn++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center p-3'>No records found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
               
          </div>
                    <!-- Content Row -->

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    
    <script>
        // Function to handle the decline submission
        function submitDecline() {
            var reason = document.getElementById('reason').value;
            // TODO: Perform necessary actions with the reason (e.g., send it to the server)

            // Close the modal
            $('#declineModal').modal('hide');
        }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    

</body>

</html>

