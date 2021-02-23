<?php 
include '../extra/db.extra.php';
$id = $_GET['id'];
$sql = "DELETE FROM `team_chal` WHERE id='$id'";
if (mysqli_query($db,$sql)) {
	echo "Successfuly Deleted The Team Challenge.";
}else {
	echo "Failed to Delete The Team Challenge.";
}
?>