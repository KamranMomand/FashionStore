<?php
session_start();
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $conn=mysqli_connect('localhost','root','','thrift_fashion');
    if($conn)
    {
        $query="DELETE FROM `feedback` WHERE `id`='$id'";
        $result=mysqli_query($conn,$query);
        if($result)
        {
            header('location:feedback.php').mysqli_error($conn);
        }else{
            echo "Record Not Deleted".mysqli_error($conn);
        }
    }
}else{
    header('location:feedback.php');
}

?>