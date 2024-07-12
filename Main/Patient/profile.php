<?php

session_start();
include("../../includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
 }

$user_id = $_SESSION["user_id"];
$patient_sql = "SELECT * FROM users where id = '$user_id'";
$patient_result = mysqli_query($conn, $patient_sql);

// $name = $email = $phone = '';

if (mysqli_num_rows($patient_result) > 0) {
    $row = mysqli_fetch_assoc($patient_result);
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
}

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $patientname = $_POST['patientname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Sanitize inputs to prevent SQL injection
    $patientname = mysqli_real_escape_string($conn, $patientname);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);

    // Update query
    $sql = "UPDATE users SET name = '$patientname', email = '$email', phone = '$phone' WHERE id = $user_id";
    $patient_sql = "UPDATE patients SET patientname = '$patientname', email = '$email', phone = '$phone' WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        if ($conn->query($sql) === TRUE) {
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating profile: " . $conn->error;
        }
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zion Patient</title>
            <!-- favicon -->
            <link rel="icon"  href="../Patient/img/logo 1.png" type="image/png">

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
                <div class="sidebar-brand-text mx-3">Patient</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
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
                        
                            <a class="collapse-item" href="book_appointment.php">Book Appointment </a>
                            <a class="collapse-item" href="view_appointment.php">View Appointment</a>
                           
                        </div>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Profile</span>
                    </a>
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
                            <span class="badge badge-warning navbar-badge">1</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">1 Notifications</span>
                            <div class="dropdown-divider"></div>
                            
                            
                            <div class="dropdown-divider"></div>
                            <a href="view_appointment.php" class="dropdown-item dropdown-footer">See All Notifications</a>
                            </div>
                        </li>

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                     
                        <div class="topbar-divider d-none d-sm-block"></div>

                       

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Profile </h1>
                    </div>

                    <!-- Content Row -->
                    <form method="POST">
                        <section class="section">
                            <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="card border-0 shadow rounded overflow-hidden">
                                        <ul class="nav nav-pills nav-justified flex-column flex-sm-row rounded-0 shadow overflow-hidden bg-light mb-0" id="pills-tab">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link rounded-0 active" id="clinic-booking" data-bs-toggle="pill" href="#pills-clinic" style="background-color: rgba(0, 108, 187, 1);color: white;">
                                                    <div class="text-center pt-1 pb-1">
                                                        <h5 class="fw-medium mb-0">Profile</h5>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                    
                                        <div class="tab-content p-4" id="pills-tabContent">
                                            <div class="tab-pane fade active show" id="pills-clinic" role="tabpanel" aria-labelledby="clinic-booking">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="name2" class="form-label">Full Name <span class="text-danger">*</span></label>
                                                                <input name="patientname" id="name2" type="text" class="form-control" value="<?php echo $name ?>" />
                                                            </div>
                                                        </div><!--end col-->
                                                        
                                                    
                    
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="email2" class="form-label">Your Email <span class="text-danger">*</span></label>
                                                                <input name="email" id="email2" type="email" class="form-control" value="<?php echo $email ?>" />
                                                            </div>
                                                        </div><!--end col-->
                    
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="phone2" class="form-label">Your Phone <span class="text-danger">*</span></label>
                                                                <input name="phone" id="phone2" type="tel" class="form-control" value="<?php echo $phone ?>" />
                                                            </div>
                                                        </div><!--end col-->
                    
                                                        
                                                        </div><!--end row-->
                                                        <div class="col-lg-6" style="background-color: rgba(0, 108, 187, 1);color: white;">
                                                        <div class="d-grid">
                                                            <button type="submit" href="index.php" class="btn btn" style="color: white;">Edit Profile</button>
                                                        </div>
                                                    </div><!--end col-->
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                
                    

               
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
                    <a class="btn btn-primary" href="../login.php">Logout</a>
                </div>
            </div>
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
    </script>
    <script src="../assets/libs/js-datepicker/datepicker.min.js"></script>
    <script src="../assets/libs/feather-icons/feather.min.js"></script>
    <!-- Main Js -->
    <!-- JAVASCRIPT -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/plugins.init.js"></script>
    <script src="../assets/js/app.js"></script>
    

</body>

</html>

