<?php 
include '../extra/db.extra.php';
session_start();
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d");
$user_name = user_detail("user_name");
?>
<form id="todays_model">
<div class="model_question">
<?php 
$my_class = user_detail("class");
if ($my_class=="Nothing") {
	echo "Please Login and Try again.";
	exit();
}
$rand = rand(0,4);
$pw_rand = $rand;
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
$subject = $_GET['subject'];
if (isset($_GET['mul'])) {
$chapter = $_GET['mul'];
} else {
$chapter = '2nd, General Knowledge';
}

$chapter = explode("```", $chapter);
$chapter_data = '';
$nodnd = count($chapter);
for ($i=0; $i < $nodnd; $i++) { 
	if ($i==0) {
		$chapter_data .= "AND (";
	}
	$chapter_data .= "chapter='".$chapter[$i]."'";

	if ($i!=(($nodnd)-1)) {
		$chapter_data .= "  OR ";
	}
	if ($i==(($nodnd)-1)) {
		$chapter_data .= ") ";
	}
}
$short = json_decode($_GET['short']);

$ps = " AND (";
for ($i=0; $i < count($short); $i++) { 
 	$ps.="Exam_name LIKE '%".$short[$i]."%'";
 	if (count($short)-1!=$i) {
 		$ps .= " OR ";
 	}
} 
$ps.=")";

if ($ps==" AND ()") {
	$ps = '';
}
// echo $ps;
$limit = $_GET['limit'];
$sql  = "SELECT * FROM question WHERE class='$my_class' AND pending=1 ".$chapter_data.$ps;
// echo $sql;
// exit();
$sss = mysqli_query($db,$sql);

$array = '';
while ($row = mysqli_fetch_array($sss)) {
$array .= ','.$row['id'];
}
$array = substr($array, 1);
$all = explode(",", $array);

$max = count($all);

$m='';

$p=$max;

for ($i=0; $i <$p ; $i++) { 
	$m.=",".'0';
}
$m = substr($m, 1);
$m = explode(",", $m);
$need = $limit;
$cnt=0;
$myArray=[];
while(true) { 
	$s=rand(0,$max-1);
	if($m[$s]==0)
	{
		$myArray[$cnt]=$all[$s];
		$m[$s]=$all[$s];
		$cnt++;
	}
	if($cnt==$need) break; 
}
$main_array = $myArray;


$str = "";
for ($i=0; $i < count($main_array); $i++) { 
	$str .= ",".$main_array[$i];
}
$str = substr($str, 1);

if (mysqli_num_rows($sss)==0) {
	$main_array = [];
}
if (mysqli_num_rows($sss)<$limit) {
	$main_array = [];
}
if (count($main_array)==0) {
	?>
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">	<span style="color: tomato;">No Question Found</span>
</div>
<?php
}
else if (count($main_array)<$limit) {
	?>
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">	<span style="color: tomato;">Unable to create exam due to insufficient Questions. </span>
</div>
<div class="part_question DetailedQuestion" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">
	Total Question: <?php echo mysqli_num_rows($sss); ?>  <br>
	<span style="color: tomato;">Please try with different filter</span>
</div>

<?php
exit();
} else {
$sql = "SELECT * FROM user WHERE user_name='$user_name'";
$o = mysqli_query($db,$sql);
$eo = mysqli_fetch_array($o);
if ($eo['balance']>0) {
$sql = "UPDATE user SET balance=balance-1 WHERE user_name='$user_name'";
mysqli_query($db,$sql);
} else {
	?>
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">	<span style="color: tomato;">Not enough exams available in your account. <a href="<?php get_domain("/buy.php") ?>">Buy Exam Now</a></span>
</div>
<?php
	exit();
}

}
$i = 0;
?>

<?php 
if (count($main_array)==0) {
	?>
<div class="part_question DetailedQuestion" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">
	Total Question: <?php echo count($main_array); ?>  <br>
	<span style="color: tomato;">Please try with different filter</span>
</div>
<?php
} else {
	?>
<div class="part_question DetailedQuestion" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">
<div style="text-align: center; font-size: 20px">Total Question: <?php echo count($main_array); ?>  </div><br>
	<div style="color: tomato;">* For each correct answer will add +1.0 score and incorrect answer will deduct -1.0 score</div>
	<div style="color: tomato;">* For each second, score 0.0002 will be deducted after submitting the questionset.</div>
</div>
<style>
.timer {
	background: url("image/ani_back.gif") 0 0 / 100% !important;
	padding: 5% !important;
	font-size: 30px;
	color: white;
	text-shadow: 2px 1px 1px #37E5FF;
	top: 0;
	position: sticky;
}
.timer span {
	color: yellow;
}
.fr-fic {
	max-width: 100% !important;
}
</style>
<script>
	var interval = null;
	$(document).ready(function() {
		interval = setInterval(updateDiv<?php echo $rsonodn = rand() ?>d,1000);
	});

function updateDiv<?php echo $rsonodn; ?>d(){
	$.ajax({
		url: '<?php get_domain("/ajax/extra/time_counter_3.php") ?>',
		type: 'GET',
		data: {time: '<?php echo (time()+(60*(count($main_array)))) ?>'},
	})
	.done(function(data) {
		$(".timestamp<?php echo $fo = rand(); ?>").html(data);
		if ( $.trim(data)=="Exam Has Finished") {
	clearInterval(interval);
$(".doonfsd<?php echo $fod = rand(); ?>").click();
					$("#loader").show('fast');
$("#loader .text").html("Your Result is Proccessing");
setTimeout(function(){
			$("#loader").fadeOut(400);
			},2000);
		}
	});
}
</script>
<div class="timer" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 900px;">
	Time: <span class="timestamp<?php echo $fo ?>"></span>
</div>
	<?php
} ?>

<div class="ak245">
	
<?php
for ($i=0; $i < count($main_array); $i++) { 
	$ids = $main_array[$i];
	$sql = "SELECT * FROM question WHERE id='$ids' AND pending=1";
	$go = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($go);
?>
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">

	<h3><span style="float:left;"><?php echo $i+1 ?>.</span> &nbsp;<?php echo $row["question"] ?></h3>

	<div class="input_party">
		<strong>
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i+1 ?>" value="1" id="question1<?php echo $i+1 ?>"></td>
				<td><label for="question1<?php echo $i+1 ?>">&nbsp;<?php echo $row['opt1'] ?></label></td>
			</tr>
			</table>
		</strong>
		<strong>
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i+1 ?>" value="2" id="question2<?php echo $i+1 ?>"></td>
				<td><label for="question2<?php echo $i+1 ?>">&nbsp;<?php echo $row['opt2'] ?></label></td>
			</tr>
			</table>
		</strong>
		<strong>
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i+1 ?>" value="3" id="question3<?php echo $i+1 ?>"></td>
				<td><label for="question3<?php echo $i+1 ?>">&nbsp;<?php echo $row['opt3'] ?></label></td>
			</tr>
			</table>
		</strong>
		<strong>
			<input type="hidden" name="id<?php echo $i+1 ?>" value="<?php echo $row['id'] ?>">
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i+1 ?>" value="4" id="question4<?php echo $i+1 ?>"></td>
				<td><label for="question4<?php echo $i+1 ?>">&nbsp;<?php echo $row['opt4'] ?></label></td>
			</tr>
			</table>
		</strong>
	</div>
</div>
	<?php
}
if (count($main_array)!=0) {
	?>
<div class="part_question" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 900px;">
	<input type="hidden" name="time" value="<?php echo time(); ?>">
	<input type="hidden" name="as" value="<?php echo  count($main_array); ?>">
	<input type="hidden" name="rand" value="<?php echo $str; ?>">
	<input type="submit" style="padding: 10px 0px;text-decoration: none;display: block;font-size: 20px;width: 104%;margin-left: -2%;background: #20b99d; color: white !important;" class="cd_button doonfsd<?php echo $fod ?>" name="submit" value="Submit">
</div>
<?php
}
?>
</div>
</form>
<script>
$(document).ready(function() {
	$("#todays_model").submit(function(event) {
		event.preventDefault();
		$("#loader").show('fast');
		clearInterval(interval);
$("#loader .text").html("Your Result is Proccessing");
		var d = $(this).serialize();
		$.ajax({
			url: '<?php get_domain("/ajax/model/custom_ans_checker.php") ?>',
			type: 'POST',
			data: d,
		})
		.done(function(data) {
			$(".model_question").html(data);
			$("body,html").animate({
				scrollTop: 0
			},
			200);
			setTimeout(function(){
			$("#loader").fadeOut(400);
			},2000);
		});
		

	});
});
</script>