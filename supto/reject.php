<?php 
include 'db.php';
$s = $_POST['search'];
$data = $_POST['data'];
$sql = "UPDATE question SET pending=2 WHERE id='$s'";
if (mysqli_query($db,$sql)) {
	echo "Rejected !";
}
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
$sql = "INSERT INTO `reject_msg` (`id`, `q_id`, `msg`, `date`) VALUES (NULL, '$s', '$data', '$date')";
mysqli_query($db,$sql);
?>