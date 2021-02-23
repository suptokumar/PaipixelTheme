
<?php 
include '../ajax/db.php';
$profile = $_POST['profile'];
$me = $_POST['me'];
$sql = "SELECT id FROM user WHERE user_name='$me'";
$m = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m);
$me=$r[0];
// echo "$profile $me";
$sql = "SELECT * FROM msg WHERE (f_from='$profile' and f_to='$me') AND readed=0 ORDER BY id DESC";
$q = mysqli_query($db,$sql);
echo mysqli_num_rows($q);

?>

