<?php
session_start();
include 'config.php';

if(isset($_POST['dailyof']))
{
    $id=$_POST['p_id'];
    $sdate=$_POST['s_date'];
    $edate=$_POST['e_date'];
    $discount=$_POST['o_discount'];

    $query="INSERT INTO `daily_offers`(`product_id`, `discount`, `start_date`, `end_date`) VALUES ('$id','$discount','$sdate','$edate')";
    $result=mysqli_query($conn,$query);
    echo $result;
}

?>