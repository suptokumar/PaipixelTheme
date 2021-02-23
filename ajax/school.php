<?php 
include 'db.php';
function get_registered($school)
{
	global $db;
$sql = "SELECT * FROM user WHERE school='$school'";
$m = mysqli_query($db,$sql);
return mysqli_num_rows($m);
}
$s = $_POST['s'];
$sql = "SELECT school FROM school WHERE school LIKE '%$s%' GROUP BY school ORDER BY CASE
WHEN school='$s' THEN 1
WHEN school LIKE '$s%' THEN 2
WHEN school LIKE '%$s%' THEN 3
END, school ASC LIMIT 50
";
$m = mysqli_query($db,$sql);
while ($row = mysqli_fetch_array($m)) {
	$s = strtoupper($s);
$str = strtoupper($row['school']);


if (isset($_POST['id'])) {
$id = $_POST['id'];
} else {
$id ='institution';

}
	?>

<div onclick="document.getElementById('<?php echo $id ?>').value = this.getElementsByTagName('input')[0].value;search_d52(1);"><?php echo str_replace(array($s),array("<strong>".$s."</strong>"), $str); ?><br> Registered Students: <strong style="font-family: arial"><?php echo get_registered($str) ?></strong> 
	<input type='hidden' value='<?php echo $str; ?>'>
</div>

	<?php 
}





