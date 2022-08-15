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
                                <li class="breadcrumb-item active">Feedback</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Feedback</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="header-title">Clients Reviews</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Product Image </th>
                                <th>Product Name</th>
                                <th>User Name</th>
                                <th>Feedback</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                                <?php
                                    $f_query="select * from `feedback` f join `product` p on f.product_id=p.id join `user` u on f.user_id =u.id";
                                    $f_result=mysqli_query($conn,$f_query);

                                    while($f_row=mysqli_fetch_array($f_result))
                                    {
                                ?>
                                    <tr>
                                        <td><?php echo $f_row['id'];?></td>
                                        <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($f_row['image1']);?>" width="100px" height="100px"/></td>
                                        <td><?php echo $f_row[6];?></td>
                                        <td><?php echo $f_row[19];?></td>
                                        <td><?php echo $f_row['feedback'];?></td>
                                        <td><a href="feedback_delete.php?id=<?php echo $f_row[0];?>" class="btn btn-danger">Delete</a></td>
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