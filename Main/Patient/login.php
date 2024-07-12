<?php
session_start();

// Example users data. In real applications, fetch this from a database.
$users = [
    'zakijonathan3@gmail.com' => '2005
    
    ',
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($users[$email]) && $users[$email] === $password) {
        $_SESSION['user'] = $email;
        header('Location:index.php');
        exit;
    } else {
        $error = 'Invalid email or password';
    }
}
?>
<!doctype html>
<html lang="en" dir="ltr">

    
<!-- Mirrored from shreethemes.in/doctris/layouts/landing/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Dec 2023 11:04:35 GMT -->
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zion Admin</title>
            <!-- favicon -->
        <link rel="icon" style="height: 10px;width: 10px;" href="./assets/images/logo.png" type="image/png">
        
       
        <!-- Css -->
        <!-- Bootstrap Css -->
        <link href="./assets/css/bootstrap.min.css" class="theme-opt" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="./assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/libs/remixicon/fonts/remixicon.css" rel="stylesheet" type="text/css" />
        <link href="./assets/libs/%40iconscout/unicons/css/line.css" type="text/css" rel="stylesheet" />
        <!-- Style Css-->
        <link href="./assets/css/style.min.css" class="theme-opt" rel="stylesheet" type="text/css" />

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
                            <h4 class="text-center">Sign In</h4>  
                            <?php if ($error): ?>
                                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>
                            <form action="login.php" method="post" class="login-form mt-4">
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
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input align-middle" type="checkbox" value="" id="remember-check">
                                                    <label class="form-check-label" for="remember-check">Remember me</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn" style="background-color: rgba(0, 108, 187, 1);color: white;">Login</button>
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
        
        <!-- javascript -->
        <script src="../assets/libs/feather-icons/feather.min.js"></script>
        <!-- Main Js -->
        <!-- JAVASCRIPT -->
        <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/plugins.init.js"></script>
        <script src="../assets/js/app.js"></script>
        
    </body>


<!-- Mirrored from shreethemes.in/doctris/layouts/landing/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Dec 2023 11:04:35 GMT -->
</html>