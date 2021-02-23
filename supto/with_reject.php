<?php 

include '../functions.php';
include '../ajax/db_back.php';
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
$id = $_POST['id'];
$sql = "UPDATE withdraw SET status='Rejected', date2='$date' WHERE id='$id'";
mysqli_query($db,$sql);

?>