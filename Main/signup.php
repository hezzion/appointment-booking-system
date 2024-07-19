<?php 
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZION</title>
    <link rel="icon" style="height: 10px;width: 10px;" href="../assets/images/logo.png" type="image/png">
    <link href="../assets/css/bootstrap.min.css" class="theme-opt" rel="stylesheet" type="text/css" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/remixicon/fonts/remixicon.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/%40iconscout/unicons/css/line.css" type="text/css" rel="stylesheet" />
    <link href="../assets/css/style.min.css" class="theme-opt" rel="stylesheet" type="text/css" />
</head>
<body style="font-family: 'Arimo', sans-serif;">
    <div class="back-to-home rounded d-none d-sm-block">
        <a href="index-two.html" class="btn btn-icon btn-primary"><i data-feather="home" class="icons"></i></a>
    </div>

    <!-- Hero Start -->
    <section class="bg-home d-flex bg-light align-items-center" style="background: url('../assets/images/bg/bg-lines-one.png') center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <img src="../assets/images/logo-dark.png" height="22" class="mx-auto d-block" alt="">
                    <div class="card signup-page shadow mt-4 rounded border-0">
                        <div class="card-body">
                            <h4 class="text-center">Sign Up</h4>
                            <?php
                            $err = ["name" => "", "email" => "", "password" => "", "c_password" => "", "phone" => ""];
                            $name = $email = $phone = "";
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                require_once('../includes/db.php');
                            
                                $name = htmlspecialchars($_POST['name']);
                                $email = htmlspecialchars($_POST['email']);
                                $phone = htmlspecialchars($_POST['phone']);
                                $password = $_POST['password'];
                                $confirm_password = $_POST['confirm_password'];

                                $stmt = $conn->prepare("SELECT phone FROM users WHERE phone = ?");
                                $stmt->bind_param("s", $phone);
                                $stmt->execute();
                                $stmt->store_result();
                                if ($stmt->num_rows > 0) {
                                    $err['phone'] = "Phone number already exists!";
                                }

                                if ($password != $confirm_password) {
                                    $err['c_password'] = "Passwords do not match.";
                                } elseif (strlen($password) != 6) {
                                    $err['password'] = "Password must be exactly 6 characters.";
                                }

                                if (empty($name)) {
                                    $err['name'] = "Full name is required";
                                } elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
                                    $err['name'] = "Enter a valid name";
                                }

                                if (empty($email)) {
                                    $err['email'] = "Email is required!";
                                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $err['email'] = "Enter a valid email address!";
                                }

                                if (empty($phone)) {
                                    $err['phone'] = "Phone number is required!";
                                } elseif (!preg_match('/^[0-9]{11,13}$/', $phone)) {
                                    $err['phone'] = "Phone number must be between 11 and 13 digits.";
                                }

                                if (empty($password)) {
                                    $err['password'] = "Password is required!";
                                } 

                                if (empty($confirm_password)) {
                                    $err['c_password'] = "Confirm password is required!";
                                }

                                if (!array_filter($err)) {
                                    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
                                    $stmt->bind_param("s", $email);
                                    $stmt->execute();
                                    $stmt->store_result();
                                    if ($stmt->num_rows > 0) {
                                        $err['email'] = "This email is already registered!";
                                    } else {
                                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                        $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
                                        $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);
                                        if ($stmt->execute()) {
                                            $_SESSION['reg_success'] = "<div class='text-success'>Registration successful. You can now login</div>";
                                            header("Location: login.php");
                                            exit();
                                        } else {
                                            $error = "Error: " . $sql . "<br>" . $conn->error;
                                        }
                                        $stmt->close();
                                    }
                                }
                                $stmt->close();
                                $conn->close();
                            }
                            ?>
                            <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="signup-form mt-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $name; ?>" required>
                                            <div class="text-danger"><?php echo $err['name']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                                            <div class="text-danger"><?php echo $err['email']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Phone Number" value="<?php echo $phone; ?>" name="phone" required>
                                            <div class="text-danger"><?php echo $err['phone']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                                            <div class="text-danger"><?php echo $err['password']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                                            <div class="text-danger"><?php echo $err['c_password']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn" style="background-color: rgba(0, 108, 187, 1); color: white;">Sign Up</button>
                                        </div>
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

    <script src="../assets/libs/feather-icons/feather.min.js"></script>
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/plugins.init.js"></script>
    <script src="../assets/js/app.js"></script>
</body>
</html>
