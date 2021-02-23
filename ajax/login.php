<?php 
include 'db.php';
if (isset($_POST['login'])) {
	$pass = $_POST['login'];
	$data = $_POST['data'];
	$ps = md5($pass);
	$sql = "SELECT * FROM user WHERE (user_name='$data' OR phone_number = '$data') AND back_data='$ps'";
	$q = mysqli_query($db,$sql);
	if (mysqli_num_rows($q)==1) {
		echo "1";
		session_start();
		$r = mysqli_fetch_array($q);
		$_SESSION['login_data_paipixel24']=$r['user_name'];
	} else{
		echo "0";

	}
}

 ?>