<?php

session_start();
include 'config.php';

if(isset($_POST['login_btn']))
{
   $email=mysqli_real_escape_string($conn,$_POST['emaill']);
   $password=mysqli_real_escape_string($conn,$_POST['pass']);

    $a_query="select * from `admin` WHERE email='$email' && password='$password'";
   $a_result=mysqli_query($conn,$a_query);
   if(mysqli_num_rows($a_result)>0)
   {
       $row=mysqli_fetch_assoc($a_result);
       $_SESSION['adminid']=$row['id'];
       $_SESSION['adminname']=$row['name'];
       header('location:index.php');
   }else
   {
       echo "<script>alert('Invalid Credentials');</script>".mysqli_error($conn);
   }
}



?>


<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from coderthemes.com/adminox/layouts/horizontal/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Aug 2022 14:24:14 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Login | Adminox </title>
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
                                        <h3 class=" logo text-center"><span class="logo-lg" style="color:#48ccb2;">Thrift Fashion</span></h3>
                                    </div>
                                    <h5 class="text-uppercase mb-1 mt-4">Sign In</h5>
                                    <p class="mb-0">Login to your Admin account</p>
                                    
                                </div>

                                <div class=" mt-4">
                                    <form class="form-horizontal" method="POST">

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="emailaddress">Email address</label>
                                                <input class="form-control" name="emaill" type="email" id="email"  required="" placeholder="john@deo.com">
                                            <span style="color: red" class="error" id="email_err"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <a href="page-recoverpw.html" class="text-muted float-right"><small>Forgot your password?</small></a>
                                                <label for="password">Password</label>
                                                <input class="form-control" name="pass" type="password" id="pass" required=""  placeholder="Enter your password">
                                                <span style="color: red" class="error" id="pass_err"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">

                                                <!-- <div class="checkbox checkbox-success">
                                                    <input id="remember" type="checkbox" checked="">
                                                    <label for="remember">
                                                        Remember me
                                                    </label>
                                                </div> -->

                                            </div>
                                        </div>

                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit" name="login_btn">LogIn</button>
                                            </div>
                                        </div>

                                    </form>


                                    <!-- <div class="row mt-4 pt-2">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-muted mb-0">Don't have an account? <a href="register.php" class="text-dark ml-1"><b>Sign Up</b></a></p>
                                        </div>
                                    </div> -->

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


<!-- Mirrored from coderthemes.com/adminox/layouts/horizontal/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Aug 2022 14:24:14 GMT -->
</html>