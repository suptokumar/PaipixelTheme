<?php 
include '../extra/db.extra.php';
session_start();
$user= user_detail("user_name");
	$sql = "SELECT id FROM noti WHERE user='$user' AND seen=0";
	$m01 = mysqli_query($db,$sql);
	$req = mysqli_num_rows($m01);
	if ($req!=0) {
	$fsono = '<span class="assist">'.$req.'</span>';
} else {
	$fsono = '';

}
echo $fsono;
 ?>