<?php 
include '../extra/db.extra.php';
session_start();
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
$user_name = user_detail("user_name");
$phone = $_POST['phone'];
$pass = $_POST['pass'];
$amount = $_POST['amount'];
$error = 0;
if ($pass=='' || $phone=='') {
	echo "\nPlease Try again.";
$error = 1;
}
if ($amount<499) {
	echo "\nAmount Detection Failed.";
$error = 1;
}
if (md5($pass)!=user_detail("back_data")) {
	echo "\nWrong Password.";
$error = 1;
}
if ($error==0) {
	$user = $user_name;
$sql = "SELECT balance FROM user WHERE user_name='$user'";
$m = mysqli_query($db,$sql);
$row = mysqli_fetch_array($m);
$bal = $row['balance'];
$UPDATE = ($bal)-($amount);
$sql ="UPDATE user SET balance='$UPDATE' WHERE user_name='$user'";
mysqli_query($db,$sql);



	$sql = "INSERT INTO `withdraw` (`id`, `user`, `datetime`, `phone`, `amount`, `status`) VALUES (NULL, '$user_name', '$date', '$phone', '$amount', 'Pending') ";
	if (mysqli_query($db,$sql)) {
		echo "Successfully request Sent.";
	}
}

?>