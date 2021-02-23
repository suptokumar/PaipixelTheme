<?php 
include 'db.php'; 
$id = $_POST['id'];

$sql = "DELETE FROM noti WHERE id='$id'";
mysqli_query($db,$sql);
?>