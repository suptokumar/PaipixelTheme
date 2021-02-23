<?php 
$user_name= $_POST['user_name'];
$adder= $_POST['adder'];

include '../extra/db.extra.php';

$sql = "SELECT team FROM user WHERE user_name='$adder'";
$q = mysqli_query($db,$sql);
$row = mysqli_fetch_array($q);
$team = $row[0];

$sql = "UPDATE user SET team='$team' , position_in_team='Junior' WHERE user_name='$user_name'";
if (mysqli_query($db,$sql)) {
	echo "Added";
}

?>