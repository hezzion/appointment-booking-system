<?php

session_start();
include("../../includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch current user details
$patient_sql = "SELECT * FROM users WHERE id = '$user_id'";
$patient_result = mysqli_query($conn, $patient_sql);

if (mysqli_num_rows($patient_result) > 0) {
    $row = mysqli_fetch_assoc($patient_result);
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
}

// Initialize error variables
$error_message = "";
$success_message = "";

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $patientname = $_POST['patientname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Sanitize inputs to prevent SQL injection
    $patientname = mysqli_real_escape_string($conn, $patientname);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);
    
    // Check if passwords match
    if ($new_password !== $confirm_password) {
        $error_message = "New password and confirm password do not match.";
    } else {
        // Verify current password
        $password_sql = "SELECT password FROM users WHERE id = '$user_id'";
        $password_result = mysqli_query($conn, $password_sql);
        $password_row = mysqli_fetch_assoc($password_result);
        $hashed_password = $password_row['password'];

        if (password_verify($current_password, $hashed_password)) {
            // Hash new password
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update user details
            $update_sql = "UPDATE users SET name = '$patientname', email = '$email', phone = '$phone', password = '$hashed_new_password' WHERE id = '$user_id'";

            if ($conn->query($update_sql) === TRUE) {
                $success_message = "Profile updated successfully.";
                // Redirect to profile page to avoid form resubmission
                header("Location: profile.php");
                exit();
            } else {
                $error_message = "Error updating profile: " . $conn->error;
            }
        } else {
            $error_message = "Current password is incorrect.";
        }
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
    <link rel="icon" href="../Patient/img/logo 1.png" type="image/png">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<style>
    .btn-update-profile {
        background-color: #007bff; /* Blue color */
        color: white;
        border-radius: 25px; /* Rounded corners */
        font-weight: bold;
        padding: 10px 20px;
        border: none;
        transition: background-color 0.3s, box-shadow 0.3s;
        text-transform: uppercase;
    }

    .btn-update-profile:hover {
        background-color: #0056b3; /* Darker blue */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        text-decoration: none;
    }

    .btn-update-profile:focus {
        outline: none;
    }
</style>


<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: rgba(0, 108, 187, 1);color: white;">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
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
            <!-- Nav Item - Manage Appointments -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                   aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Appointments</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="book_appointment.php">Book Appointment</a>
                        <a class="collapse-item" href="view_appointment.php">View Appointment</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Profile -->
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
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
                                <a href="view_appointment.php" class="dropdown-item dropdown-footer">See All Notifications</a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
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
                                            <div class="card-body p-4">
                                                <?php if ($error_message): ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <?php echo htmlspecialchars($error_message); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($success_message): ?>
                                                    <div class="alert alert-success" role="alert">
                                                        <?php echo htmlspecialchars($success_message); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="tab-content" id="pills-tabContent">
                                                    <div class="tab-pane fade show active" id="pills-clinic">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="name2" class="form-label">Full Name <span class="text-danger">*</span></label>
                                                                    <input name="patientname" id="name2" type="text" class="form-control" value="<?php echo htmlspecialchars($name); ?>" />
                                                                </div>
                                                            </div><!--end col-->
                                                            
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="email2" class="form-label">Your Email <span class="text-danger">*</span></label>
                                                                    <input name="email" id="email2" type="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" />
                                                                </div>
                                                            </div><!--end col-->

                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="phone2" class="form-label">Your Phone <span class="text-danger">*</span></label>
                                                                    <input name="phone" id="phone2" type="tel" class="form-control" value="<?php echo htmlspecialchars($phone); ?>" />
                                                                </div>
                                                            </div><!--end col-->

                                                            <!-- Password Change Section -->
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                                                                    <input name="current_password" id="current_password" type="password" class="form-control" required />
                                                                </div>
                                                            </div><!--end col-->

                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                                                                    <input name="new_password" id="new_password" type="password" class="form-control" required />
                                                                </div>
                                                            </div><!--end col-->

                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="confirm_password" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                                                                    <input name="confirm_password" id="confirm_password" type="password" class="form-control" required />
                                                                </div>
                                                            </div><!--end col-->
                                                        </div><!--end row-->
                                                    
                                            
                                                        <div class="col-lg-6">
                                                            <div class="d-grid">
                                                                <button type="submit" class="btn btn-update-profile">Update Profile</button>
                                                            </div>
                                                        </div><!--end col-->
                                                        <!--end col-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
