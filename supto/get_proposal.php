<tr class="w3-purple">
	<th style="text-align: center;">Reference Id</th>
	<th style="text-align: center;">Teacher</th>
	<th style="text-align: center;">Proposal</th>
	<th style="text-align: center;">Question</th>
	<th style="text-align: center;">Date</th>
	<th style="text-align: center;">Status</th>
</tr>
<?php 
include 'db.php';
$s = $_POST['search'];
$sql= "SELECT * FROM proposal WHERE user LIKE '%$s%' OR ref ='$s' GROUP BY user ORDER BY CASE WHEN ref='$s' THEN 0 WHEN user='$s' THEN 0 WHEN user LIKE '$s%' THEN 1 WHEN user LIKE '%$s%' THEN 2 ELSE 3 END, date,accept DESC LIMIT 200";
$m = mysqli_query($db,$sql);
		if (mysqli_num_rows($m)==0) {
		?>
<tr>
	<td colspan="4">Nothing Found</td>
</tr>
		<?php
	}
	session_start();
while ($row = mysqli_fetch_array($m)) {
	$setter = $row['user'];

	$sql = "SELECT id FROM question WHERE setter='$setter' AND exam_id='".more_user("id",$setter).$row['ref']."'";
	$n = mysqli_query($db,$sql);
	$total = mysqli_num_rows($n);

?>
<tr>
	<td><a href="<?php get_domain("/exam.php?add_question&ref=".$row['ref']) ?>"><?php echo $row['ref'] ?></a></td>
	<td><?php echo $row['user'] ?></td>
	<td><?php echo $row['proposal'] ?></td>
	<td class="w3-orange w3-center" style="cursor: pointer;" onclick="open_question_set('<?php echo more_user("id",$setter).$row['ref']; ?>')"><?php echo $total ?></td>
	<td><?php echo $row['date'] ?></td>
	<td><?php if ($row['accept']){
		?>
<a href="javascript:void(0)" class="w3-link w3-button w3-red">Accepted</a>
		<?php
	} else {
				?>
<a href="javascript:void(0)" class="w3-link w3-button w3-green" onclick="accept645dsf('<?php echo $setter ?>','<?php echo $row['ref'] ?>');">Accept</a>
		<?php
	} ?></td>
</tr>
<?php
}
?>