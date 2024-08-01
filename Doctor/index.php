<?php
include("../includes/db.php");
session_start();

if (!isset($_SESSION["doctor_id"])) {
    header("Location: login.php");
}

$doctor_id = $_SESSION['doctor_id'];

$doctor_sql = "SELECT * FROM doctors WHERE id = '$doctor_id'";
$doctor_result = mysqli_query($conn, $doctor_sql);

$doctor_name = $doctor_slot = '';

if (mysqli_num_rows($doctor_result) > 0) {
    $row = mysqli_fetch_assoc($doctor_result);
    $doctor_name = $row['fullname'];
    $doctor_slot = $row['slot'];
}

$sql = "SELECT * FROM patients WHERE doctor = '$doctor_name'";
$result = mysqli_query($conn, $sql);

$sqlTotalApprovedAppointments = "SELECT COUNT(*) AS total_approved FROM patients WHERE status = 'Approved' AND doctor = '$doctor_name'";
$resultApproved = $conn->query($sqlTotalApprovedAppointments);
if (!$resultApproved) {
    die("Query failed: " . $conn->error);
}
$totalApproved = $resultApproved->fetch_assoc()['total_approved'];

// Total Declined Appointments
$sqlTotalDeclinedAppointments = "SELECT COUNT(*) AS total_declined FROM patients WHERE status = 'Declined' AND doctor = '$doctor_name'";
$resultDeclined = $conn->query($sqlTotalDeclinedAppointments);
if (!$resultDeclined) {
    die("Query failed: " . $conn->error);
}
$totalDeclined = $resultDeclined->fetch_assoc()['total_declined'];

$sqlTotalDoctorAppointments = "SELECT COUNT(*) AS total_doctor_appointments FROM patients WHERE doctor = '$doctor_name'";
$resultDoctorAppointments = $conn->query($sqlTotalDoctorAppointments);
if (!$resultDoctorAppointments) {
    die("Query failed: " . $conn->error);
}
$totalDoctorAppointments = $resultDoctorAppointments->fetch_assoc()['total_doctor_appointments'];

$unread_sql = "SELECT COUNT(*) AS unread_count FROM notifications WHERE is_read_doctor = FALSE";
$unread_result = mysqli_query($conn, $unread_sql);
$unread_count = 0;

if ($unread_result) {
    $unread_row = mysqli_fetch_assoc($unread_result);
    $unread_count = $unread_row['unread_count'];
}

$unread_sql2 = "SELECT * FROM notifications WHERE is_read_doctor = FALSE ORDER BY created_at DESC";
$unread_result2 = mysqli_query($conn, $unread_sql2);
$unread_notifications = [];

if ($unread_result2) {
    while ($row = mysqli_fetch_assoc($unread_result2)) {
        $unread_notifications[] = $row;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zion Doctor</title>
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
                    <div class="sidebar-brand-text mx-3">Doctor </div>
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
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                            aria-expanded="true" aria-controls="collapseThree">
                            <i class="fas fa-fw fa-cog"></i>
                            <span>Manage Appointments</span>
                        </a>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                            
                                <a class="collapse-item" href="view_appointments.php">View Appointments</a>
                                <a class="collapse-item" href="pending.php">Pending Appointments</a>
                                <a class="collapse-item" href="approved.php">Approved Appointments</a>
                                <a class="collapse-item" href="declined.php">Declined Appointments</a>
                               
                            
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
                            <span class="badge badge-warning navbar-badge"><?php echo $unread_count; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header"><?php echo $unread_count; ?> Notifications</span>
                            <div class="dropdown-divider"></div>
                            <?php foreach ($unread_notifications as $notification) { ?>
                                <div class="dropdown-item">
                                    <i class="fas fa-envelope mr-2"></i> <?php echo $notification['message']; ?>
                                    <span class="float-right text-muted text-sm"><?php echo $notification['created_at']; ?></span>
                                </div>
                            <?php } ?>
                            <div class="dropdown-divider"></div>
                            <a href="pending.php" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                     
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome, <?php echo $doctor_name ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                               
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#slotModal">
                                    <i class="fas fa-pencil-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Create slot
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Appointments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalDoctorAppointments ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Approved Appointments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalApproved ?></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Declined Appointments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalDeclined ?></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                
                <section class="content">
                
                <!-- ./col -->
            
                <!-- ./col -->
                
                <section class="content">
                <div class="container-fluid" style="margin-top: 0px;">
                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                        
                        <!-- /.card-header -->
                        <div class="table-responsive bg-white shadow rounded">
                            <table id="example2" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Patientname</th>
                                <th>Departments</th>
                                <th>Doctor</th>
                                <th>Your_Email</th>
                                <th>Your_Phone</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Comments</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($result) {
                                if (mysqli_num_rows($result)){
                                    while($row = mysqli_fetch_array($result)){ ?>
                                    <tr>
                                        <td><?php echo $row["patientname"] ?></td>
                                        <td><?php echo $row["departments"] ?></td>
                                        <td><?php echo $row["doctor"] ?></td>
                                        <td><?php echo $row["your_email"] ?></td>
                                        <td><?php echo $row["your_phone"] ?></td>
                                        <td><?php echo $row["date"] ?></td>
                                        <td><?php echo $row["time"] ?></td>
                                        <td><?php echo $row["comments"] ?></td>
                                    </tr>
                                            
                                    <?php }
                                }
                                }

                            ?>
                    
                        <!-- /.card-body -->
                        </div>
                <!-- ./col -->
                    </div> 
                    </div>
                    </div>

                    </div>
                    </section>



                    
                    </section>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="post" action='logout.php'>
                        <button class="btn btn-primary" type='submit'>Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Slot Modal-->
    <div class="modal fade" id="slotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action='add_slot.php'>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create a slot</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="mb-3 p-3">
                        <label for="slot" class="form-label">Create slot</label>
                        <input
                            type="number"
                            class="form-control"
                            name="slot"
                            id="slot"
                            placeholder="Enter a number"
                            value="<?php echo $doctor_slot ?>"
                        />
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type='submit'>Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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

