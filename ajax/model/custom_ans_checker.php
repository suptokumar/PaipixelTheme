<?php 
include '../extra/db.extra.php';
$as = ($_POST['as']);
$time = $_POST['time'];
date_default_timezone_set("Asia/Dhaka");
$d = time();

$def = (($d)-($time));
// echo date("H:i:s",$def);

$curs = 0;
$curss = 0;
$date = date("Y-m-d H:i:s");
session_start();
$user = user_detail("user_name");


for ($i=0; $i < $as; $i++) { 
	if (isset($_POST['question'.($i+1)])) {
		$ans = $_POST['question'.($i+1)];
		$id = $_POST['id'.($i+1)];
		$sql = "SELECT * FROM `question` WHERE id='$id'";
		$s = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($s);
		$question = $row['question'];
		$ans1 = $row['opt1'];
		$ans2 = $row['opt2'];
		$ans3 = $row['opt3'];
		$ans4 = $row['opt4'];
		$ct = $row['currect'];
		$cur = $ct;
if ($ans==$cur) {
	$curss += 1;
	$curs += 1-($def*0.0002);
} else {
	$curs += 0-($def*0.0002);
}
?>
<style>
	#squestion<?php echo $cur ?><?php echo $i+1 ?> {
		background: #73FF8F !important;
	}
	<?php if ($ans!='') {
		?>

	#squestion<?php echo $ans ?><?php echo $i+1 ?> {
		background: #FF6B6F;
	}
		<?php
	} ?>
</style>
<?php
}

}
?>
<div class="part_question DetailedQuestion" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 900px;">
<style>
	.colorize{
		animation: colors 1s infinite;
	}
	@keyframes colors {
		0%{
			color: red;
		}
		10%{
			color: blue;
		}
		20%{
			color: green;
		}
		30%{
			color: lime;
		}
		40%{
			color: yellow;
		}
		50%{
			color: purple;
		}
		60%{
			color: skyblue;
		}
		70%{
			color: tan;
		}
		80%{
			color: black;
		}
		90%{
			color: aqua;
		}
		100%{
			color: purple;
		}
	}
</style>
<?php
echo "Total Questions: ". $as; br();
echo "Correct Answer: ". $curss; br();
echo "Accuracy: ". ($curss*100)/$as; echo "%"; br();
echo "Score: <span>". $curs."</span>";
?>
</div>
<?php
if (($curss*100)/$as>79) {
	?>
<div style="font-size: 20px; padding: 2%; text-align: center; border: 10px solid #ff9abf;">

	<?php

	$sql = "UPDATE user SET perfect_aa=(perfect_aa+1) WHERE user_name='$user'";
	mysqli_query($db,$sql);
	echo "<h2>Congratulations!</h2> You have earned a Perfect Accuracy. Your Total Perfect Accuracy is ".user_detail("perfect_aa");
}
?>

</div>


<?php
$rand = $_POST['rand'];
$rand = explode(",", $rand);
for($i=0; $i<count($rand);$i++) {
	$id = $rand[$i];
	$sql = "SELECT * FROM question WHERE id='$id' AND pending=1";
	$m = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($m);
	$cls = $row['class'];
	$subject = $row['subject'];
	$topic = $row['Exam_name'];
	$explaination = $row['details'];
	$audio_explain = $row['audio_explain'];
	$chapter = $row['chapter'];
	?>
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">
	

	<h3><span style="float:left"><?php echo $i+1 ?>.</span> <?php echo $question = $row["question"] ?></h3>
	<div class="input_party">
		<?php 
	$real = $row['currect'];
if (isset($_POST['question'.($i+1)])) {
	$optional = $_POST['question'.($i+1)];
	if ($row['opt'.$real]!=$optional) {
		if ($optional==$row['opt1']) {

		}
	}
?>

		<?php
?>

<?php
} else {
	echo "<span style='color: red'>Not Submited</span>"; br();
	$optional = '';
}
		?>

		<div id="squestion1<?php echo $i+1 ?>">
			<table>
				<tr>
					<td>A.</td>
					<td><label for="question1<?php echo $i+1 ?>"><?php echo $opt1 =  $row['opt1'] ?></label></td>
				</tr>
			</table>
			
		</div>
		<div id="squestion2<?php echo $i+1 ?>">

		<table>
			<tr>
				<td>B.</td>
				<td><label for="question2<?php echo $i+1 ?>"><?php echo $opt2 =  $row['opt2'] ?></label></td>
			</tr>
		</table>
			
		</div>
		<div id="squestion3<?php echo $i+1 ?>">
		<table>
			<tr>
				<td>C.</td>
				<td><label for="question3<?php echo $i+1 ?>"><?php echo $opt3 =  $row['opt3'] ?></label></td>
			</tr>
		</table>

		</div>
		<div id="squestion4<?php echo $i+1 ?>">
			<table>
			<tr>
				<td>D.</td>
				<td><label for="question4<?php echo $i+1 ?>"><?php echo $opt4 =  $row['opt4'] ?></label></td>
			</tr>
		</table>
			<input type="hidden" name="id<?php echo $i+1 ?>" value="<?php echo $row["id"] ?>">
			
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
	</div>
<?php 
$date = date("Y-m-d");
$dt = date("Y-m-d H:i:s");
$user = user_detail("user_name");
?>
</div>
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
<style>
.DetailedQuestion {
	background: url("image/ani_back.gif") 0 0 / 100% !important;
	padding: 5% !important;
	font-size: 30px;
	color: white;
	text-shadow: 2px 1px 1px #37E5FF;
}
.DetailedQuestion span {
	color: yellow;
}
</style>
	<?php
$user = user_detail("user_name");
$sql = "INSERT INTO `custom_score` (`id`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `ans`, `cur`, `date`, `user`, `score`, `class`, `subject`, `topic`, `explaination`, `audio`, `chapter`) VALUES (NULL, '$question', '$opt1', '$opt2', '$opt3', '$opt4', '$optional', '$real', '$dt', '$user', '$curs', '$cls', '$subject', '$topic', '$explaination', '$audio_explain', '$chapter') ";
mysqli_query($db,$sql);
}
$user = user_detail("user_name");
$sql = "INSERT INTO `score_leader_board` (`id`, `user_name`, `score`, `currect`, `total`, `date`) VALUES (NULL, '$user', '$curs', '$curss', '$as', '$dt') ";
mysqli_query($db,$sql);
?>