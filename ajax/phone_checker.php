<?php 
include 'db.php';
$number = $_POST['number'];
if ($number=='01315591444') {
	echo "b";
	exit();
}
$sql = "SELECT * FROM user WHERE phone_number='$number'";
$m  = mysqli_query($db,$sql);
if (mysqli_num_rows($m)==0) {
	echo "a";
}else {

	echo "b";
}
echo mysqli_num_rows($m);
?>