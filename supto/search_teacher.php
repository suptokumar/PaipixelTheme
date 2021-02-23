<tr class="w3-purple">
	<th style="text-align: center;">Teacher's Name</th>
	<th style="text-align: center;">Total Questions</th>
	<th style="text-align: center;">Total Pending</th>
	<th style="text-align: center;">Total Approved</th>
	<th style="text-align: center;">Total Rejected</th>
	<th style="text-align: center;">Open Database</th>
</tr>
<?php 
include 'db.php';
$s = $_POST['search'];
$sql= "SELECT * FROM question WHERE setter LIKE '%$s%' GROUP BY setter ORDER BY CASE WHEN setter='$s' THEN 0 WHEN setter LIKE '$s%' THEN 1 WHEN setter LIKE '%$s%' THEN 2 ELSE 3 END, SUM(pending) DESC LIMIT 200";
$m = mysqli_query($db,$sql);
		if (mysqli_num_rows($m)==0) {
		?>
<tr>
	<td colspan="4">Nothing Found</td>
</tr>
		<?php
	}
while ($row = mysqli_fetch_array($m)) {
	$setter = $row['setter'];

	$sql = "SELECT id FROM question WHERE setter='$setter' AND exam_id=0";
	$n = mysqli_query($db,$sql);
	$total = mysqli_num_rows($n);

	$sql = "SELECT id FROM question WHERE setter='$setter' AND pending=0 AND exam_id=0";
	$n = mysqli_query($db,$sql);
	$pending = mysqli_num_rows($n);

	$sql = "SELECT id FROM question WHERE setter='$setter' AND pending=1 AND exam_id=0";
	$n = mysqli_query($db,$sql);
	$approved = mysqli_num_rows($n);

	$sql = "SELECT id FROM question WHERE setter='$setter' AND pending=2 AND exam_id=0";
	$n = mysqli_query($db,$sql);
	$rejected = mysqli_num_rows($n);
?>
<tr>
	<td><?php echo $row['setter'] ?></td>
	<td class="w3-orange w3-center"><?php echo $total ?></td>
	<td class="w3-indigo w3-center"><?php echo $pending ?></td>
	<td class="w3-green w3-center"><?php echo $approved ?></td>
	<td class="w3-red w3-center"><?php echo $rejected ?></td>
	<td onclick="open_total('<?php echo $row['setter'] ?>')" class="w3-indigo w3-center w3-link w3-button">Open</td>
</tr>
<?php
}
?>