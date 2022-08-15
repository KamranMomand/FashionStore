<?php
session_start();
unset($_SESSION['Username']);
unset($_SESSION['User_Id']);
header('location: index.php');
exit();
