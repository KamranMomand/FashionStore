<?php
session_start();
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $conn=mysqli_connect('localhost','root','','thrift_fashion');
    if($conn)
    {
        $query="DELETE FROM `user` WHERE `id`='$id'";
        $result=mysqli_query($conn,$query);
        if($result)
        {
            header('location:user_list.php');
        }else{
            echo "Record Not Deleted";
        }
    }
}else{
    header('location:user_list.php');
}

?>