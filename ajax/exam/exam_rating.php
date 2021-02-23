<?php 
include '../extra/db.extra.php';
$e = $_POST['exam'];
session_start();
?>
	<table class="data_table">
		<tr>
		<th>ID</th>
		<th>User Name</th>
		<th>Pre Ratings</th>
		<th>New Ratings</th>
		</tr>
		<?php 
$sql = "SELECT * FROM rating_board WHERE exam='$e' ORDER BY (now_rating-pre_rating) DESC";
$m = mysqli_query($db,$sql);
$id = 1;
if (mysqli_num_rows($m)==0) {
	?>
<tr>
	<td style="font-family: arial;" colspan="4">Nothing Changed</td></tr>
	<?php
}
while ($row=mysqli_fetch_array($m)) {
	?>
		<tr>
			<td style="font-family: arial;"><?php echo $id ?></td>
			<td style="font-family: arial;"><?php echo $row['user'] ?></td>
			<td style="font-family: arial;"><?php echo rating($row['pre_rating']); ?></td>
			<td style="font-family: arial;"><?php echo rating($row['now_rating']); ?></td>
		</tr>
	<?php 
	$id++;
}
		?>
	</table>