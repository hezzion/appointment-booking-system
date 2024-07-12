



<!doctype html>
<html lang="en" dir="ltr">

    
<!-- Mirrored from shreethemes.in/doctris/layouts/landing/booking-appointment.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Nov 2023 13:15:19 GMT -->
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zion</title>
            <!-- favicon -->
        <link rel="icon" style="height: 10px;width: 10px;" href="../assets/images/logo.png" type="image/png">
        
        <!-- Css -->
        <link href="../assets/libs/js-datepicker/datepicker.min.css" rel="stylesheet">
        <!-- Bootstrap Css -->
        <link href="../assets/css/bootstrap.min.css" class="theme-opt" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/remixicon/fonts/remixicon.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/%40iconscout/unicons/css/line.css" type="text/css" rel="stylesheet" />
        <!-- Style Css-->
        <link href="../assets/css/style.min.css" class="theme-opt" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </head>

    <body style="font-family: 'Arimo', sans-serif;">

        <!-- Navbar STart -->
        <header id="topnav" class="defaultscroll sticky">
            <div class="container">
                <!-- Logo container-->
                <a class="logo" href="index-two.php">
                    <img src="../assets/images/logo-dark.png" height="50" class="logo-light-mode" alt="">
                    <img src="../assets/images/logo-light.png" height="50" class="logo-dark-mode" alt="">
                </a>                
                <!-- Logo End -->
        
                <!-- Start Mobile Toggle -->
                <div class="menu-extras">
                    <div class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </div>
                </div>
                <!-- End Mobile Toggle -->

                

                <div id="navigation">
                    <!-- Navigation Menu-->   
                    <ul class="navigation-menu nav-left">
                        <li class="#">
                            <a href="index-two.php">Home</a><span class="menu-arrow"></span>

                        </li>
                        <li class="#">
                            <a href="doctor-team-one.php">Doctors</a><span class="menu-arrow"></span>

                        </li>
                        <li class="#">
                            <a href="contact.php">Contact</a><span class="menu-arrow"></span>

                        </li>
                    </ul><!--end navigation menu-->
                </div><!--end navigation-->
            </div><!--end container-->
        </header><!--end header-->
        <!-- Navbar End -->

        <!-- Start Hero -->
        <form action="" method="POST">
    <!-- Your form content goes here -->
    <section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow rounded overflow-hidden">
                    <ul class="nav nav-pills nav-justified flex-column flex-sm-row rounded-0 shadow overflow-hidden bg-light mb-0" id="pills-tab">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link rounded-0 active" id="clinic-booking" data-bs-toggle="pill" href="#pills-clinic" style="background-color: rgba(0, 108, 187, 1);color: white;">
                                <div class="text-center pt-1 pb-1">
                                    <h5 class="fw-medium mb-0">Register with us</h5>
                                </div>
                            </a><!--end nav link-->
                        </li><!--end nav item-->
                    </ul>

                    <div class="tab-content p-4" id="pills-tabContent">

                        <div class="tab-pane fade active show" id="pills-clinic" role="tabpanel" aria-labelledby="clinic-booking">
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                            <input name="patientname" id="name2" type="text" class="form-control" >
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                            <input name="email" id="email2" type="email" class="form-control" >
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Your Phone <span class="text-danger">*</span></label>
                                            <input name="phone" id="phone2" type="tel" class="form-control" >
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Password <span class="text-danger">*</span></label>
                                            <input name="phone" id="phone2" type="tel" class="form-control" >
                                        </div>
                                    </div><!--end col-->


                                    <div class="col-lg-12" style="background-color: rgba(0, 108, 187, 1);color: white;">
                                        <div class="d-grid" >
                                            <button type="submit" class="btn btn" style="color: white;">Register</button>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-12 text-center">
                                            <p class="mb-0 mt-3"><small class="text-dark me-2">Do have an account ?</small> <a href="login.php" class="text-dark fw-bold">Sign in</a></p>
                                        </div>
                                </div><!--end row-->
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div>
</section><!--end section-->

</form>
   

        <!-- End -->
<!-- Start -->
<footer class="" style="background-color: rgb(255, 255, 255); color: black;">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-4 mb-0 mb-md-4 pb-0 pb-md-2">
                <a href="#" class="logo-footer">
                    <img src="../assets/images/logo-light.png" height="50" alt="">
                </a>
                <p class="mt-4 me-xl-5">Great doctor if you need your family member to get effective immediate assistance, emergency treatment or a simple consultation.</p>
            </div><!--end col-->

            <div class="col-xl-7 col-lg-8 col-md-12" >
                <div class="row">
                    <div class="col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0" >
                        <h5 class="footer-head">Company</h5>
                        <ul class="list-unstyled footer-list mt-4">
                            <li><a href="aboutus.php" class="text-foot"></i> About us</a></li>
                            <li><a href="doctor-team-one.php" class="text-foot"></i>Doctors</a></li>
                            <li><a href="contact.php" class="text-foot"></i>contact</a></li>
                            <li><a href="index-two.php" class="text-foot"></i>Home</a></li>
                            
                        </ul>
                    </div><!--end col-->
            
            
                    <div class="col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        <h5 class="footer-head">Contact us</h5>
                        <ul class="list-unstyled footer-list mt-4">
                            <li class="d-flex align-items-center">
                                <i data-feather="mail" class="fea icon-sm text-foot align-middle"></i>
                                <a href="mailto:zakijonathan3@gmail.com" class="text-foot ms-2">zakijonathan3@gmail.com</a>
                            </li>

                            <li class="d-flex align-items-center">
                                <i data-feather="phone" class="fea icon-sm text-foot align-middle"></i>
                                <a href="tel:+234-903-5279-803" class="text-foot ms-2">+234-903-5279-803</a>
                            </li>

                            <li class="d-flex align-items-center">
                                <i data-feather="map-pin" class="fea icon-sm text-foot align-middle"></i>
                                <a href="javascript:void(0)" class="video-play-icon text-foot ms-2">View on Google map</a>
                            </li>
                        </ul>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <div class="container mt-5">
        <div class="pt-4 footer-bar">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="text-sm-start text-center">
                        <p class="mb-0"><script>document.write(new Date().getFullYear())</script> © ZION... <i class="mdi mdi-heart text-danger"></i></p>
                    </div>
                </div><!--end col-->

                <div class="col-sm-6 mt-4 mt-sm-0">
                    <ul class="list-unstyled footer-list text-sm-end text-center mb-0">
                        <li class="list-inline-item"><a href="contact.php" class="text-foot me-2">Contact</a></li>
                    </ul>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div><!--end container-->
</footer><!--end footer-->
<!-- End -->

        <!-- Back to top -->
        <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fs-5 rounded-pill text-center bg-primary justify-content-center align-items-center"><i data-feather="arrow-up" class="fea icon-sm"></i></a>
        <!-- Back to top -->

        <!-- Offcanvas Start -->
        <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop">
            <div class="offcanvas-body d-flex align-items-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                <h4>Search now.....</h4>
                                <div class="subcribe-form mt-4">
                                    <form>
                                        <div class="mb-0">
                                            <input type="text" id="help" name="name" class="border rounded-pill" required="" placeholder="Search">
                                            <button type="submit" class="btn btn-pills btn-primary" style="background-color: rgba(0, 108, 187, 1);color: white;">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end container-->
            </div>
        </div>
        <!-- Offcanvas End -->

        <!-- Offcanvas Start -->
        <div class="offcanvas offcanvas-end shadow border-0" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header p-4 border-bottom">
                <h5 id="offcanvasRightLabel" class="mb-0">
                    <img src="../assets/images/logo-dark.png" height="22" class="light-version" alt="">
                    <img src="../assets/images/logo-light.png" height="22" class="dark-version" alt="">
                </h5>
                <button type="button" class="btn-close d-flex align-items-center text-dark" data-bs-dismiss="offcanvas" aria-label="Close"><i class="uil uil-times fs-4"></i></button>
            </div>
            <div class="offcanvas-body p-4 px-md-5">
                <div class="row">
                    <div class="col-12">
                        <!-- Style switcher -->
                        <div id="style-switcher">
                            <div>
                                <ul class="text-center style-switcher list-unstyled mb-0">
                                    <li class="d-grid"><a href="javascript:void(0)" class="rtl-version t-rtl-light" onclick="setTheme('style-rtl')"><img src="../assets/images/layouts/landing-light-rtl.png" class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px;" alt=""><span class="text-dark fw-medium mt-3 d-block">RTL Version</span></a></li>
                                    <li class="d-grid"><a href="javascript:void(0)" class="ltr-version t-ltr-light" onclick="setTheme('style')"><img src="../assets/images/layouts/landing-light.png" class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px;" alt=""><span class="text-dark fw-medium mt-3 d-block">LTR Version</span></a></li>
                                    <li class="d-grid"><a href="javascript:void(0)" class="dark-rtl-version t-rtl-dark" onclick="setTheme('style-dark-rtl')"><img src="../assets/images/layouts/landing-dark-rtl.png" class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px;" alt=""><span class="text-dark fw-medium mt-3 d-block">RTL Version</span></a></li>
                                    <li class="d-grid"><a href="javascript:void(0)" class="dark-ltr-version t-ltr-dark" onclick="setTheme('style-dark')"><img src="../assets/images/layouts/landing-dark.png" class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px;" alt=""><span class="text-dark fw-medium mt-3 d-block">LTR Version</span></a></li>
                                    <li class="d-grid"><a href="javascript:void(0)" class="dark-version t-dark mt-4" onclick="setTheme('style-dark')"><img src="../assets/images/layouts/landing-dark.png" class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px;" alt=""><span class="text-dark fw-medium mt-3 d-block">Dark Version</span></a></li>
                                    <li class="d-grid"><a href="javascript:void(0)" class="light-version t-light mt-4" onclick="setTheme('style')"><img src="../assets/images/layouts/landing-light.png" class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px;" alt=""><span class="text-dark fw-medium mt-3 d-block">Light Version</span></a></li>
                                    <li class="d-grid"><a href="https://shreethemes.in/doctris/layouts/admin/index.html" target="_blank" class="mt-4"><img src="../assets/images/layouts/light-dash.png" class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px;" alt=""><span class="text-dark fw-medium mt-3 d-block">Admin Dashboard</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- end Style switcher -->
                    </div><!--end col-->
                </div><!--end row-->
            </div>

            <div class="offcanvas-footer p-4 border-top text-center">
                <ul class="list-unstyled social-icon social mb-0">
                    <li class="list-inline-item mb-0"><a href="https://1.envato.market/doctris-template" target="_blank" class="rounded"><i class="uil uil-shopping-cart align-middle" title="Buy Now"></i></a></li>
                    <li class="list-inline-item mb-0"><a href="https://dribbble.com/shreethemes" target="_blank" class="rounded"><i class="uil uil-dribbble align-middle" title="dribbble"></i></a></li>
                    <li class="list-inline-item mb-0"><a href="https://www.behance.net/shreethemes" target="_blank" class="rounded"><i class="uil uil-behance align-middle" title="behance"></i></a></li>
                    <li class="list-inline-item mb-0"><a href="https://www.facebook.com/shreethemes" target="_blank" class="rounded"><i class="uil uil-facebook-f align-middle" title="facebook"></i></a></li>
                    <li class="list-inline-item mb-0"><a href="https://www.instagram.com/shreethemes/" target="_blank" class="rounded"><i class="uil uil-instagram align-middle" title="instagram"></i></a></li>
                    <li class="list-inline-item mb-0"><a href="https://twitter.com/shreethemes" target="_blank" class="rounded"><i class="uil uil-twitter align-middle" title="twitter"></i></a></li>
                    <li class="list-inline-item mb-0"><a href="mailto:support@shreethemes.in" class="rounded"><i class="uil uil-envelope align-middle" title="email"></i></a></li>
                    <li class="list-inline-item mb-0"><a href="https://shreethemes.in/" target="_blank" class="rounded"><i class="uil uil-globe align-middle" title="website"></i></a></li>
                </ul><!--end icon-->
            </div>
        </div>
        <!-- Offcanvas End -->
        
        <!-- javascript -->
        <script>
$(document).ready(function(){
    $('#your-form-id').submit(function(event){
        event.preventDefault(); // Prevent the form from submitting normally

        // Get form data
        var formData = $(this).serialize();

        // Submit form data using AJAX
        $.ajax({
            type: 'POST',
            url: 'your_php_script.php', // Replace with the path to your PHP script
            data: formData,
            success: function(response){
                // Optionally, display a success message or perform other actions
                alert('Appointment booked successfully!');
                // You can clear the form fields or perform other actions here
            },
            error: function(xhr, status, error){
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
        <script src="../assets/libs/js-datepicker/datepicker.min.js"></script>
        <script src="../assets/libs/feather-icons/feather.min.js"></script>
        <!-- Main Js -->
        <!-- JAVASCRIPT -->
        <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/plugins.init.js"></script>
        <script src="../assets/js/app.js"></script>
        
    </body>


<!-- Mirrored from shreethemes.in/doctris/layouts/landing/booking-appointment.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Nov 2023 13:15:19 GMT -->
</html>