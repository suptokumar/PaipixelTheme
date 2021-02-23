<?php
include '../extra/db.extra.php';
session_start();
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d");
$user_name = user_detail("user_name");
$my_class = user_detail("class");
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
$sql = "SELECT * FROM `todays_model_data` WHERE data='$user_name' AND date='$date'";
$w = mysqli_query($db,$sql);
if (mysqli_num_rows($w)==0) {
$ttme = 0;
$sql = "SELECT * FROM user WHERE user_name='$user_name'";
$o = mysqli_query($db,$sql);
$eo = mysqli_fetch_array($o);
if ($eo['balance']>0) {
$sql = "UPDATE user SET balance=balance-1 WHERE user_name='$user_name'";
mysqli_query($db,$sql);
} else {
	?>
<div class="part_question" style="font-family: tahoma; padding: 1%; margin: 1% auto; max-width: 400px;">
	<h1 style="text-align: center;">Sorry !</h1>
	<h2>You don't have enough Exams. <a href="<?php get_domain("/buy.php") ?>" style="color: #009cdb">Buy Exam Now</a></h2>
</div>
<?php
	exit();
}

$sql = "INSERT INTO `todays_model_data` (`id`, `data`,`value`, `time_in_s`, `date`) VALUES (NULL, '$user_name', 'started', '0', '$date')";
mysqli_query($db,$sql);
} else {
$rw = mysqli_fetch_array($w);
$ttme = $rw['time_in_s'];
}
$sql  = "SELECT * FROM question WHERE class='$my_class' AND pending=1 AND (subject!='ইসলাম ও নৈতিক শিক্ষা' OR subject!='হিন্দু ধর্ম ও নৈতিক শিক্ষা' OR subject!='খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা' OR subject!='বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা')";
$m = mysqli_query($db,$sql);
$array = '';
while ($row = mysqli_fetch_array($m)) {
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
$need = 20;
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



if (count($main_array)==0) {
	?>
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">
	<span style="color: tomato;">No question Found</span>
</div>
<?php
}
$i = 0;
?>
<?php 
if (count($main_array)==0) {
	?>
<div class="part_question DetailedQuestion" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">
	Total Question: <?php echo count($main_array); ?>  <br>
	<span style="color: tomato;">Please Try Different way</span>
</div>
<?php
} else {
	?>
<div class="part_question DetailedQuestion" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">
	<div style="text-align: center; font-size: 20px">Total Question: <?php echo count($main_array); ?>  </div><br>
	<div style="color: tomato;">* For each correct answer will add +1.0 score and incorrect answer will deduct -1.0 score</div>
	<div style="color: tomato;">* For each second, score 0.0002 will be deducted after submitting the questionset.</div>
</div>

<div class="part_question DetailedQuestion oopt" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 900px; color: white;top: 0;
	position: sticky;">
	Spent Time : <span class="aotnoe<?php echo $dfef20 = rand() ?>"></span>
</div>
<script>
setInterval(function(){
ado<?php echo $ee4510sss = rand(); ?>ad();
},1000);

function ado<?php echo $ee4510sss ?>ad(){
	$.ajax({
	url: '<?php get_domain("/") ?>ajax/extra/time_counter_2.php',
	type: 'GET',
	data: {user: '<?php echo $user_name ?>'},
})
.done(function(data) {
	$(".aotnoe<?php echo $dfef20 ?>").html(data);
});

}
</script>
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
	<h3><span style="float:left"><?php echo $i+1 ?>.</span> <?php echo $row["question"] ?></h3>
	<div class="input_party">
		<strong>
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i+1 ?>" value="1" id="question1<?php echo $i+1 ?>"></td>
				<td><label for="question1<?php echo $i+1 ?>"><?php echo $row['opt1'] ?></label></td>
			</tr>
			</table>
		</strong>
		<strong>
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i+1 ?>" value="2" id="question2<?php echo $i+1 ?>"></td>
				<td><label for="question2<?php echo $i+1 ?>"><?php echo $row['opt2'] ?></label></td>
			</tr>
			</table>
		</strong>
		<strong>
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i+1 ?>" value="3" id="question3<?php echo $i+1 ?>"></td>
				<td><label for="question3<?php echo $i+1 ?>"><?php echo $row['opt3'] ?></label></td>
			</tr>
			</table>
		</strong>
		<strong>
			<input type="hidden" name="id<?php echo $i+1 ?>" value="<?php echo $row['id'] ?>">
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i+1 ?>" value="4" id="question4<?php echo $i+1 ?>"></td>
				<td><label for="question4<?php echo $i+1 ?>"><?php echo $row['opt4'] ?></label></td>
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
	<input type="hidden" name="time" value="<?php echo $ttme; ?>">
	<input type="hidden" name="as" value="<?php echo count($main_array); ?>">
	<input type="hidden" name="rand" value="<?php echo $str; ?>">
	<input type="submit" style="padding: 10px 0px;text-decoration: none;display: block;font-size: 20px;width: 104%;margin-left: -2%;background: #20b99d; color: white !important;" class="cd_button doonfsd<?php echo $fod ?>" name="submit" value="Submit">
</div>
<?php
}
?>
<style>
	.fr-fic {
	max-width: 100% !important;
}
</style>
