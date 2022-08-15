<?php
session_start();
if(isset($_SESSION['adminid']))
{
include_once 'config.php';
include 'header.php';
include 'navbar.php';
if(isset($_POST['btnAdd']))
{
    $name=$_POST['txtname'];
    $status="Active";
    $ca_query = "INSERT INTO `product_category`( `category`,`status`) VALUES ('$name','$status')";
    $ca_result=mysqli_query($conn,$ca_query);
    if($ca_result)
    {
        header('location: product_category.php');
    }else{
        echo "Record Not Inserted ".mysqli_error($conn);
    }
   
}
$query="select * from product_category";
$result=mysqli_query($conn,$query);

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
                                <li class="breadcrumb-item active">Category</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Category</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="header-title">Category Details</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                                <?php
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['category'];?></td>
                                        <td><?php echo $row['status'];?></td>
                                        <td><a href="product_category_edit.php?id=<?php echo $row['id'];?>" class="btn btn-success">Edit</a> | <a href="product_category_delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <form method="post">
                        <label>Enter Category : </label>
                            <input type="text" class="form-control" name="txtname"/>
                            
                            <br>
                            <input type="submit" class="btn btn-primary" value="Add Product" name="btnAdd"/>
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