<?php
include("../includes/db.php");
session_start();

$doctor_id = $_SESSION['doctor_id'];

$doctor_sql = "SELECT * FROM doctors WHERE id = '$doctor_id'";
$doctor_result = mysqli_query($conn, $doctor_sql);

$doctor_name = '';

if (mysqli_num_rows($doctor_result) > 0) {
    $row = mysqli_fetch_assoc($doctor_result);
    $doctor_name = $row['fullname'];
}

$sql = "SELECT * FROM patients WHERE doctor = '$doctor_name' AND status = 'Approved'";
$result = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $reply = mysqli_real_escape_string($conn, $_POST['reply']);
    $status = mysqli_real_escape_string($conn, $_POST['checkedValue']);
    $appointment_id = $_POST['appointment_id'];

    $sql = "UPDATE patients SET reply = '$reply', status = '$status' WHERE id = $appointment_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        header("Location: view_appointments.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
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
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

</head>

<body id="page-top">
    <!-- Reason for Declining Modal -->

<div class="modal fade" id="declineReasonModal" tabindex="-1" role="dialog" aria-labelledby="declineReasonModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="declineReasonModalLabel">Decline Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="declineReasonForm" action="your_form_action.php" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="reason">Reason for declining:</label>
            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Submit</button>
        </div>
      </form>
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
                            <a class="collapse-item" href="approved.php">Aproved Appointments</a>
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
                            <span class="badge badge-warning navbar-badge">1</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">1 Notifications</span>
                            <div class="dropdown-divider"></div>
                            
                            
                            <div class="dropdown-divider"></div>
                            <a href="view_appointments.php" class="dropdown-item dropdown-footer">See All Notifications</a>
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
                        <h1 class="h3 mb-0 text-gray-800">View Appointments</h1>
                    </div>

                    <!-- Content Row -->
                    
                
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="table-responsive bg-white shadow rounded">
                            <div class="card-body">
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                          <th>Patientname</th>
                          <th>Departments</th>
                          <th>Your_Email</th>
                          <th>Your_Phone</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Status</th>
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
                                    <td><?php echo $row["your_email"] ?></td>
                                    <td><?php echo $row["your_phone"] ?></td>
                                    <td><?php echo $row["date"] ?></td>
                                    <td><?php echo $row["time"] ?></td>
                                    <td><?php echo $row["status"] ?></td>
                                </tr>

                                <div class="modal fade" id="declineModal" tabindex="-1" role="dialog" aria-labelledby="declineModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="declineModalLabel">Comment from patient</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method='post'>
                                                    <div class="form-group">
                                                        <label for="comment"> Comment:</label>
                                                        <textarea class="form-control" id="comment" rows="2" readonly><?php echo $row['comments'] ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reply">Enter Reply:</label>
                                                        <textarea class="form-control" id="reply" name="reply" rows="4"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="toggleSwitch">Status:</label>
                                                        <label class="switch">
                                                            <input type="checkbox" id="toggleSwitch">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <input type="hidden" id='checkedValue' name='checkedValue'>
                                                        <input type="hidden" id='appointment_id' name='appointment_id' value='<?php echo $row['id'] ?>'>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-primary" type="submit">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                     
                                <?php }
                            }
                          }

                        ?>
                
                    <!-- /.card-body -->
                  </div>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
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
    <script>
    document.getElementById('toggleReply').addEventListener('click', function() {
        var replyBox = document.getElementById('replyBox');
        if (replyBox.style.display === 'none') {
            replyBox.style.display = 'block';
        } else {
            replyBox.style.display = 'none';
        }
    });

    </script>
</script>
<script>
    document.getElementById('toggleSwitch').addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('checkedValue').value = 'Approved';
        } else {
            document.getElementById('checkedValue').value = 'Declined';
        }
    });
</script>

</body>

</html>

