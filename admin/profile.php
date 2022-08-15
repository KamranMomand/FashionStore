<?php
session_start();
if(isset($_SESSION['adminid']))
{include_once 'config.php';
 include 'header.php';
 include 'navbar.php';
 if(isset($_SESSION['adminid']))
 {
    $id=$_SESSION['adminid'];
    $d_query="select * from admin where id='$id'"; 
    $d_result=mysqli_query($conn,$d_query);
    $d_row= mysqli_fetch_assoc($d_result);
 }

?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Thriftfashion</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profile</h4>
                    </div>
                </div>
            </div>     
                <div class="row">
                    <div class="col-sm-12">
                        <div class="profile-user-box">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span class="float-left mr-3"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($d_row['profile']);?>" width="32" height="32" alt="User" class="avatar-xl rounded-circle"></span>
                                    <div class="media-body">
                                        <h4 class="mt-1 mb-1 font-18 ellipsis"><?php echo $d_row['name']?></h4>
                                        <p class="font-13"> PHP Developer</p>
                                        <p class="text-muted mb-0"><small>Karachi, Pakistan</small></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-right">
                                        <a href="profile_edit.php"><button type="button" class="btn btn-success waves-effect waves-light">
                                            <i class="mdi mdi-account-settings-variant mr-1"></i> Edit Profile
                                        </button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </section>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                    <h4 class="header-title mt-0 mb-4">Personal Information</h4>
                                    <div class="">
                                        <p class="text-muted font-13">
                                            Hye, I’m Mohammad Kamran residing in this beautiful world. I create websites  with great UX and UI design. I have done work with big companies like Nokia, Google and Yahoo. Meet me or Contact me for any queries.
                                        </p>
        
                                        <hr/>
        
                                        <div class="text-left">
                                            <p class="text-muted font-13"><strong>Full Name :</strong> <span class="ml-3"><?php echo $d_row['name']?></span></p>
        
                                            <p class="text-muted font-13"><strong>Mobile :</strong><span class="ml-3">(+92) 3113171047</span></p>
        
                                            <p class="text-muted font-13"><strong>Email :</strong> <span class="ml-3"><?php echo $d_row['email']?></span></p>
        
                                            <p class="text-muted font-13"><strong>Location :</strong> <span class="ml-3">Pakistan</span></p>
        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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