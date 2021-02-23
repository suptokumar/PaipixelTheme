<?php 
include '../extra/db.extra.php';
$first = $_GET['first'];
$second = $_GET['second'];
$sql = "SELECT * FROM `team_rating_change` WHERE chal_id='$first'";
$m = mysqli_query($db,$sql);
$row = mysqli_fetch_array($m);
if (mysqli_num_rows($m)==0) {
	echo "<h2 style='text-align:center;'>Result Not Published !</h2>";
	exit();
} else {
$pre_rating = $row['pre_rating'];
$now_rating = $row['now_rating'];
$team = $row['team'];
}
session_start();
$sql = "SELECT * FROM `team_rating_change` WHERE chal_id='$second'";
$m = mysqli_query($db,$sql);
$row = mysqli_fetch_array($m);
if (mysqli_num_rows($m)==0) {
	echo "<h2 style='text-align:center;'>Result Not Published !</h2>";
	exit();
} else {
$pre_rating2 = $row['pre_rating'];
$now_rating2 = $row['now_rating'];
$team2 = $row['team'];
}
?>
<style>
.ast {
	background: linear-gradient(#20b99b, #22b99d);
	overflow: hidden;
	color: white;
	padding: 2%;
}
.ast h2{
	width: 30%;
	text-align: center;
	float: left;
	background: none;
}
</style>
<div class="mains" style="margin: 1% auto; max-width: 500px;">
	<div class="ast" style="overflow: hidden;">
		<h2><?php echo get_team($team) ?></h2>
		<h2>Vs</h2>
		<h2><?php echo get_team($team2) ?></h2>
	</div>
	<div class="st" style=" color: #20d99b;font-size: 40px;text-align: center;font-weight: bold; text-shadow: 2px -2px 1px #ccc">
		<?php if (user_detail("team")==$team) {
			echo "Victory";
		} ?>
		<?php if (user_detail("team")==$team2) {
			echo "Defeat";
		} ?>
		<?php if (user_detail("team")!=$team && user_detail("team")!=$team2) {


			 $sql = "SELECT SUM(score) FROM `team_score` WHERE chal='$first'";
	$q = mysqli_query($db,$sql); $rg = mysqli_fetch_array($q); echo arial(number_format($rg[0],3));
echo arial("  |  ");			 $sql = "SELECT SUM(score) FROM `team_score` WHERE chal='$second'";
	$q = mysqli_query($db,$sql); $rg = mysqli_fetch_array($q); echo arial(number_format($rg[0],3));



		} ?>
		<div class="st" style="color: black; font-size: 20px; text-shadow: none;">
			<h3 style="color: #21b99c">
				<?php if (user_detail("team")==$team || user_detail("team")==$team2) {


			 $sql = "SELECT SUM(score) FROM `team_score` WHERE chal='$first'";
	$q = mysqli_query($db,$sql); $rg = mysqli_fetch_array($q); echo arial(number_format($rg[0],3));
echo arial("  |  ");			 $sql = "SELECT SUM(score) FROM `team_score` WHERE chal='$second'";
	$q = mysqli_query($db,$sql); $rg = mysqli_fetch_array($q); echo arial(number_format($rg[0],3));



		} ?>
			</h3>
		Team <a style="text-decoration: none;" href="<?php get_domain("/team/") ?><?php echo $team ?>"><span id="team520" style="color: #20d99b;"><?php echo get_team($team) ?></span></a> Won
		</div>
		<!-- <h2>Congratulation</h2> -->
	</div>









	<table class="data_table ">
		<tr>
			<th>Team</th>
			<th>Previous Rating</th>
			<th>New Rating</th>
		</tr>
		<tr>
			<td><a style="text-decoration: none;" href="<?php get_domain("/team/") ?><?php echo $team ?>"><?php echo get_team($team) ?></a></td>
			<td><?php echo $pre_rating ?></td>
			<td><?php echo $now_rating ?></td>
		</tr>
		<tr>
			<td><a style="text-decoration: none;" href="<?php get_domain("/team/") ?><?php echo $team2 ?>"><?php echo get_team($team2) ?></a></td>
			<td><?php echo arial($pre_rating2) ?></td>
			<td><?php echo arial($now_rating2) ?></td>
		</tr>
	</table>

	<div class="ans_table">
		<?php 
// GET the First users
		$sql =  "SELECT * FROM team_chal WHERE id='$first'";
		$m = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($m);
		$users1 = explode(",",substr(($row['member']),1));
// GET the Second users
		$sql =  "SELECT * FROM team_chal WHERE id='$second'";
		$m = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($m);
		$users2 = explode(",",substr(($row['member']),1));


		for ($i=0; $i < count($users1); $i++) { 
			?>
<div class="answer_text">
	<a href="<?php get_domain("/profile/").ucfirst(member_by_id($users1[$i])) ?>"><?php echo ucfirst(member_by_id($users1[$i])) ?></a> and <a href="<?php get_domain("/profile/") ?><?php echo ucfirst(member_by_id($users2[$i])) ?>"><?php echo ucfirst(member_by_id($users2[$i])) ?></a> answered each others Question. <button style="padding: 4px; border: 1px solid #ccc; cursor: pointer;    background: #00fff3;
    box-shadow: 1px 1px 2px 1px #ccc;" onclick="view410('<?php echo $first ?>','<?php echo ucfirst(member_by_id($users1[$i])) ?>','<?php echo $second ?>','<?php echo ucfirst(member_by_id($users2[$i])) ?>')">View Answersheet</button>
</div>
			<?php
			
		}
		?>
	</div>
	<style>
		
.ans_table div{
  border: 1px solid #ccc;
  padding: 10px;
  margin-top: 10px;
  color: blueviolet;
  font-family: cursive;
  font-weight: 100;
}
.ans_table div a{
  color: green;
  text-decoration: none;
  font-family: arial;
  font-size: 17px;
  font-weight: bold;
}
	</style>
	<div class="det" style="display: none;"></div>
	<script>
		function view410(first,user1,second,user2)
		{
			$.ajax({
				url: '<?php get_domain("/ajax/team_exam/question_view.php") ?>',
				type: 'POST',
				data: {first: first,user1: user1,second: second,user2: user2},
			})
			.done(function(data) {
				$(".det").html(data);
				$(".det").dialog({
					open: true,
					modal: true,
					title: "Question "+ user1+" Vs "+user2,
					show: "explode",
					hide:"scale",
					width:"auto",
					buttons:{
						"close":function()
						{
							$(this).dialog("close");
						}
					}
				});
			});
			
		}
	</script>
</div>