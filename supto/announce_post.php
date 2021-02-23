<?php 
include 'db.php';
$header = $_POST['header'];
$v = $_POST['consoe'];
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
if (isset($_POST['id'])) {
	$id = $_POST['id'];
$sql = "UPDATE announce SET body='$v',header='$header' WHERE id='$id'";
} else {
$sql  = "INSERT INTO `announce` (`id`, `header`, `body`, `datetime`,`user`) VALUES (NULL, '$header', '$v', '$date','Paipixel Team') ";
}
if (mysqli_query($db,$sql)) {
	echo "Success";
} else {
	echo "Failed";
}
?>