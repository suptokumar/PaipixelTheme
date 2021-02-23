<?php 
include '../extra/db.extra.php';
session_start();
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d");
$user_name = user_detail("user_name");
$sql  = "SELECT * FROM todays_model WHERE date='$date' and user='$user_name'";
$m = mysqli_query($db,$sql);
$i = 0;
while ($row = mysqli_fetch_array($m)) {
	$i++;
	?>
<div class="part_question" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 900px;">

	<h3><?php echo $i ?>. <?php echo $question = $row["question"] ?></h3>
	<div class="input_party">
		<?php 
	$real = $row['cur'];
if ($row['ans']!='') {
	$optional = $row['ans'];
	if ($row['opt'.$real]!=$optional) {
		if ($optional==$row['opt1']) {
			?>
<style>
	#squestion1<?php echo $i ?> {
		background: #FD2F2F22;
	}
</style>
			<?php
		}		if ($optional==$row['opt2']) {
			?>
<style>
	#squestion2<?php echo $i ?> {
		background: #FD2F2F22;
	}
</style>
			<?php
		}		if ($optional==$row['opt3']) {
			?>
<style>
	#squestion3<?php echo $i ?> {
		background: #FD2F2F22;
	}
</style>
			<?php
		}		if ($optional==$row['opt4']) {
			?>
<style>
	#squestion4<?php echo $i ?> {
		background: #FD2F2F22;
	}
</style>
			<?php
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
	#squestion<?php echo $real ?><?php echo $i ?> {
		background: #00CD4822;
	}
</style>
		<div id="squestion1<?php echo $i ?>">
			<table>
				<tr>
					<td>A.</td>
					<td><label for="question1<?php echo $i ?>"><?php echo $opt1 =  $row['opt1'] ?></label></td>
				</tr>
			</table>
			
		</div>
		<div id="squestion2<?php echo $i ?>">

		<table>
			<tr>
				<td>B.</td>
				<td><label for="question2<?php echo $i ?>"><?php echo $opt2 =  $row['opt2'] ?></label></td>
			</tr>
		</table>
			
		</div>
		<div id="squestion3<?php echo $i ?>">
		<table>
			<tr>
				<td>C.</td>
				<td><label for="question3<?php echo $i ?>"><?php echo $opt3 =  $row['opt3'] ?></label></td>
			</tr>
		</table>

		</div>
		<div id="squestion4<?php echo $i ?>">
			<table>
			<tr>
				<td>D.</td>
				<td><label for="question4<?php echo $i ?>"><?php echo $opt4 =  $row['opt4'] ?></label></td>
			</tr>
		</table>
			<input type="hidden" name="id<?php echo $i ?>" value="<?php echo $row["id"] ?>">
			
		</div>
	</div>
<?php 



?>
</div>
	<?php
}
	exit();
}
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
$sql  = "SELECT * FROM question WHERE  class='$my_class' AND pending=1 ORDER BY $rand DESC LIMIT 20";
$m = mysqli_query($db,$sql);
if (mysqli_num_rows($m)==0) {
	?>
<div class="part_question" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 900px;">
=	<span style="color: tomato;">No question Found</span>
</div>
<?php
}
$i = 0;
?>
<div class="part_question DetailedQuestion" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 900px;">
	Total Question: <?php echo mysqli_num_rows($m); ?>  <br>
	<span style="color: tomato;">Please Submit the Question As soon As possible for Best Result.</span>
</div>
<div class="ak245">
	
<?php
while ($row = mysqli_fetch_array($m)) {
	$i++;
	?>
<div class="part_question" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 900px;">

	<h3><span style="float:left"><?php echo $i ?>.</span> <?php echo $row["question"] ?></h3>
	<div class="input_party">
		<strong>
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i ?>" value="1" id="question1<?php echo $i ?>"></td>
				<td><label for="question1<?php echo $i ?>"><?php echo $row['opt1'] ?></label></td>
			</tr>
			</table>
		</strong>
		<strong>
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i ?>" value="2" id="question2<?php echo $i ?>"></td>
				<td><label for="question2<?php echo $i ?>"><?php echo $row['opt2'] ?></label></td>
			</tr>
			</table>
		</strong>
		<strong>
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i ?>" value="3" id="question3<?php echo $i ?>"></td>
				<td><label for="question3<?php echo $i ?>"><?php echo $row['opt3'] ?></label></td>
			</tr>
			</table>
		</strong>
		<strong>
			<input type="hidden" name="id<?php echo $i ?>" value="<?php echo $row['id'] ?>">
			<table>
			<tr>
				<td><input type="radio" name="question<?php echo $i ?>" value="4" id="question4<?php echo $i ?>"></td>
				<td><label for="question4<?php echo $i ?>"><?php echo $row['opt4'] ?></label></td>
			</tr>
			</table>
		</strong>
	</div>
</div>
	<?php
}
if (mysqli_num_rows($m)!=0) {
	?>
<div class="part_question" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 900px;">
	<input type="hidden" name="time" value="<?php echo time(); ?>">
	<input type="hidden" name="as" value="<?php echo  mysqli_num_rows($m); ?>">
	<input type="hidden" name="rand" value="<?php echo $pw_rand; ?>">
	<input type="submit" class="button button_standard" name="submit" value="Submit">
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
			url: '<?php get_domain("/ajax/model/ans_checker.php") ?>',
			type: 'POST',
			data: d,
		})
		.done(function(data) {
			$(".model_question").html(data);
			$("body,html").animate({
				scrollTop: 0
			},
			200);
		});
		

	});
});
</script>