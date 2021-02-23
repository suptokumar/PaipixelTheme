<div class="exam_board" style="border: 1px solid #ccc; padding: 1%; text-align: center;">
	<?php $q= $_POST['q'] ?>
	<?php $e= $_POST['exam'] ?>
<?php 
include '../extra/db.extra.php';
$page = $q;
$sql = "SELECT * FROM question WHERE exam_id='$e' AND pending=1";
$m = mysqli_query($db,$sql);
$row=mysqli_fetch_array($m);
$n = mysqli_num_rows($m);

?>
<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/exam/live_info.php',
		type: 'POST',
		data: "exam=<?php echo $e ?>",
	})
	.done(function(data) {
		$(".live_info").html(data);
	});
	
},1000);
</script>
<h2><?php echo  $row['name']; ?></h2>

<?php 	 if ($page<$n) { ?>
<h2><?php echo  $page; ?>/<?php echo  $n; ?></h2>
<div class="live_info">
<h2><?php echo date("Y-m-d H:i:s") ?></h2>
</div>
<?php } ?>
<div class="exam_box">
<div class="question_set" style="padding: 1%;max-width: 400px; text-align: left; margin: 0 auto;background: white; border: 1px solid #20b99d">




	<?php
if ($page>$n) {
	?>
<h3 style="text-align: center;">
	You Finished Your Exam. <br> Your Score: 
	<?php 
	session_start();
$user = user_detail("user_name");
$sql = "SELECT SUM(score) FROM exam_score WHERE exam='$e' AND user='$user'";
$q = mysqli_query($db,$sql);
$m = mysqli_fetch_array($q);
echo number_format($m[0],3);
	?>
</h3>
<br><br><center class="live_info">
	<p style="color: red">
Exam Result Will Publish In: 
	</p>
<div>
<h2><?php echo date("Y-m-d H:i:s") ?></h2>
</div>
</center>
	<?php
} else {
	$p = ($page-1);
$sql = "SELECT * FROM question WHERE exam_id='$e' AND pending=1 LIMIT $p,1";
$b=mysqli_query($db,$sql);
$r =mysqli_fetch_array($b);
	?>
	<style>
		label {
			display: block;
			padding: 10px;
		}
	</style>
	<style>
		label span {
			background: none !important;
			font-family: arial !important;
			font-size: auto !important;
		}
	</style>
	<h2 class="question"><h3 style="float: left"><?php echo $page ?>.</h3> <?php echo $r['question'] ?></h2>
	<form id="a<?php echo $page ?>">
		<label for="answer1">
			<table>
				<tr>
					<td>
						
<input type="radio" value="1" name="answer" id="answer1">
					</td>


					<td>
						<?php echo $r['opt1']; ?>
						
					</td>
				</tr>
			</table>
			
		</label>
		<label for="answer2">
			<table>
				<tr>
					<td>
						
<input type="radio" value="2" name="answer" id="answer2">
					</td>

					<td>
						<?php echo $r['opt2']; ?>
						
					</td>
				</tr>
			</table>
		</label>
		<label for="answer3">
			<table>
				<tr>
					<td>
						
<input type="radio" value="3" name="answer" id="answer3">
					</td>

					<td>
						<?php echo $r['opt3']; ?>
						
					</td>
				</tr>
			</table>
		</label>
		<label for="answer4">
			<table>
				<tr>
					<td>
						
<input type="radio" value="4" name="answer" id="answer4">
					</td>
					<td>
						<?php echo $r['opt4']; ?>
						
					</td>
				</tr>
			</table>
		</label>
		<input type="hidden" name="question" value="<?php echo $r['id'] ?>">
		<input type="hidden" name="time" value="<?php echo time(); ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
	<div class="button_set">
	<?php 
if ($page>=$n) {
	?>
<input class="button button_standard" type="submit" onclick="question_view(<?php echo $q+1 ?>,'<?php echo $e ?>')" value="Submit Exam" name="submit_exam">

	<?php
} else {
?>
	<input class="button button_standard" type="button" value="Skip" onclick="question_view(<?php echo $q+1 ?>,'<?php echo $e ?>')">
	<input class="button button_standard" type="submit" value="Next" onclick="question_view(<?php echo $q+1 ?>,'<?php echo $e ?>')">

	<?php
}
}
	?>
</div>
	</form>
	<script>
		$(document).ready(function() {
			$("#a<?php echo $page ?>").submit(function(event) {
				event.preventDefault();
				var ans = $(this).serialize();
				$.ajax({
					url: '<?php get_domain("/") ?>ajax/exam/answer_checker.php',
					type: 'POST',
					data: ans,
				})
				.done(function(data) {
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			});
		});
	</script>
</div>
<style>
	.fr-fic {
	max-width: 100% !important;
}
</style>
</div>
</div>
<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/exam/live_result.php',
		type: 'POST',
		data: "exam=<?php echo $e ?>",
	})
	.done(function(data) {
		$(".live_score").html(data);
	});
	
},1000);
</script>
<div class="exam_board live_score" style="width: 40%">
<table class="data_table">
	<tr>
	<th>ID</th>
	<th>User Name</th>
	<th>Ratings</th>
	<th>Score</th>
	</tr>
	<?php 
$sql = "SELECT * FROM exam_score WHERE exam='$e' GROUP BY user ORDER BY score DESC";
$m = mysqli_query($db,$sql);
$id = 1;
while ($row=mysqli_fetch_array($m)) {
$my_score = 0;
$user_name = $row['user'];
$sql = "SELECT * FROM exam_score WHERE exam='$e' AND user='$user_name'";
$o = mysqli_query($db,$sql);
while ($r = mysqli_fetch_array($o)) {
	$my_score += $r['score'];
}
?>
	<tr>
		<td style="font-family: arial;"><?php echo $id ?></td>
		<td style="font-family: arial;"><?php echo $row['user'] ?></td>
		<td style="font-family: arial;"><?php echo more_user("rating",$row['user']) ?></td>
		<td style="font-family: arial;"><?php echo $my_score ?></td>
	</tr>
<?php 
$id++;
}
	?>
</table>
</div>
<style>
	.exam_board {
		float: left;
		padding: 0% 1%;
		width: 50%;
	}
	.area_content {
		overflow: hidden;
	}
	@media(max-width: 708px)
	{
		.exam_board {
			width: 100% !important;
		}
	}
</style>