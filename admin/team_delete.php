<?php
session_start();
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $conn=mysqli_connect('localhost','root','','thrift_fashion');
    if($conn)
    {
        $query="DELETE FROM `team` WHERE `id`='$id'";
        $result=mysqli_query($conn,$query);
        if($result)
        {
            header('location:team.php');
        }else{
            echo "Record Not Deleted";
        }
    }
}else{
    header('location:team.php');
}

?>