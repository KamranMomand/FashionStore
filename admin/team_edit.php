<?php
session_start();
include_once 'config.php';


if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $s_query="Select * from team where id='$id'";
    $s_result=mysqli_query($conn,$s_query);
    $s_row=mysqli_fetch_assoc($s_result);
}

if(isset($_POST['btnEdit']))
{
    $name=$_POST['name'];
    $designation=$_POST['desig'];
    $bio=$_POST['bio'];
    $profile=addslashes(file_get_contents($_FILES['profile1']['tmp_name']));

    $query = "UPDATE `team` SET `name`='$name',`designation`='$designation',`bio`='$bio',`profile`='$profile' WHERE `id`='$id'";
    $result=mysqli_query($conn,$query);

    if($result)
    {
        header('location:team.php');
    }else{
        echo "Record Not Updated";
    }
}
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
                            <li class="breadcrumb-item active">Team</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Team</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h4 class="header-title">Team Edit</h4>
                    <br>
    <form  method="post" enctype="multipart/form-data">
        <input type="hidden" name="txtId" value="<?php echo $s_row['id']?>"/>
        <label>Enter Name : </label>
        <input type="text" class="form-control" name="name" value="<?php echo $s_row['name']?>"/>
        <br>
        <label>Enter Designation: </label>
        <input type="text" class="form-control" name="desig" value="<?php echo $s_row['designation']?>"/>
        <br>
        <label>Enter Bio: </label>
        <input type="text" class="form-control" name="bio" value="<?php echo $s_row['bio']?>"/>
        <br>
        <label>Select Profile : </label>
        <input type="file" class="form-control" name="profile1" value="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($t_row['profile']);?>"/>
        <br>
        <input type="submit" class="btn btn-primary" value="Update Member" name="btnEdit"/>
    </form>
    </div>
                    </div>
                </div>
            </div>

<?Php
include 'footer.php' 
?>














