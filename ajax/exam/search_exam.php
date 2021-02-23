<?php 
include '../extra/db.extra.php';
$s = $_POST['search'];
	$sql = "SELECT * FROM question WHERE exam_id LIKE '%$s%' AND pending=1 GROUP BY exam_id LIMIT 200";
	$q = mysqli_query($db,$sql);
	?>
<table class="data_table">
	<tr>
		<th>Exam Name</th>
		<th>Exam No.</th>
		<th>Total Register</th>
		<th>Class/Chapter</th>
		<th class="rtr25">Durations</th>
		<th>Starting Time</th>
	</tr>
	<?php if (mysqli_num_rows($q)==0): ?>
		<tr>
			<td colspan="6" style="font: 1.7em sans-serif;">No Details Found</td>
		</tr>
	<?php endif ?>
	<?php
	while ($row = mysqli_fetch_array($q)) {
		
	?>

<tr class="exam_b<?php echo $row['exam_id'] ?>">
<td style="font-family: arial;"><a href="<?php get_domain("/exam.php?exam_details=".$row['exam_id']) ?>">
<?php echo $row['Exam_name'] ?></a></td>
<td style="font-family: arial;"><?php echo $row['exam_id'] ?></td>
<td style="font-family: arial;">
<?php
$sql = "SELECT * FROM exam_reg WHERE exam = '".$row['exam_id']."'";
$g = mysqli_query($db,$sql);
echo $s = mysqli_num_rows($g);  ?></td>
<td style="font-family: arial; text-align: left;"><?php echo $row['class'] ?> - <?php echo $row['chapter'] ?></td>
<td style="font-family: arial;" class="rtr25"><?php echo $row['exam_duration'] ?> Min</td>
<td style="font-family: arial;"><?php echo date("d M Y, h:i a",strtotime($row['exam_starting_date'])) ?></td>
</tr>

	<?php
}

?>
</table>
