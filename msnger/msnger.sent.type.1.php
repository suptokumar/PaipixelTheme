<?php 
include '../ajax/db.php';
$from = $_POST['from'];
$sql = "SELECT id FROM user WHERE user_name='$from'";
$m = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m);
$from=$r[0];
$to = $_POST['to'];
$msg = $_POST['msg'];
$code = $_POST['code'];
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");

$sql = "INSERT INTO msg(f_to,f_from,msg,date) VALUES('$to','$from','$msg','$date')";
if (mysqli_query($db,$sql)) {
	echo $code;
} else {
	echo "failed";
}
?>