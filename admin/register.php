<?php 
 session_start();
 include 'config.php';

 if(isset($_POST['registerbtn'])){
    
    $username = $_POST['name1'];
    $email = $_POST['email1'];
    $password = $_POST['pass1'];
    $profile=addslashes(file_get_contents($_FILES['profile']['tmp_name']));
    

    $a_query="INSERT INTO `admin`(`name`, `email`, `password`, `profile`) VALUES ('$username','$email','$password','$profile')";
    $a_result=mysqli_query($conn,$a_query);
    if($a_result)
    {
    //    echo "Account Registered!";
       echo "<script>alert('Admin Registered!');</script>".mysqli_error($conn);
        header('location:login.php');
    }else
    {
        // echo "Failed";
        echo "<script>alert('Registered Failed Please try again');</script>".mysqli_error($conn);
    }
 
}
?>


<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from coderthemes.com/adminox/layouts/horizontal/page-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Aug 2022 14:24:14 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Register | Adminox </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- App css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />

</head>

<body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">

    <div class="home-btn d-none d-sm-block">
        <a href="index.php"><i class="fas fa-home h2 text-white"></i></a>
    </div>

    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">

                        <div class="card-body p-4">

                            <div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        <a href="index.html">
                                            <img src="images/logo-dark.png" alt="" height="30">
                                        </a>
                                    </div>
                                    <h5 class="text-uppercase mb-1 mt-4">Register</h5>
                                    <p class="mb-0">Get access to our admin panel</p>
                                </div>

                                <div class="account-content mt-4">
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">

                                        <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="username">Full Name</label>
                                                    <input class="form-control" name="name1" type="name" id="username" required="" placeholder="Michael Zenaty">
                                                </div>
                                            </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="emailaddress">Email address</label>
                                                <input class="form-control" name="email1" type="email" id="emailaddress" required="" placeholder="john@deo.com">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="username">Profile Image</label>
                                                    <input class="form-control" name="profile" type="file" id="username" required="" placeholder="Michael Zenaty">
                                                </div>
                                            </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <a href="page-recoverpw.html" class="text-muted float-right"><small>Forgot your password?</small></a>
                                                <label for="password">Password</label>
                                                <input class="form-control" name="pass1" type="password" required="" id="password" placeholder="Enter your password">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                                <div class="col-12">

                                                        <div class="checkbox checkbox-success">
                                                            <input id="remember" type="checkbox" checked="">
                                                            <label for="remember">
                                                                I accept <a href="#">Terms and Conditions</a>
                                                            </label>
                                                        </div>
    
                                                    </div>
                                        </div>

                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light"  type="submit"  name="registerbtn">Sign Up Free</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center">
                                                <button type="button" class="btn mr-1 btn-facebook waves-effect waves-light">
                                                    <i class="fab fa-facebook-f"></i>
                                                </button>
                                                <button type="button" class="btn mr-1 btn-googleplus waves-effect waves-light">
                                                    <i class="fab fa-google"></i>
                                                </button>
                                                <button type="button" class="btn mr-1 btn-twitter waves-effect waves-light">
                                                    <i class="fab fa-twitter"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4 pt-2">
                                        <div class="col-sm-12 text-center">
                                                <p class="text-muted">Already have an account?  <a href="login.php" class="text-dark ml-1"><b>Sign In</b></a></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="js/vendor.min.js"></script>

    <!-- App js -->
    <script src="js/app.min.js"></script>

</body>


<!-- Mirrored from coderthemes.com/adminox/layouts/horizontal/page-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Aug 2022 14:24:14 GMT -->
</html>