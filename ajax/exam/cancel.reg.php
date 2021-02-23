<?php 
include '../extra/db.extra.php';

$exam = $_POST['exam'];

session_start();
if (!isset($_SESSION['login_data_paipixel24'])) {
echo "Login Error !";	
exit();
}
$user = $_SESSION['login_data_paipixel24'];

$sql = "DELETE FROM exam_reg WHERE `exam` = '$exam' AND `user`='$user'";
if (mysqli_query($db,$sql)) {
	echo "Register";
}