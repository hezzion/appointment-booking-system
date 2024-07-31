<?php 
session_start();
?>

<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZION - Login</title>
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
    <style>
        body {
            font-family: 'Arimo', sans-serif;
            background: linear-gradient(rgba(0, 108, 187, 0.1), rgba(0, 108, 187, 0.3)), url('../assets/images/blog/07.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .card {
            background: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>

<body>
    <div class="back-to-home rounded d-none d-sm-block">
        <a href="index-two.php" class="btn btn-icon btn-primary"><i data-feather="home" class="icons"></i></a>
    </div>

    <!-- Hero Start -->
    <section class="bg-home d-flex align-items-center" style="min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <img src="../assets/images/logo-dark.png" height="50" class="mx-auto d-block" alt="">
                    <div class="card login-page shadow mt-4 rounded border-0">
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['reg_success'])) { ?>
                            <h6 class="text-center">
                            <?php
                                echo $_SESSION['reg_success'];
                                unset($_SESSION['reg_success']);
                            }
                            ?>
                            </h6>
                            <h4 class="text-center">Login</h4>
                            <?php
                            // Check if form is submitted
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Include db.php for database connection
                                require_once('../includes/db.php');

                                // Retrieve form data
                                $email = $_POST['email'];
                                $password = $_POST['password'];

                                // Prepare SQL query to select user from database
                                $sql = "SELECT id, name, email, password FROM users WHERE email = ?";
                                
                                // Use prepared statements for security
                                $stmt = $conn->prepare($sql);
                                if ($stmt) {
                                    $stmt->bind_param("s", $email);
                                    
                                    // Execute SQL query
                                    $stmt->execute();
                                    $stmt->store_result();

                                    // Check if user exists
                                    if ($stmt->num_rows > 0) {
                                        $stmt->bind_result($id, $name, $email, $hashed_password);
                                        $stmt->fetch();
                                        
                                        // Verify password
                                        if (password_verify($password, $hashed_password)) {
                                            // Start a new session and save user information
                                            session_start();
                                            $_SESSION['user_id'] = $id;
                                            $_SESSION['user_name'] = $name;

                                            // Redirect to the dashboard or home page
                                            header("Location: Patient/index.php");
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
                            <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                                class="login-form mt-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Your Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" placeholder="Email" name="email"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" placeholder="Password"
                                                name="password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-grid">
                                            <button type="submit"
                                                class="btn btn"
                                                style="background-color: rgba(0, 108, 187, 1); color: white;">Login</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3 text-center">
                                        <p class="mb-0">Don't have an account? <a href="signup.php"
                                                class="text-primary">Sign Up</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- end card -->
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
