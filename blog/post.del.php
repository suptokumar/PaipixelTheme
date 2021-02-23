<?php 
$db = mysqli_connect("localhost","paipixel_supto","Sk571960","paipixel_real") OR die("no connectiong available.");
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$sql = "DELETE FROM announce WHERE id='$id'";
	mysqli_query($db,$sql);
}
?><?php  mysqli_close($db); ?>