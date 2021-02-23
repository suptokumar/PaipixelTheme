<?php 
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$user = $_POST['user'];
include 'db.php';
$sql = "SELECT * FROM user WHERE user_name = '$user'";
$q = mysqli_query($db,$sql);
$row = mysqli_fetch_array($q);
$emailo = $row['email'];
$phone_numbero = $row['phone_number'];
$phone_confirm = $row['phone_confirm'];
$email_confirm = $row['email_confirm'];
if ($email==$emailo) {
	$eup = $email_confirm;
} else {
	$eup = 0;
}
if ($phone_number==$phone_numbero) {
	$pup = $phone_confirm;
} else {
	$pup = 0;
}


$sql ="UPDATE user SET phone_number='$phone_number', email='$email', phone_confirm='$pup', email_confirm='$eup' WHERE user_name='$user'";
if (mysqli_query($db,$sql)) {
	echo "Successfuly Updated";
} else {
	echo "Failed To update";
}
?>