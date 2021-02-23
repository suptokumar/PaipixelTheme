<?php 
include 'db.php';
$user = $_GET['user'];
$limit = 30;

if ($user=='') {
	exit();
}
?>
<tr>
		<?php 
	if (isset($_GET['edit'])) {
		$limit = 50000000;
		$user = '';
		session_start();
		$team = user_detail("team");
	?>
	<th>Select</th>
	<?php
} ?>
<th>Image</th>
	<th>User</th>
	<th>Rating</th>

</tr>
<?php
if (isset($_GET['edit'])) {
$sql = "SELECT * FROM user WHERE user_name LIKE '%$user%' AND role=1 AND team='$team' ORDER BY CASE
WHEN user_name = '$user' THEN 1
WHEN user_name LIKE '$user%' THEN 2
ELSE 3 END, user_name ASC LIMIT $limit";
} else {
$sql = "SELECT * FROM user WHERE user_name LIKE '%$user%' ORDER BY CASE
WHEN user_name = '$user' THEN 1
WHEN user_name LIKE '$user%' THEN 2
ELSE 3 END, user_name ASC LIMIT $limit";
}
$m = mysqli_query($db,$sql);
if (mysqli_num_rows($m)==0) {
	echo "<tr><td colspan=3>Nothing Found for ".$user."</td></tr>";
}
while ($row=mysqli_fetch_array($m)) {
	?>
<tr style="font-family: arial;">		<?php 
	if (isset($_GET['edit'])) {
	?>
	<td><input type="checkbox" onchange="yea_this(this,'<?php echo $row['id'] ?>')" value="<?php echo $row['user_name'] ?>" class="t44f" name="user_id<?php echo $row['id'] ?>"></td>
	<?php
} ?>
	<td><img src="<?php get_domain("/content/") ?><?php echo $row['image'] ?>" style="width: 40px" alt="<?php echo $row['user_name'] ?>"></td>
	<td><a href="http://localhost/profile/<?php echo $row['user_name'] ?>" style="text-decoration: none;"><?php echo my_name($row['user_name']) ?></a></td>
	<td><?php echo rating($row['rating']) ?><span id="aj<?php echo $row['id'] ?>"></span></td>

</tr>
	<?php
}

if (mysqli_num_rows($m)==0 && !isset($_GET['edit'])) {
	$sql = "SELECT user_name from user";
	$ma = mysqli_query($db,$sql);
	$arr = [];
	$i=0;
	while ($r = mysqli_fetch_array($ma)) {
		$arr[$i]=$r[0];
	$i++;
	}

	$ms= count($arr);
	$top = [[]];
	for ($i=0; $i < $ms; $i++) { 
		similar_text($user,$arr[$i],$percent);
		$top[$i][0]=$arr[$i];
		$top[$i][1]=$percent;
	}


$c = implode($top);
usort($top, "isOkay");
for ($i=0; $i < 5; $i++) { 
	?>
<tr>
	<td><img src="<?php get_domain("/content/") ?><?php echo more_user("image",$top[$i][0]) ?>" style="width: 40px" alt="<?php echo $top[$i][0] ?>"></td>
	<td><a href="http://localhost/profile/<?php echo $top[$i][0] ?>" style="text-decoration: none;"><?php echo my_name($top[$i][0]) ?></a></td>
	<td><?php echo rating(more_user("rating",$top[$i][0])) ?><span id="aj<?php echo more_user("id",$top[$i][0]) ?>"></span></td>

</tr>
	<?php
}
}
function isOkay($a,$b)
{
	if($a[1]<=$b[1]) return 1;
	else return -1;
}
?>