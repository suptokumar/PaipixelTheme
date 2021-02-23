<?php 
include '../ajax/db.php';
$me = $_POST['me'];
$sql = "SELECT id FROM user WHERE user_name='$me'";
$m = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m);
$me=$r[0];
$sql = "SELECT * FROM msg WHERE f_to='$me' ORDER BY id DESC LIMIT 2";
$q = mysqli_query($db,$sql);
$s = mysqli_fetch_array($q);

echo $s['f_from'];













?>