<?php
session_start();
include_once 'config.php';
 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $s_query="Select * from user where id='$id'";
    $s_result=mysqli_query($conn,$s_query);
    $s_row=mysqli_fetch_assoc($s_result);
}

if(isset($_POST['btnEdit']))
{
    $id=$_POST['txtId'];
    $name=$_POST['txtName'];
    $email=$_POST['email'];
    $contact=$_POST['phone'];
    $username=$_POST['username'];
    $password=$_POST['pass'];

    $query = "UPDATE `user` SET `name`='$name',`email`='$email',`contact_phone`='$contact',`username`='$username',`password`='$password' WHERE `id`='$id'";
    $result=mysqli_query($conn,$query);

    if($result)
    {
        header('location:user_list.php').mysqli_error($conn);
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
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                    <h4 class="page-title">User</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h4 class="header-title">User Edit</h4>
                    <br>
    <form  method="post">
    <input type="hidden" name="txtId" value="<?php echo $s_row['id']?>"/>
        <label>Enter Name: </label>
        <input type="text" name="txtName" class="form-control" value="<?php echo $s_row['name']?>"/>
        <br>
        <label>Enter Email: </label>
        <input type="text" name="email" class="form-control" value="<?php echo $s_row['email']?>"/>
        <br>
        <label>Enter Contact Phone: </label>
        <input type="text" name="phone" class="form-control" value="<?php echo $s_row['contact_phone']?>"/>
        <br>
        <label>Enter UserName: </label>
        <input type="text" name="username" class="form-control" value="<?php echo $s_row['username']?>"/>
        <br>
        <label>Enter Password: </label>
        <input type="text" name="pass" class="form-control" value="<?php echo $s_row['password']?>"/>
        <br>
        <input type="submit" class="btn btn-primary" value="Update User List" name="btnEdit"/>
    </form>
    </div>
                    </div>
                </div>
            </div>

    <?Php
    include 'footer.php' 
    ?>














