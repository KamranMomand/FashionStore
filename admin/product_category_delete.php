<?php
session_start();
if(isset($_GET['id']))
{   
    $id=$_GET['id'];
    $conn=mysqli_connect('localhost','root','','thrift_fashion');
    if($conn)
    {
        $status="Deactive";
        $query="UPDATE `product_category` SET `status`='$status' WHERE `id`='$id'";
        $result=mysqli_query($conn,$query);
        if($result)
        {
            header('location:product_category.php');
        }else{
            echo "Record Not Deleted";
        }
    }
}else{
    header('location:product_category.php');
}

?>