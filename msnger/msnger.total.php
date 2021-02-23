
<?php 
include '../ajax/db.php';
$me = $_POST['me'];

// echo "$profile $me";
$sql = "SELECT * FROM msg WHERE f_to='$me' AND readed=0 ORDER BY id DESC";
$q = mysqli_query($db,$sql);
echo mysqli_num_rows($q);

?>

