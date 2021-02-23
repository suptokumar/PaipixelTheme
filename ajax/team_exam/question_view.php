<?php 
include '../extra/db.extra.php';
$first = $_POST['first'];
$second = $_POST['second'];
$user1 = $_POST['user1'];
$user2 = $_POST['user2'];
$sql = "SELECT *"
?>
<div style="overflow: hidden;">
<div class="marging" style="float:left; width: 320px; max-width: 500px;">
	<?php

$sql = "SELECT SUM(score) FROM team_score WHERE user='$user1' AND chal='$first' AND question='Auto Mark'";
$m = mysqli_query($db,$sql);
$rands= mysqli_fetch_array($m);

$sql = "SELECT SUM(score) FROM team_score WHERE user='$user1' AND chal='$first'";
$m = mysqli_query($db,$sql);
$rand = mysqli_fetch_array($m);
echo $user1."'s score: ".number_format($rand[0],3)."(Auto Mark:".number_format($rands[0],2).")";
$sql = "SELECT * FROM team_score WHERE user='$user1' AND chal='$first' AND question!='Auto Mark'";
$m = mysqli_query($db,$sql);
$rand = mysqli_num_rows($m);
for($i=0; $i<($rand);$i++) {
	$row=mysqli_fetch_array($m);
	$id = $row['id'];
	?>
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 400px;text-align: left;">
	<h3><span style="float:left"><?php echo $i+1 ?>.</span> <?php echo $question = $row["question"] ?></h3>
	<div class="input_party">
		<?php 
	$real = $row['cur'];
if ($row['ans']!='') {
	
?>

		<?php
?>

<?php
} else {
	echo "<span style='color: red'>Not Submited</span>"; br();
	$optional = '';
}
		?>
		<?php $rn = rand(); ?>

<style>
	#squestion<?php echo $rn ?><?php echo $real ?><?php echo $i+1 ?> {
		background: #00CD4822 !important; /* <?php echo $i ?> */
	}
	#squestion<?php echo $rn ?><?php echo $row['ans']; ?><?php echo $i+1 ?> {
		background: #FF9D7170;/* <?php echo $i ?> */
	}
</style>
		<div id="squestion<?php echo $rn ?>1<?php echo ($i+1) ?>">
			<table>
				<tr>
					<td>A.</td>
					<td><label for="question1<?php echo ($i+1) ?>"><?php echo $opt1 =  $row['opt1'] ?></label></td>
				</tr>
			</table>
			
		</div>
		<div id="squestion<?php echo $rn ?>2<?php echo ($i+1) ?>">

		<table>
			<tr>
				<td>B.</td>
				<td><label for="question2<?php echo ($i+1) ?>"><?php echo $opt2 =  $row['opt2'] ?></label></td>
			</tr>
		</table>
			
		</div>
		<div id="squestion<?php echo $rn ?>3<?php echo ($i+1) ?>">
		<table>
			<tr>
				<td>C.</td>
				<td><label for="question3<?php echo ($i+1) ?>"><?php echo $opt3 =  $row['opt3'] ?></label></td>
			</tr>
		</table>

		</div>
		<div id="squestion<?php echo $rn ?>4<?php echo ($i+1) ?>">
			<table>
			<tr>
				<td>D.</td>
				<td><label for="question4<?php echo ($i+1) ?>"><?php echo $opt4 =  $row['opt4'] ?></label></td>
			</tr>
		</table>
			<input type="hidden" name="id<?php echo ($i+1) ?>" value="<?php echo $row["id"] ?>">
		</div>
		
	</div>

</div>
	<?php
}



?>






</div>






<div class="marging" style="float:left; width: 320px; max-width: 500px;">
	<?php
$sql = "SELECT SUM(score) FROM team_score WHERE user='$user2' AND chal='$second' AND question='Auto Mark'";
$m = mysqli_query($db,$sql);
$rands= mysqli_fetch_array($m);

$sql = "SELECT SUM(score) FROM team_score WHERE user='$user2' AND chal='$second'";
$m = mysqli_query($db,$sql);
$rand = mysqli_fetch_array($m);

echo $user2."'s score: ".number_format($rand[0],3)."(Auto Mark:".number_format($rands[0],2).")";
$sql = "SELECT * FROM team_score WHERE user='$user2' AND chal='$second' AND question!='Auto Mark'";
$m = mysqli_query($db,$sql);
$rand = mysqli_num_rows($m);
for($i=0; $i<($rand);$i++) {
	$row=mysqli_fetch_array($m);
	$id = $row['id'];
	?>
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 400px;text-align: left;">
	<h3><span style="float:left"><?php echo $i+1 ?>.</span> <?php echo $question = $row["question"] ?></h3>
	<div class="input_party">
		<?php 
	$real = $row['cur'];
if ($row['ans']!='') {
	
?>

		<?php
?>

<?php
} else {
	echo "<span style='color: red'>Not Submited</span>"; br();
	$optional = '';
}
		?>
		<?php $rn = rand(); ?>

<style>
	#squestion<?php echo $rn ?><?php echo $real ?><?php echo $i+1 ?> {
		background: #00CD4822 !important; /* <?php echo $i ?> */
	}
	#squestion<?php echo $rn ?><?php echo $row['ans']; ?><?php echo $i+1 ?> {
		background: #FF9D7170;/* <?php echo $i ?> */
	}
</style>
		<div id="squestion<?php echo $rn ?>1<?php echo ($i+1) ?>">
			<table>
				<tr>
					<td>A.</td>
					<td><label for="question1<?php echo ($i+1) ?>"><?php echo $opt1 =  $row['opt1'] ?></label></td>
				</tr>
			</table>
			
		</div>
		<div id="squestion<?php echo $rn ?>2<?php echo ($i+1) ?>">

		<table>
			<tr>
				<td>B.</td>
				<td><label for="question2<?php echo ($i+1) ?>"><?php echo $opt2 =  $row['opt2'] ?></label></td>
			</tr>
		</table>
			
		</div>
		<div id="squestion<?php echo $rn ?>3<?php echo ($i+1) ?>">
		<table>
			<tr>
				<td>C.</td>
				<td><label for="question3<?php echo ($i+1) ?>"><?php echo $opt3 =  $row['opt3'] ?></label></td>
			</tr>
		</table>

		</div>
		<div id="squestion<?php echo $rn ?>4<?php echo ($i+1) ?>">
			<table>
			<tr>
				<td>D.</td>
				<td><label for="question4<?php echo ($i+1) ?>"><?php echo $opt4 =  $row['opt4'] ?></label></td>
			</tr>
		</table>
			<input type="hidden" name="id<?php echo ($i+1) ?>" value="<?php echo $row["id"] ?>">
		</div>

	</div>

</div>
	<?php
}



?>
</div>
</div>