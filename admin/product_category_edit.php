<?php
session_start();
include_once 'config.php';
 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $s_query="Select * from product_category where id='$id'";
    $s_result=mysqli_query($conn,$s_query);
    $s_row=mysqli_fetch_assoc($s_result);
}

if(isset($_POST['btnEdit']))
{
    $id=$_POST['txtId'];
    $name=$_POST['txtName'];
    $status=$_POST['status'];

    $query = "UPDATE `product_category` SET `category`='$name',`status`='$status' WHERE `id`='$id'";
    $result=mysqli_query($conn,$query);

    if($result)
    {
        header('location:product_category.php');
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
                    <h4 class="header-title">Category Edit</h4>
                    <br>
    <form  method="post">
    <input type="hidden" name="txtId" value="<?php echo $s_row['id']?>"/>
    <label>Enter Category: </label>
    <input type="text" class="form-control" value="<?php echo $s_row['category']?>" name="txtName"/>
    <br>
    <select class="form-control" name="status" value="<?php echo $s_row['status']?>">
        
        <option>Select Status</option>
        <option value="Active">Active</option>
        <option value="Deactive">Deactive</option>

    </select>
    <br>
        <input type="submit" class="btn btn-primary" value="Update product category" name="btnEdit"/>
    </form>
    
    </div>
                    </div>
                </div>
            </div>

    <?Php
    include 'footer.php' 
    ?>














