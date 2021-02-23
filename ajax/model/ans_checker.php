<?php 
include '../extra/db.extra.php';
$as = ($_POST['as']);
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
session_start();
$user = user_detail("user_name");
$da = date("Y-m-d");
$sql = "SELECT * FROM `todays_model_data` WHERE data='$user' AND date='$da'";
$w = mysqli_query($db,$sql);
$r = mysqli_fetch_array($w);
$def = $r['time_in_s'];
$d = time();

// echo date("H:i:s",$def);

$curs = 0;
$curss = 0;


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
	#squestion<?php echo $real ?><?php echo $i+1 ?> {
		background: #00CD4822 !important;
	}
	#squestion<?php echo $row['ans'] ?><?php echo $i+1 ?> {
		background: #FF9D7170;
	}
</style>
<?php
}

}
?>
<div class="part_question DetailedQuestion" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 900px;">

<?php
echo "Total Questions: ". $as; br();
echo "Total Correct: ". $curss; br();
echo "Your Score: <span>". $curs."</span>";
?>
</div>
<?php
$rand = $_POST['rand'];
if ($rand == 0) {
	$rand = 'id';
}
if ($rand == 1) {
	$rand = 'question';
}
if ($rand == 1) {
	$rand = 'opt1';
}
if ($rand == 2) {
	$rand = 'opt2';
}
if ($rand == 3) {
	$rand = 'opt3';
}
if ($rand == 4) {
	$rand = 'opt4';
}
$rand = $_POST['rand'];
$rand = explode(",", $rand);
for($i=0; $i<count($rand);$i++) {
	$id = $rand[$i];
	$sql = "SELECT * FROM question WHERE id='$id' AND pending=1";
	$m = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($m);
	?>
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">
	<h3><span style="float:left"><?php echo $i+1 ?>.</span> <?php echo $question = $row["question"] ?></h3>
	<div class="input_party">
		<?php 
	$real = $row['currect'];
if (isset($_POST['question'.($i+1)])) {
	$optional = $_POST['question'.(($i+1))];
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
<style>
	#squestion<?php echo $real ?><?php echo $i+1 ?> {
		background: #00CD4822 !important; /* <?php echo $i ?> */
	}
	<?php if($optional!=''){ ?>
	#squestion<?php echo $optional; ?><?php echo $i+1 ?> {
		background: #FF9D7170;/* <?php echo $i ?> */
<?php } ?>
	}
</style>
		<div id="squestion1<?php echo ($i+1) ?>">
			<table>
				<tr>
					<td>A.</td>
					<td><label for="question1<?php echo ($i+1) ?>"><?php echo $opt1 =  $row['opt1'] ?></label></td>
				</tr>
			</table>
			
		</div>
		<div id="squestion2<?php echo ($i+1) ?>">

		<table>
			<tr>
				<td>B.</td>
				<td><label for="question2<?php echo ($i+1) ?>"><?php echo $opt2 =  $row['opt2'] ?></label></td>
			</tr>
		</table>
			
		</div>
		<div id="squestion3<?php echo ($i+1) ?>">
		<table>
			<tr>
				<td>C.</td>
				<td><label for="question3<?php echo ($i+1) ?>"><?php echo $opt3 =  $row['opt3'] ?></label></td>
			</tr>
		</table>

		</div>
		<div id="squestion4<?php echo ($i+1) ?>">
			<table>
			<tr>
				<td>D.</td>
				<td><label for="question4<?php echo ($i+1) ?>"><?php echo $opt4 =  $row['opt4'] ?></label></td>
			</tr>
		</table>
			<input type="hidden" name="id<?php echo ($i+1) ?>" value="<?php echo $row["id"] ?>">
			
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
$user = user_detail("user_name");
$sql = "INSERT INTO `todays_model` (`id`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `cur`, `ans`, `date`, `score`, `user`, `question_id`) VALUES (NULL, '$question', '$opt1', '$opt2', '$opt3', '$opt4', '$real', '$optional', '$date', '$curs', '$user', '$id')";
mysqli_query($db,$sql);

?>
</div>
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
	<?php
$user = user_detail("user_name");
$dt = date("Y-m-d H:i:s");
$sql = "INSERT INTO `score_leader_board` (`id`, `user_name`, `score`, `currect`, `total`, `date`) VALUES (NULL, '$user', '$curs', '$curss', '$as', '$dt') ";
mysqli_query($db,$sql);
?>
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
