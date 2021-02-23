<?php 
include 'db.extra.php';
session_start();
if (isset($_SESSION['login_data_paipixel24'])) {
	 $user = $_SESSION['login_data_paipixel24'];
  $sql = "SELECT * FROM user WHERE user_name = '$user'";
  $q = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($q);
  echo $row['role'];
}
?>