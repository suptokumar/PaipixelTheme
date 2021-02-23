<?php
include 'db.php';
session_start();
$user = user_detail("user_name");
$search = $_POST['search'];
	$sql = "SELECT * FROM exam_score WHERE user='$user' AND exam LIKE '%$search%' GROUP BY exam ORDER BY id DESC LIMIT 200";
	$q = mysqli_query($db,$sql);
	?>
<link rel="stylesheet" href="<?php get_domain("/css/table.css") ?>">
<table class="data_table">
	<tr>
		<th>Exam No.</th>
		<th>Exam Name</th>
		<th>Total Participated</th>
		<th>Your Score</th>
		<th class="rtr25">Penalty</th>
		<th>Date</th>
	</tr>
	<?php if (mysqli_num_rows($q)==0): ?>
		<tr>
			<td colspan="6">No Details Found</td>
		</tr>
	<?php endif ?>
	<?php
	while ($row = mysqli_fetch_array($q)) {
	$e = $row['exam'];
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
		$eee = $r['question'];
		$answer = $r['answer'];
		$ddd = "SELECT * FROM question WHERE id='$eee' AND pending=1";
		$dfas = mysqli_query($db,$ddd);
		$t = mysqli_fetch_array($dfas);
		if ($t['opt'.$t['currect']]==$answer) {
		$cur++;
		$penalty += 1-($r['score']);
		} else {
		$penalty += 0-($r['score']);
		}

	}
	?>

<tr class="exam_b<?php echo $row['exam_id'] ?>">
<td style="font-family: arial;"><a href="<?php get_domain("/exam.php?exam_details=".$row['exam']) ?>">
<?php echo get_exam_name($row['exam']) ?></a></td>
<td style="font-family: arial;"><?php echo $row['exam'] ?></td>
<td style="font-family: arial;">
<?php
$sql = "SELECT * FROM exam_reg WHERE exam = '".$row['exam']."'";
$g = mysqli_query($db,$sql);
echo $s = mysqli_num_rows($g);  ?></td>
<td style="font-family: arial; text-align: left;"><?php echo number_format($my_score,3); ?></td>
<td class="rtr25" style="font-family: arial;"><?php echo number_format($penalty,3); ?> Min</td>
<td style="font-family: arial;"><?php echo date("d M Y, h:i a",strtotime($row['datetime'])) ?></td>
</tr>

	<?php
}
?>
</table>
