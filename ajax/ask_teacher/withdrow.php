<?php 
include '../extra/db.extra.php';
$id = $_POST['id'];
$user = $_POST['user'];
$sql = "DELETE FROM ans_ask WHERE question='$id' AND user='$user'";
mysqli_query($db,$sql);
?>