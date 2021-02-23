<?php 
include 'ajax/db_back.php';
function get_aside($item="all")
{
if ($item=="upcoming_exams" || $item=="all") {

?>



<aside>
	<h2 class="caption">Upcoming Exam</h2>
	<div class="side_content">
		<ul class="paipixel_exam">
			<?php 
global $db;
$sql = "SELECT * FROM question WHERE exam_starting_date > CURRENT_TIME AND pending=1 GROUP BY exam_id ORDER BY class,id DESC LIMIT 20";
if (isset($_SESSION['login_data_paipixel24'])) {
	$class = user_detail("class");
	$sql = "SELECT * FROM question WHERE exam_starting_date > CURRENT_TIME AND pending=1 GROUP BY exam_id ORDER BY CASE WHEN class='$class' THEN 1 ELSE 2 END, class ASC LIMIT 20";
}
$q = mysqli_query($db,$sql);
if (mysqli_num_rows($q)==0) {
	echo "<h3 style='font-weight: 100; text-align: center; padding: 10px'>No Live Exam Found</h3>";
}
while ($row = mysqli_fetch_array($q)) {
$exam_id = $row['exam_id'];
$class = $row['class'];
if ($class=='') {
	$class = "All Classes";
}
				?>
<li id="ad<?php echo $exam_id; ?>">
		<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/ajax/exam/upcoming_exam.php?version=") ?><?php echo rand(); ?>',
		type: 'POST',
		data: 'date=<?php echo $row['exam_starting_date']; ?>'+'&exam=<?php echo $row['exam_id']; ?>'
	})
	.done(function(data) {
		$("#s<?php echo $exam_id; ?>").html(data);
	});
	
},1000);
</script>
<h3 class="exam_name"><a href="javascript:void(0)" onclick="exam_details('<?php echo $row['exam_id']; ?>')"><?php echo $row['name']; ?></a></h3>
<div class="registery_settings" id="s<?php echo $exam_id; ?>">
	<span class="time_bar exam_register"><?php echo def_time($row['exam_starting_date']); ?></span>
	<a href="javascript:void(0)" onclick="register_exam('<?php echo $exam_id ?>',this);" class="time_bar exam_register">Register</a>
</div>
</li>
				<?php
			}
?>
		</ul>

	</div>
<?php 
if (mysqli_num_rows($q)>19) {
	echo "<div style='overflow: hidden'><a style='float:right; padding: 10px' href='".return_domain("/exams")."'>View All</a></div>";
}
 ?>
</aside>
<?php } 
if ($item=="upcoming_team_exams" || $item=="all") {
?>
<aside>
	<h2 class="caption">Upcoming Team Exam</h2>
	<div class="side_content">
<div>
	<table class="func_table table_hoverable full_border attabe sweet_table">
		<tr>
			<th>Challenge Name</th>
			<th>Class / Subject</th>
			<th>Chapter</th>
			<th>Exam Time</th>
			<th>Options</th>
<?php 
$sql= "SELECT * FROM team_chal WHERE date>CURRENT_TIME AND parent=0 AND accept_id=0 ORDER BY id DESC LIMIT 20";
$m = mysqli_query($db,$sql);
if (mysqli_num_rows($m)==0) {
?>
<tr>
	<td colspan="6" style="font-family: cursive;column-rule-width: 6;">No challenges Found</td>
</tr>
<?php
}
while ($row=mysqli_fetch_array($m)) {
?>
<tr style="font-family: cursive;">
	<td><?php echo $row['name'] ?></td>
	<td><?php echo $row['class'] ?>/<?php echo $row['subject'] ?></td>
	<td><?php echo $row['chapter'] ?></td>
	<td><?php echo date("h:i a, d M Y",strtotime($row['date'])) ?></td>

	<td><button class="button button_standard sweet_button" onclick="accept_it('<?php echo $row['id']; ?>','<?php echo user_detail("user_name") ?>')">Accept</button></td>			

</tr>
<?php
}
?>
	</table>
<?php $df4s = rand(); ?>
<?php $a254 = rand(); ?>
<script>
	function accept_it(id,user)
	{
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/team_exam/accept_team_chal.php',
			type: 'GET',
			data: {id: id,user:user},
		})
		.done(function(data) {
			var title;
			if ($.trim(data)=='1') {
			$(".as<?php echo $a254 ?>").html("please Contact your Team Leader / Co-Leader To accept this Team Challenge.");
			title = "Message";
			} else if ($.trim(data)=='2'){
			$(".as<?php echo $a254 ?>").html("You are not permited to accept the challenge.");
			title = "Message";
			} else {
			title = "Success";
			$(".as<?php echo $a254 ?>").html(data);
			}
			$(".as<?php echo $a254 ?>").dialog({
				open: true,
				modal: true,
				width: "auto",
				show: "fade",
				title: "Message",
				buttons:{
					"Close":function()
					{
						$(this).dialog("close");
					}
				}
			});
		});
	}
</script>
<div class="as<?php echo $df4s ?>"></div>
<div class="as<?php echo $a254 ?>"></div>
</div>







</div>
<?php 
if (mysqli_num_rows($q)>19) {
	echo "<div style='overflow: hidden'><a style='float:right; padding: 10px' href='".return_domain("/team_exam")."'>View All</a></div>";
}
 ?>

</aside>
<?php } 



if ($item=="top_students" || $item=="all") {
?>
<aside>
	<h2 class="caption">Top Students</h2>
	<div class="side_content">
		<table class="func_table table_hoverable">
<tr>
<th>No.</th>
<th>User Name</th>
<th>Rating</th>
</tr>
			<?php 
			global $db;
			$st = "SELECT * FROM user WHERE role=1 ORDER BY rating DESC LIMIT 9";
			$r = mysqli_query($db,$st);
			$user="";
			$rating="";
			while($row = mysqli_fetch_array($r)){
				$user.=",".$row['user_name'];
				$rating.=",".$row['rating'];
			}
			$user = substr($user, 1);
			$rating = substr($rating, 1);
			$user = explode(",", $user);
			$rating = explode(",", $rating);
			for ($i=0; $i < count($rating); $i++) { 
				?>
<tr>
<td><?php echo $i+1 ?></td>
<td><a href="<?php get_domain("/profile/");?><?php echo $user[$i]; ?>" style="text-decoration: none;"><?php echo my_name($user[$i]); ?></a></td>
<td style="font-family: arial; font-weight: bold;"><?php echo $rating[$i]; ?></td>
</tr>
				<?php
			}
			 ?>
		</table>
	</div>
	<?php 
if (count($rating)<=9) {
	echo "<div style='overflow: hidden'><a style='float:right; padding: 10px' href='".return_domain("/ratings")."'>View All</a></div>";
}
 ?>
</aside>
<?php } 





if ($item=="top_teachers" || $item=="all") {
?>
<aside>
	<h2 class="caption">Top Teachers</h2>
	<div class="side_content">
		<table class="func_table table_hoverable">
<tr>
<th>No.</th>
<th>User Name</th>
<th>Accuracy</th>
</tr>
			<?php 
			global $db;
			$st = "SELECT * FROM user WHERE role=2 AND user_name!='TravellerAlim' ORDER BY rating DESC LIMIT 10";
			$r = mysqli_query($db,$st);
			$user="";
			$rating="";
			while($row = mysqli_fetch_array($r)){
				$user.=",".$row['user_name'];
				$rating.=",".$row['rating'];
			}
			$user = substr($user, 1);
			$rating = substr($rating, 1);
			$user = explode(",", $user);
			$rating = explode(",", $rating);
			for ($i=0; $i < count($rating); $i++) { 
				?>
<tr>
<td><?php echo $i+1 ?></td>
<td><a style="color: black; text-decoration: none; font-weight: bold;"; href="<?php get_domain("/profile/");?><?php echo $user[$i]; ?>" style="text-decoration: none;"><?php echo $user[$i]; ?></a></td>
<td style="font-family: arial; font-weight: bold;"><?php echo color(number_format($rating[$i],2)."%","#000"); ?></td>
</tr>
				<?php
			}
			 ?>
		</table>
	</div>
		<?php 
if (count($rating)>0) {
	echo "<div style='overflow: hidden'><a style='float:right; padding: 10px' href='".return_domain("/teachers.php")."'>View All</a></div>";
}
 ?>
</aside>
<?php } 



if ($item=="top_teams" || $item=="all") {
?>
<aside>
	<h2 class="caption">Top Teams</h2>
	<div class="side_content">
		<table class="func_table table_hoverable">
<tr>
<th>No.</th>
<th>Team Name</th>
<th>Rating</th>
</tr>
			<?php 
			$sql = "SELECT * FROM team ORDER BY rating DESC LIMIT 10";
			$m = mysqli_query($db,$sql);
			if (mysqli_num_rows($m)==0) {
				?>
<tr>
	<td colspan="3">No Team Found</td>
</tr>
				<?php
			}
			for ($i=0; $i < mysqli_num_rows($m); $i++) {
			$row = mysqli_fetch_array($m); 
				?>
<tr>
<td><?php echo $i+1 ?></td>
<td><a href="<?php get_domain("/team/") ?><?php echo $row['rand_id'] ?>"><?php echo $row['team_name'] ?></a></td>
<td style=" font-weight: bold;"><?php echo $row['my_rating'] ?></td>
</tr>
				<?php
			}
			 ?>
		</table>
	</div>
		<?php 
if (count($rating)>9) {
	echo "<div style='overflow: hidden'><a style='float:right; padding: 10px' href='".return_domain("/team")."'>View All</a></div>";
}
 ?>
</aside>
<?php } 



if ($item=="top_contributer" || $item=="all") {
?>
<aside>
	<h2 class="caption">Top Contributer</h2>
	<div class="side_content">
		<table class="func_table table_hoverable">
<tr>
<th>No.</th>
<th>User Name</th>
<th>Contribution</th>
</tr>
			<?php 
			global $db;
			$st = "SELECT * FROM user WHERE user_name!='TravellerAlim' ORDER BY cc DESC LIMIT 9";
			$r = mysqli_query($db,$st);
			$user="";
			$rating="";
			while($row = mysqli_fetch_array($r)){
				$user.=",".$row['user_name'];
				$rating.=",".$row['cc'];
			}
			$user = substr($user, 1);
			$rating = substr($rating, 1);
			$user = explode(",", $user);
			$rating = explode(",", $rating);
			for ($i=0; $i < count($rating); $i++) { 
				?>
<tr>
<td><?php echo $i+1 ?></td>
<td><a href="<?php get_domain("/profile/");?><?php echo $user[$i]; ?>" style="text-decoration: none;"><?php echo my_name($user[$i]); ?></a></td>
<td style="font-family: arial; font-weight: bold;"><?php if ($rating[$i]>0) {
	echo color("+","#000");
} echo color($rating[$i],"#000"); ?></td>
</tr>
				<?php
			}
			 ?>
		</table>
	</div>
		<?php 
if (count($rating)>8) {
	echo "<div style='overflow: hidden'><a style='float:right; padding: 10px' href='".return_domain("/contribution.php")."'>View All</a></div>";
}
 ?>
</aside>
<?php } 

if ($item=="find_users" || $item=="all") {
?>
<aside>
	<h2 class="caption">Find User</h2>
	<div class="side_content" style="padding: 20px 10px">
		<form action="" id="search_user">
			<input type="text" autocomplete="off" onkeyup="key_pressed(this.value)" name="search_user" id="search_user_input" placeholder="Press key to Search">
		</form>
		<table class="func_table table_hoverable data_table_user_search"></table>
		<script>
			function key_pressed(val) {
				$.ajax({
					url: '<?php get_domain("/") ?>ajax/user_search.php',
					type: 'GET',
					data: {user: val},
				})
				.done(function(data) {
					$(".data_table_user_search").html(data);
				})
				.fail(function() {
					$(".data_table_user_search").html("network error.");
				});
				
			}
		</script>
	</div>
</aside>


<?php
}
}
?>