<?php 
include '../extra/db.extra.php';
$user = $_POST['user'];
session_start();
$usa = user_detail("user_name");
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
$sql = "INSERT INTO `block`(`from`, `to`, `date`) VALUES ('$usa','$user','$date')";
mysqli_query($db,$sql);
?>