<?php 
include '../extra/db.extra.php';
$exam = $_POST['exam'];
$sql = "SELECT * FROM question WHERE exam_id = '$exam' AND pending=1";
$m = mysqli_query($db,$sql);
$row = mysqli_fetch_array($m);
$e = mysqli_query($db,$sql);
date_default_timezone_set("Asia/Dhaka");
?>
<div class="ct_m25">
<?php if((strtotime($row['exam_starting_date'])+($row['exam_duration']*60))>time()){

		echo "Question Paper Not published.";
		exit(); 
	}
	else{
		echo "<h2 style='font-size: 1.3em'>".$row['name']."</h2>";
	}
?>
</div>
<style>
	.question_part p, .question_part span {
		background: none !important;
	}
</style>
<?php
if (mysqli_num_rows($e)==0) {
	echo "No Question Available !";
}
$i = 0;
while ($row = mysqli_fetch_array($e)) {
	$i++;
	?>
<div class="question_part" style="text-align: left; padding: 1%; margin: 10px auto; border: 1px solid #20b99d; max-width: 500px">
	<div style="overflow: hidden">
	<?php echo "<h4 style='float:left'>".translate($i).".</h4> ". $row['question']; ?>
	</div>
	<div class="option_part">
		<table style="font-family: tahoma;" class="opt1<?php echo $row['id'] ?>">
			<tr>
				<td><?php echo translate("A") ?>.</td>
				<td><?php echo $row['opt1'] ?></td>
			</tr>
		</table>
		<table style="font-family: tahoma;" class="opt2<?php echo $row['id'] ?>">
			<tr>
				<td><?php echo translate("B") ?>.</td>
				<td><?php echo $row['opt2'] ?></td>
			</tr>
		</table>
		<table style="font-family: tahoma;" class="opt3<?php echo $row['id'] ?>">
			<tr>
				<td><?php echo translate("C") ?>.</td>
				<td><?php echo $row['opt3'] ?></td>
			</tr>
		</table>
		<table style="font-family: tahoma;" class="opt4<?php echo $row['id'] ?>">
			<tr>
				<td><?php echo translate("D") ?>.</td>
				<td><?php echo $row['opt4'] ?></td>
			</tr>
		</table>
		</div>
		<div style="overflow: hidden;">
		<a href="javascript:void(0)" data-open='1' onclick="ausodn(this,<?php echo $row['id'] ?>)" style="color: #009cdb; float: right; margin: 10px;">Audio Explaination</a>
		<a href="javascript:void(0)" data-open='1' onclick="ttser(this,<?php echo $row['id'] ?>)" style="color: #009cdb; float: right; margin: 10px;">View Explaination</a> 
		</div>
		<div class="explain explain_<?php echo $row['id'] ?>" style="display: none;">
			<?php echo $row['details'] ?>
		</div>
		<div class="explain audio_<?php echo $row['id'] ?>" style="display: none;">
			<?php echo $row['audio_explain'] ?>
		</div>

		<style>
			.opt<?php echo $row['currect'] ?><?php echo $row['id'] ?> {
				background: lightgreen;
			}
		</style>
	</div>
</div><br>
	<?php
}
?>
<script>
function ttser(t,id)
{
	if ($(t).attr('data-open')=='1') {
	$(".explain_"+id).slideDown("slow");
	$(t).html("Hide Exlaination");
	$(t).attr('data-open','2');
	} else {
	$(t).html("View Explaination");
	$(t).attr('data-open','1');
	$(".explain_"+id).slideUp("slow");
	}
}
function ausodn(t,id)
{
	if ($(t).attr('data-open')=='1') {
	$(".audio_"+id).slideDown("slow");
	$(t).html("Hide Audio Exlaination");
	$(t).attr('data-open','2');
	} else {
	$(t).html("Audio Explaination");
	$(t).attr('data-open','1');
	$(".audio_"+id).slideUp("slow");
	}
}
</script>