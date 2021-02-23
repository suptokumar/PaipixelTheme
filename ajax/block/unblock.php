<?php 
include '../extra/db.extra.php';
$user = $_POST['user'];
session_start();
$usa = user_detail("user_name");
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
$sql = "DELETE FROM `block` WHERE `from`='$usa' AND `to`='$user'";
mysqli_query($db,$sql);
?>