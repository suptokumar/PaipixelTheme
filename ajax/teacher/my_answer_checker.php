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

$anst = '';

for ($i=0; $i < $as; $i++) { 
	if (isset($_POST['question'.($i+1)])) {
		$ans = $_POST['question'.($i+1)];
		$anst .= ",".$ans;
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
	#squestion<?php echo $ans ?><?php echo $i+1 ?> {
		background: #FF6B6F;
	}
</style>
<?php
}

}
?>
<div class="part_question DetailedQuestion" style="font-family: tahoma; text-align: center; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 400px;">

<?php
echo "Total Questions: ". $as; br();
echo "Total Correct: ". $curss; br();
echo "Your Score: <span>". $curs."</span>"; br();
echo "Your Accuracy: <span>".  $aacc = ((($curs)*100)/($as))."%</span>";
br();
$sql = "SELECT * FROM teachers_qualifications WHERE user='$user'";
$sdb = mysqli_query($db,$sql);
$rowndon = mysqli_num_rows($sdb);
if ($rowndon==0) {
	$rowndon=1;
}
$total_ac = 0;
while ($row = mysqli_fetch_array($sdb)) {
$total_ac += (($row['score'])*100)/($row['total']);
}
$prev_ac = (($total_ac)/($rowndon));



$user = user_detail("user_name");
$anst = substr($anst, 1);
$date = date("Y-m-d H:i:s");
$class = $_POST['class'];
$rand = $_POST['rand'];
$subject = $_POST['subject'];
$sql = "SELECT * FROM teachers_qualifications WHERE user='$user' AND class='$class' AND subject='$subject' AND qualify=1 GROUP BY score DESC";
$d10 = mysqli_query($db,$sql);

$qul = 1;
$rating_c = 1;

if ($aacc>69) {
if (mysqli_num_rows($d10)!=0) {
$scoremmat = mysqli_fetch_array($d10);
$scoremma = ($scoremmat['score']*100)/($scoremmat['total']);
$idttt = $scoremmat['id'];
if ($scoremma>$aacc) {
// echo "Ager ta boro.";
$qul = 0;
$rating_c = 0;
} else {
// echo "Porer ta boro.";
$sql = "UPDATE teachers_qualifications SET qualify=0 WHERE id='$idttt'";
mysqli_query($db,$sql);
$qul = 1;
$rating_c = 1;
}

}
} else {
$qul = 0;
$rating_c = 0;
}

$sql = "INSERT INTO `teachers_qualifications` (`id`, `q_id`, `score`, `class`, `subject`, `date`, `user`, `correct`, `total`, `answer`, `qualify`) VALUES (NULL, '$rand', '$curs', '$class', '$subject','$date', '$user', '$curss', '$as',  '$anst',  '$qul') ";
mysqli_query($db,$sql);

br();
echo "Previous AA: <span>". user_detail("rating")."%</span>";


$sql = "SELECT * FROM teachers_qualifications WHERE user='$user' AND qualify=1 ORDER BY score DESC";
$sdb = mysqli_query($db,$sql);
$rowndon = mysqli_num_rows($sdb);
if ($rowndon==0) {
	$rowndon=1;
}
$total_ac = 0;
while ($row = mysqli_fetch_array($sdb)) {
$total_ac += (($row['score'])*100)/($row['total']);
}
$now_ac = (($total_ac)/($rowndon));

br();


echo "Current AA: <span>". ($now_ac)."%</span>";

if ($rating_c==1) {
$sql = "UPDATE user SET rating='$now_ac',isnew=1 WHERE user_name='$user'";
mysqli_query($db,$sql);
}

if ($aacc>69) {

if(mysqli_num_rows($d10)==0)
{
echo "<p style='color: #1ac81a; font-size: 17px; text-shadow: none;font-weight: bold;'>Contratulation! You have added a new subject as your Qualification.</span></p> ";
} else {

}

} else {
echo "<p style='color: red; font-size: 17px; text-shadow: none; font-weight: bold;'>Unfortunately you are disqualified due to less then 70% Accuracy. Don't worry your AA won't be affected.</p> ";
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
	?>
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 400px;">
	<h3><span style="float:left"><?php echo $i+1 ?>.</span> <?php echo $question = $row["question"] ?></h3>
	<div class="input_party">
		<?php 
	$real = $row['currect'];
if (isset($_POST['question'.($i+1)])) {
	$optional = $_POST['question'.(($i+1))];
	if ($row['opt'.$real]!=$optional) {
		if ($optional==$row['opt1']) {
			?>
<style>
	#squestion1<?php echo ($i+1) ?> {
		background: #FD2F2F22;
	}
</style>
			<?php
		}		if ($optional==$row['opt2']) {
			?>
<style>
	#squestion2<?php echo ($i+1) ?> {
		background: #FD2F2F22;
	}
</style>
			<?php
		}		if ($optional==$row['opt3']) {
			?>
<style>
	#squestion3<?php echo ($i+1) ?> {
		background: #FD2F2F22;
	}
</style>
			<?php
		}		if ($optional==$row['opt4']) {
			?>
<style>
	#squestion4<?php echo ($i+1) ?> {
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
}

?>