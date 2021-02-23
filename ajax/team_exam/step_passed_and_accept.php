<?php 
include '../extra/db.extra.php';

// acceptable team
$id = $_POST['team'];
$member = $_POST['member'];
$token = $_POST['token'];


//my details
session_start();
$team = user_detail("team");
$token = str_replace("sc","", $token);
$token = explode(" ", $token);
$cl = "";
$user = "";
for ($i=0; $i < count($token); $i++) { 
	$user .= $_POST['user_id'.$token[$i]];
	$cl .= ','.$token[$i];
	$user .= member_by_id($user);
	if (($i+1) != count($token)) {
		$user .= ",";
	}
}
$sql = "UPDATE `team_chal` SET accept_id='1' WHERE id='$id'";
mysqli_query($db,$sql);
$sql = "INSERT INTO `team_chal` (`team`, `member`,`parent`, `accept_id`) VALUES ('$team', '$cl', '$id', '1')";
if (mysqli_query($db,$sql)) {
	$sql = "SELECT * FROM team_chal WHERE id='$id'";
	$m = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($m);
?>
<h2 class="heading_title">Challenge Accepted !</h2>
<div class="description">
	Exam will start at: <?php echo date("h:i a, d M Y", strtotime($row['date'])); ?>
	<br>
	The users( <?php  echo $user ?>) are now able to add questions. (Go to My Account > My Team > Challanges)
<br>
<h3 style="color: red">Study Hard, Time is runing...</h3>
<div class="timer"></div>
	<script>
		setInterval(function(){
			$.ajax({
				url: "<?php get_domain("/"); ?>ajax/extra/time_runner.php",
				type: "GET",
				data: 'time=<?php echo $row['date'] ?>',
				success:function(daa){
					$(".timer").html(daa);
				}
			});
		},1000);

	</script>
</div>
<?php
} else {
?>
Proccess Failed !
<?php
}
?>