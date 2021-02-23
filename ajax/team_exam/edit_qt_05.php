
<?php 
include '../extra/db.extra.php';
session_start();
if (!isset($_SESSION['login_data_paipixel24'])) {
	echo "Login Error";
	exit();
}
$setter = $_SESSION['login_data_paipixel24'];
$id = $_POST['id'];
$q = $_POST['q'];
$opt1 = $_POST['opt1'];
$opt2 = $_POST['opt2'];
$opt3 = $_POST['opt3'];
$opt4 = $_POST['opt4'];
$currect = $_POST['currect'];
$sql = "UPDATE `team_chal_qtn` SET `question` = '$q', `ans1` = '$opt1', `ans2` = '$opt2', `ans3` = '$opt3', `ans4` = '$opt4', `ct` = '$currect',  `user` = '$setter' WHERE `team_chal_qtn`.`id` = '$id' ";
if (mysqli_query($db,$sql)) {
	echo "Success !";
}
?>