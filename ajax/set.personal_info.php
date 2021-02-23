<?php 
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$google_location = $_POST['google_location'];
$bio = $_POST['bio'];
$user = $_POST['user'];
$depertment = $_POST['email'];
$email = $_POST['depertment'];
include 'db.php';

$sql ="UPDATE user SET first_name='$first_name', last_name='$last_name',depertment='$depertment',email='$email', address='$address', google_location='$google_location', bio='$bio' WHERE user_name='$user'";
if (mysqli_query($db,$sql)) {
	echo "Successfuly Updated";
} else {
	echo "Failed To update";
}
?>