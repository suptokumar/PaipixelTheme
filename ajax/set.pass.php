<?php 
$old_password = $_POST['old_password'];
$old_password = md5($old_password);
$new_password = $_POST['new_password'];
$new_password = md5($new_password);
$user = $_POST['user'];
include 'db.php';

$sql = "SELECT * FROM user WHERE user_name = '$user'";
$q = mysqli_query($db,$sql);
$row = mysqli_fetch_array($q);
$data_back = $row['back_data'];
if ($data_back==$old_password) {
	$sql = "UPDATE user SET back_data='$new_password' WHERE user_name='$user'";
	if (mysqli_query($db,$sql)) {
		echo 1;
	} else {
		echo 0;
	}
} else {
	echo "Old password is not valid.";
} ?>