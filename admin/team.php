<?php
session_start();
if(isset($_SESSION['adminid']))
{

include 'header.php';
include 'navbar.php'; 



if(isset($_POST['btnAdd']))
{
    $name=$_POST['name'];
    $designation=$_POST['desig'];
    $bio=$_POST['bio'];
    $profile=addslashes(file_get_contents($_FILES['profile']['tmp_name']));

    $query = "INSERT INTO `team`(`name`, `designation`, `bio`, `profile`) VALUES ('$name','$designation','$bio','$profile')";
    $result=mysqli_query($conn,$query);
    if($result)
    {
        header('location: team.php');
    }else{
        echo "Record Not Inserted ".mysqli_error($conn);
    }
   
}
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
                        <h4 class="page-title">Our Team</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="header-title">Our Team Details</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Bio</th>
                                <th>Profile</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                                <?php
                                    $t_query="select * from team";
                                    $t_result=mysqli_query($conn,$t_query);

                                    while($t_row=mysqli_fetch_assoc($t_result))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $t_row['id'];?></td>
                                        <td><?php echo $t_row['name'];?></td>
                                        <td><?php echo $t_row['designation'];?></td>
                                        <td><?php echo $t_row['bio'];?></td>
                                        <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($t_row['profile']);?>" width="100px" height="100px"/></td>
                                        <td><a href="team_edit.php?id=<?php echo $t_row['id'];?>" class="btn btn-success">Edit</a> | <a href="team_delete.php?id=<?php echo $t_row['id'];?>" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <form method="post" enctype="multipart/form-data">
                            <label>Enter Name : </label>
                            <input type="text" class="form-control" name="name"/>
                            <br>
                            <label>Enter Designation: </label>
                            <input type="text" class="form-control" name="desig"/>
                            <br>
                            <label>Enter Bio: </label>
                            <input type="text" class="form-control" name="bio"/>
                            <br>
                            <label>Select Profile : </label>
                            <input type="file" class="form-control" name="profile"/>
                            <br>
                            <input type="submit" class="btn btn-primary" value="Add Member" name="btnAdd"/>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->


<?php
include 'footer.php';
}else{
    header('location:login.php');
 }
?>