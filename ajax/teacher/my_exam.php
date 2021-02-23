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
$my_class = $_GET['class'];
if ($my_class=="Nothing") {
	echo "Please Login and Try again.";
	exit();
}
$rand = rand(0,4);
$array = '';
$subject = $_GET['subject'];
$limit = 5;
$sql  = "SELECT id FROM question WHERE class='$my_class' AND subject='$subject' AND pending=1";
$m = mysqli_query($db,$sql);
if (mysqli_num_rows($m)==0) {
	?>
<div class="part_question" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 400px;">	<span style="color: tomato;">No question Found</span>
</div>
<?php
}
else if (mysqli_num_rows($m)<$limit) {
	?>
<div class="part_question" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 400px;">	<span style="color: tomato;">Unable to Create Exam due to insufficient Question. </span>
</div>
<div class="part_question DetailedQuestion" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 400px;">
	Total Question: <?php echo mysqli_num_rows($m); ?>  <br>
	<span style="color: tomato;">Please Try different way</span>
</div>

<?php
exit();
}
$i = 0;
?>

<?php 
if (mysqli_num_rows($m)==0) {
	?>
<div class="part_question DetailedQuestion" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 400px;">
	Total Question: <?php echo mysqli_num_rows($m); ?>  <br>
	<span style="color: tomato;">Please Try different way</span>
</div>
<?php
} else {


	?>
<div class="part_question DetailedQuestion" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 400px;">
<div style="text-align: center; font-size: 20px">Total Question: <?php echo mysqli_num_rows($m); ?>  </div><br>
	<div style="color: tomato;">* For each correct answer will add +1.0 score and incorrect answer will deduct -1.0 score</div>
	<div style="color: tomato;">* For each second, score 0.0002 will be deducted after submitting the questionset.</div>
</div>
<style>
.timer {
	background: url("image/ani_back.gif") 0 0 / 100% !important;
	padding: 5% 1% !important;
	font-size: 30px;
	color: white;
	text-shadow: 2px 1px 1px #37E5FF;
}
.timer span {
	color: yellow;
}
</style>
<script>
	var interval = null;
	$(document).ready(function() {
		interval = setInterval(updateDiv,1000);
	});

function updateDiv(){
	$.ajax({
		url: '<?php get_domain("/ajax/extra/time_counter_3.php") ?>',
		type: 'GET',
		data: {time: '<?php echo (time()+(60*(mysqli_num_rows($m)))) ?>'},
	})
	.done(function(data) {
		$(".timestamp<?php echo $fo = rand(); ?>").html(data);
		if ( $.trim(data)=="Exam Has Finished") {
$(".doonfsd<?php echo $fod = rand(); ?>").click();
clearInterval(interval);
		}
	});
	
}
</script>
<div class="timer" style="font-family: tahoma; background: #68844411; padding: 1%; margin: 1% auto; max-width: 400px; font-size: 24px;text-align: center;">
	Time: <span class="timestamp<?php echo $fo ?>"></span>
</div>
	<?php
} ?>

<div class="ak245">
	
<?php
while ($row = mysqli_fetch_array($m)) {
	$i++;
$array .= ','.$row['id'];
}
$array = substr($array,1);
$all = explode(",", $array);

$max = count($all);

$m='';

$p=$max;

for ($i=0; $i <$p ; $i++) { 
	$m.=",".'0';
}
$m = substr($m, 1);
$m = explode(",", $m);
$need = 5;
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


for ($i=0; $i < count($main_array); $i++) { 
	$ids = $main_array[$i];
	$sql = "SELECT * FROM question WHERE id='$ids' AND pending=1";
	$go = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($go);
?>
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 400px;">

	<h3><span style="float:left;"><?php echo ($i+1) ?>.</span> <?php echo $row["question"] ?></h3>

	<div class="input_party">
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i+1 ?>" value="1" id="question1<?php echo $i+1 ?>"></td>
				<td><label for="question1<?php echo $i+1 ?>"><?php echo $row['currect'] ?><?php echo $row['opt1'] ?></label></td>
			</tr>
			</table>

			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i+1 ?>" value="2" id="question2<?php echo $i+1 ?>"></td>
				<td><label for="question2<?php echo $i+1 ?>"><?php echo $row['opt2'] ?></label></td>
			</tr>
			</table>

			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i+1 ?>" value="3" id="question3<?php echo $i+1 ?>"></td>
				<td><label for="question3<?php echo $i+1 ?>"><?php echo $row['opt3'] ?></label></td>
			</tr>
			</table>

			<input type="hidden" name="id<?php echo $i+1 ?>" value="<?php echo $row['id'] ?>">
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i+1 ?>" value="4" id="question4<?php echo $i+1 ?>"></td>
				<td><label for="question4<?php echo $i+1 ?>"><?php echo $row['opt4'] ?></label></td>
			</tr>
			</table>
	</div>
</div>
<?php
}


if (count($main_array)!=0) {
	?>
<div class="part_question" style="font-family: tahoma; text-align: center; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; margin: 1% auto; max-width: 400px;">
	<input type="hidden" name="time" value="<?php echo time(); ?>">
	<input type="hidden" name="as" value="<?php echo count($main_array); ?>">
	<input type="hidden" name="rand" value="<?php echo $str ?>">
	<input type="hidden" name="class" value="<?php echo $my_class ?>">
	<input type="hidden" name="subject" value="<?php echo $subject ?>">
	<input type="submit" style="padding: 10px 0px; text-decoration: none; display: block; font-size: 20px;width: 104%;margin-left: -2%;color: white !important; background: #20b99d !important" class="cd_button doonfsd<?php echo $fod ?>" name="submit" value="Submit">
</div>
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
		var d = $(this).serialize();
		$.ajax({
			url: '<?php get_domain("/ajax/teacher/my_answer_checker.php") ?>',
			type: 'POST',
			data: d,
			beforeSend:function(){
				$("#loader").fadeIn();
				$("#loader .text").html("Your Result is Getting Ready !");
			}
		})
		.done(function(data) {
			$(".model_question").html(data);
			$("body,html").animate({
				scrollTop: 0
			},
			200);
			setTimeout(function(){
				$("#loader").fadeOut(100);
			},5000);
		});
		

	});
});
</script>