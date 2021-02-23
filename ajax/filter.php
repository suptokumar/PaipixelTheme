<?php 
include 'db.php';
if (isset($_GET['user_name_24'])) {
	$user = $_GET['user_name_24'];

	$sql = "SELECT * FROM user WHERE user_name='$user'";
	$q = mysqli_query($db,$sql);
	if (mysqli_num_rows($q) == 0) {
		echo 0;
	} else {
		echo 1;
	}

}

 ?>