
<?php 
include 'db.php';
$s = $_POST['search'];
$sql= "SELECT * FROM question WHERE id='$s'";
$m = mysqli_query($db,$sql);
	if (mysqli_num_rows($m)==0) {
		?>
	<h3 colspan="5" class="w3-red">BAD REQUEST</h3>
		<?php
	}
while ($row = mysqli_fetch_array($m)) {
	$id = $row['id'];

?>
<div class="question">
	<?php echo $row['question'] ?>
</div>
<table>
	<tr>
		<td><h3>1.</h3></td>
		<td><?php echo $row['opt1'] ?></td>
	</tr>
	<tr>
		<td><h3>2.</h3></td>
		<td><?php echo $row['opt2'] ?></td>
	</tr>
	<tr>
		<td><h3>3.</h3></td>
		<td><?php echo $row['opt3'] ?></td>
	</tr>
	<tr>
		<td><h3>4.</h3></td>
		<td><?php echo $row['opt4'] ?></td>
	</tr>
</table>
<table>

	<tr>
		<td><h3>Correct</h3></td>
		<td><?php echo $row['currect'] ?></td>
	</tr>
	<tr>
		<td><h3>Explaination</h3></td>
		<td><?php echo $row['details'] ?></td>
	</tr>
	<tr>
		<td><h3>Audio Explaination</h3></td>
		<td><?php echo $row['audio_explain'] ?></td>
	</tr>
	<tr>
		<td><h3>Topics</h3></td>
		<td><?php echo $row['Exam_name'] ?></td>
	</tr>
	<tr>
		<td><h3>Question ID</h3></td>
		<td><?php echo $row['id'] ?></td>
	</tr>
</table>
<?php
}
?>
