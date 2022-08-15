<?php
session_start();
include_once 'config.php';
 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    // $discount=$_POST['dp'];
    // $start=$_POST['sd'];
    // $end=$_POST['ed'];
    $query="INSERT INTO `daily_offers`(`product_id`, `discount`, `start_date`, `end_date`) VALUES ('$id','$discount','$start','$end')";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($result);
}

// if(isset($_POST['btnEdit']))
// {
//     $id=$_POST['txtId'];
//     $discount=$_POST['dp'];
//     $start=$_POST['sd'];
//     $end=$_POST['ed'];
   

//     $query = "UPDATE `daily_offers` SET `discount`='$discount',`start_date`='$start',`end_date`='$end' WHERE `id`='$id'";
//     $result=mysqli_query($conn,$query);

//     if($result)
//     {
//         header('location:user_list.php').mysqli_error($conn);
//     }else{
//         echo "Record Not Updated";
//     }
// }
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
                            <li class="breadcrumb-item active">daily_offers</li>
                        </ol>
                    </div>
                    <h4 class="page-title">daily_offers</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h4 class="header-title">daily_offers Edit</h4>
                    <br>
                    
                    <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="txtId" value="<?php echo $row['id']?>"/>
                    <label>Start Date : </label>
                    <input type="text" class="form-control" name="sd"/>
                    <br>
                    <label>End Date: </label>
                    <input type="text" class="form-control" name="ed"/>
                    <br>
                    <label>Discount Percentage: </label>
                    <input type="text" class="form-control" name="dp"/>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Add DailyOffer" name="btnAdd"/>
                </form>
    </div>
                    </div>
                </div>
            </div>

    <?Php
    include 'footer.php' 
    ?>














