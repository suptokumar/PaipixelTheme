
<style>
.onodnoadf {
	background: url("image/ani_back.gif") 0 0 / 100% !important;
	padding: 5% !important;
	font-size: 30px;
	color: white;
	text-shadow: 2px 1px 1px #37E5FF;
}
.oopt {
	background: url("image/ani_back.gif") 0 0 / 100% !important;
	padding: 5% !important;
	font-size: 20px;
	color: white;
	text-shadow: 2px 1px 1px #37E5FF;
}
.oopt span {
	color: yellow;
}
label {
	cursor: pointer;
}
</style>
<?php 
include '../extra/db.extra.php';
session_start();
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d");
$user_name = user_detail("user_name");
$sql = "SELECT * FROM todays_model WHERE date='$date' and user='$user_name'";
$s = mysqli_query($db,$sql);
if (mysqli_num_rows($s)!=0) {
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
$ct = 0;
$sod = 0;
$as = mysqli_num_rows($s);
while ($fc = mysqli_fetch_array($s)) {
if ($fc['cur']==$fc['ans']) {
		$ct+=1;
	}
	$sod = $fc['score'];
}
?>
<div class="part_question DetailedQuestion onodnoadf" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 900px;">

<?php
echo "Total Questions: ". $as; br();
echo "Total Correct: ". $ct; br();
echo "Your Score: <span>". number_format($sod,3)."</span>";
?>
</div>
<?php
$sql  = "SELECT * FROM todays_model WHERE date='$date' and user='$user_name'";
$m = mysqli_query($db,$sql);
$i = 0;
while ($row = mysqli_fetch_array($m)) {
	$i++;
	?>
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 900px;text-align: left;">

	<h3><span style="float:left"><?php echo $i ?>.</span> <?php echo $question = $row["question"] ?></h3>
	<div class="input_party">
		<?php 
	$real = $row['cur'];
if ($row['ans']!='') {
	$optional = $row['ans'];
	if ($row['opt'.$real]!=$optional) {
		if ($optional==$row['opt1']) {
			
		}
	}
?>


<?php
} else {
	echo "<span style='color: red'>Not Submited</span>"; br();
	$optional = '';
}
		?>
<style>
	#squestion<?php echo $real ?><?php echo $i ?> {
		background: #00CD4822 !important; /* <?php echo $i ?> */
	}
	<?php if($row['ans']!=''){ ?>
	#squestion<?php echo $row['ans']; ?><?php echo $i ?> {
		background: #FF9D7170;/* <?php echo $i ?> */
<?php } ?>
	}
</style>
		<div id="squestion1<?php echo $i ?>">
			<table>
				<tr>
					<td><?php echo translate("A") ?>.</td>
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
			<input type="hidden" name="id<?php echo $i ?>" value="<?php echo $row["id"] ?>">
			<table>
				<tr>
					<td>D.</td>
					<td><label for="question4<?php echo $i ?>"><?php echo $opt4 =  $row['opt4'] ?></label></td>
				</tr>
			</table>
		</div>
	</div>
			<div style="overflow: hidden;">
		<a href="javascript:void(0)" data-open='1' onclick="ausodn(this,<?php echo $row['id'] ?>)" style="color: #009cdb; float: right; margin: 10px;">Audio Explaination</a>
		<a href="javascript:void(0)" data-open='1' onclick="ttser(this,<?php echo $row['id'] ?>)" style="color: #009cdb; float: right; margin: 10px;">View Explaination</a> 
		</div>
		<div class="explain explain_<?php echo $row['id'] ?>" style="display: none;">
			<?php $id=$row['question_id']; $sql = "SELECT * FROM question WHERE id='$id' AND pending=1"; $s = mysqli_query($db,$sql); $r = mysqli_fetch_array($s); echo $r['details'] ?>
		</div>
		<div class="explain audio_<?php echo $row['id'] ?>" style="display: none;">
			<?php echo $r['audio_explain'] ?>
		</div>

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
?>
<div class="apply_question" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 900px; text-align: center;">
	<a class="button ad_button adfawedfg0sd" style="display: block;" href="javascript:void(0)">Start Exam</a>
</div>
</div>
</form>
<script>
$(document).ready(function() {
	$(".adfawedfg0sd").click(function(event) {
$("#loader").show('fast');
$("#loader .text").html("Preparing your Exam");
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/model/todays_model_content.php',
		})
		.done(function(data) {
			$(".apply_question").html(data);
			setTimeout(function(){
			$("#loader").fadeOut(400);
			},2000);
		});
	});
});
</script>
<script>
$(document).ready(function() {
	$("#todays_model").submit(function(event) {
		event.preventDefault();
		$("#loader").show('fast');
$("#loader .text").html("Your Result is Proccessing");
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
			setTimeout(function(){
			$("#loader").fadeOut(400);
			},2000);
		});
	});
});
</script>