<?php 
include '../extra/db.extra.php';
session_start();
$t = $_SESSION['login_data_paipixel24'];
$id = $_POST['id'];
$sql = "SELECT * FROM tutorial WHERE teacher='$t' AND id='$id'";
$q = mysqli_query($db,$sql);
if (mysqli_num_rows($q)==0) {
	echo "access denied !";
} else {
	$sql = "DELETE FROM tutorial WHERE id='$id'";
	if (mysqli_query($db,$sql)) {
		echo "Tutorial Deleted.";
	}
}
?>
