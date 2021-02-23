<?php 
include '../extra/db.extra.php';
$e = $_POST['exam'];
session_start();
?>
	<table class="data_table">
		<tr>
		<th>ID</th>
		<th>User Name</th>
		<th>Time Penalty</th>
		<th>Total Correct</th>
		<th>Score</th>
		</tr>
		<?php 
$sql = "SELECT * FROM exam_score WHERE exam='$e' GROUP BY user ORDER BY SUM(score) DESC";
$m = mysqli_query($db,$sql);
$id = 1;
while ($row=mysqli_fetch_array($m)) {
	$my_score = 0;
	$time = 0;
	$user_name = $row['user'];
	$cur=0;
	$penalty=0;
	$sql = "SELECT * FROM exam_score WHERE exam='$e' AND user='$user_name'";
	$o = mysqli_query($db,$sql);
	while ($r = mysqli_fetch_array($o)) {
		$my_score += $r['score'];
		$time += $r['time'];
		$q = $r['question'];
		$answer = $r['answer'];
		$sql = "SELECT * FROM question WHERE id='$q' AND pending=1";
		$dfas = mysqli_query($db,$sql);
		$t = mysqli_fetch_array($dfas);
		if ($t['currect']==$answer) {
		$cur++;
		$penalty += 1-($r['score']);
		} else {
		$penalty += 0-($r['score']);
		}
	}
	?>
		<tr>
			<td style="font-family: arial;"><?php echo $id ?></td>
			<td style="font-family: arial;"><?php echo $row['user'] ?></td>
			<td style="font-family: arial;"><?php echo number_format($penalty,3); ?></td>
			<td style="font-family: arial;"><?php echo $cur; ?></td>
			<td style="font-family: arial;"><?php echo number_format($my_score,3); ?></td>
		</tr>
	<?php 
	$id++;
}
		?>
	</table>