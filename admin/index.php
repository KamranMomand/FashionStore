<?php
session_start();
if(isset($_SESSION['adminid']))
{
include_once 'config.php';
include 'header.php';
include 'navbar.php';
?>

<div class="content-page">
                <div class="content">
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index.php">Thriftfashion</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">

                            <div class="col-xl-3 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <div class="media">
                                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                        <i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
                                        </div>
                                        <?php

                                        $user_query="SELECT * FROM `user`";
                                        $user_result=mysqli_query($conn,$user_query);
                                        $count=mysqli_num_rows($user_result);

                                        ?>
                                        <div class="wigdet-two-content media-body">
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Total Users</p>
                                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup"><?php echo $count; ?></span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-xl-3 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom ">
                                    <div class="media">
                                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                            <i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
                                        </div>
                                        <?php
                                        $p_query="SELECT * FROM `product`";
                                        $p_result=mysqli_query($conn,$p_query);
                                        $count=mysqli_num_rows($p_result);
                                        ?>
                                        <div class="wigdet-two-content media-body">
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Total Products</p>
                                            <h3 class="font-weight-medium my-2"> <span data-plugin="counterup"><?php echo $count; ?></span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-xl-3 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom ">
                                    <div class="media">
                                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                        <i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
                                        </div>
                                        <?php
                                        $o_query="SELECT * FROM `order`";
                                        $o_result=mysqli_query($conn,$o_query);
                                        $count=mysqli_num_rows($o_result);
                                        ?>
                                        <div class="wigdet-two-content media-body">
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Total Orders</p>
                                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup"><?php echo $count; ?></span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-xl-3 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom ">
                                    <div class="media">
                                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                        <i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
                                        </div>
                                        <?php
                                        $t_query="SELECT * FROM `team`";
                                        $t_result=mysqli_query($conn,$t_query);
                                        $count=mysqli_num_rows($t_result);
                                        ?>
                                        <div class="wigdet-two-content media-body">
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics"> Team Members</p>
                                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup"><?php echo $count; ?></span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                        </div>
<?php
include 'footer.php';
}else{
    header('location:login.php');
 }
?>
