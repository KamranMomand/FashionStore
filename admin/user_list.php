<?php
session_start();
if(isset($_SESSION['adminid']))
{
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
                                <li class="breadcrumb-item active">Users</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Users</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="header-title">Users Details</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Contact Phone</th>
                                <th>UserName</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                                <?php
                                    $user_query="select * from user";
                                    $user_result=mysqli_query($conn,$user_query);

                                    while($user_row=mysqli_fetch_assoc($user_result))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $user_row['id'];?></td>
                                        <td><?php echo $user_row['name'];?></td>
                                        <td><?php echo $user_row['contact_phone'];?></td>
                                        <td><?php echo $user_row['username'];?></td>
                                        <td><?php echo $user_row['password'];?></td>
                                        <td><a href="user_list_edit.php?id=<?php echo $user_row['id'];?>" class="btn btn-success">Edit</a> | <a href="user_list_delete.php?id=<?php echo $user_row['id'];?>" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                      
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