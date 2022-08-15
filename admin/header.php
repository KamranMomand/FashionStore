<?php


?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/adminox/layouts/horizontal/layouts-vertical.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Aug 2022 14:24:13 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Adminox </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="images/favicon.ico">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <!-- third party css -->
        <link href="libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    <?php
                        if(isset($_SESSION['adminid']))
                        {
                            include_once 'config.php';
                            $id=$_SESSION['adminid'];
                            $d_query="select * from admin where id='$id'"; 
                            $d_result=mysqli_query($conn,$d_query);
                            $d_row= mysqli_fetch_assoc($d_result);
                        }
                    ?>
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($d_row['profile']);?>" width="32" height="32" alt="User" class="rounded-circle">
                                
                                <span class="pro-user-name ml-1">
                                    <?php echo $d_row['name']?>  <i class="mdi mdi-chevron-down"></i> 
                                </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome !</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="profile.php" class="dropdown-item notify-item">
                                        <i class="fe-user"></i>
                                        <span>Profile</span>
                                    </a>
                                    <?php
                        
                                    if(!isset($_SESSION['adminid']))
                                    {
                                    ?>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings"></i>
                                <span>Settings</span>
                            </a>

                              <!-- item-->
                                <a href="login.php" class="dropdown-item notify-item">
                                        <i class="fe-log-in"></i>
                                        <span>Login</span>
                                </a>
                                     <?php }else{ ?>
                                <!-- item-->
                                    <div class="dropdown-divider"></div>

                                <!-- item-->
                                    <a href="logout.php" class="dropdown-item notify-item">
                                        <i class="fe-log-out"></i>
                                        <span>Logout</span>
                                    </a>
                                    
                                <?php } ?>
                        </div>
                    </li>
                </ul>
                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.php" class="logo text-center">
                    <h3 class="pt-2"><span class="logo-lg" style="color:#48ccb2;">
                       Thrift Fashion</span></h3>
                        
                       <h6 class="pt-0"><span class="logo-sm" style="color:#48ccb2;">
                       Thrift Fashion</span></h6>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>
                </ul>
            </div>
            <!-- end Topbar -->
