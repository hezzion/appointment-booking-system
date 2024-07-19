<?php
include('../includes/db.php');
session_start();

if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to select user from database
    $sql = "SELECT id, email, password FROM admin WHERE email = ?";

    // Use prepared statements for security
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $email);

        // Execute SQL query
        $stmt->execute();
        $stmt->store_result();

        // Check if user exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $email, $hashed_password);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $hashed_password)) {
                $_SESSION['admin_id'] = $id;

                // Redirect to the dashboard or home page
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
        }

        // Close statement
        $stmt->close();
    } else {
        $error = "Prepare statement error: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>

<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zion Admin</title>
    <!-- favicon -->
    <link rel="icon" style="height: 10px;width: 10px;" href="../assets/images/logo.png" type="image/png">
    
    <!-- Css -->
    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" class="theme-opt" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/remixicon/fonts/remixicon.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/%40iconscout/unicons/css/line.css" type="text/css" rel="stylesheet" />
    <!-- Style Css-->
    <link href="../assets/css/style.min.css" class="theme-opt" rel="stylesheet" type="text/css" />
</head>

<body style="font-family: 'Arimo', sans-serif;">
    <div class="back-to-home rounded d-none d-sm-block">
        <a href="" class="btn btn-icon btn-primary"><i data-feather="home" class="icons"></i></a>
    </div>

    <!-- Hero Start -->
    <section class="bg-home d-flex bg-light align-items-center" style="background: url('../assets/images/bg/bg-lines-one.png') center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <img src="../assets/images/logo-dark.png" height="22" class="mx-auto d-block" alt="">
                    <div class="card login-page shadow mt-4 rounded border-0">
                    <div class="card-body">
                        <h4 class="text-center">Login</h4>
                        <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn" style="background-color: rgba(0, 108, 187, 1); color: white;">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div> <!-- end col -->
            </div><!-- end row -->
        </div> <!-- end container -->
    </section><!-- end section -->
    <!-- Hero End -->
    
    <!-- javascript -->
    <script src="../assets/libs/feather-icons/feather.min.js"></script>
    <!-- Main Js -->
    <!-- JAVASCRIPT -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/plugins.init.js"></script>
    <script src="../assets/js/app.js"></script>
</body>
</html>
