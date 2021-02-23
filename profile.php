<?php 
if (isset($_GET['handshake'])) {
include 'ajax/db.php';
include 'aside.php';
session_start();
} else {
include 'ajax/db_back.php';
}

?>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/profile.css?d">
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<div class="container">

<script>
	$(document).ready(function() {
		$(".button_set.accuont_btn a#add_friend").click(function(event) {
			event.preventDefault();
			if ($(this).attr('disabled')!='disabled') {

				if ($(this).html()=="Unfriend") {
$.ajax({
	url: '<?php get_domain("/ajax/account.un_friend.php") ?>',
	type: 'POST',
	data: "user="+$(this).attr("data-user"),
})
.done(function(data) {
	$(".button_set.accuont_btn a#add_friend").html(data);
});

				}
				if ($(this).html()=="Cancel Friend Request") {
$.ajax({
	url: '<?php get_domain("/ajax/account.cancel_friend.php") ?>',
	type: 'POST',
	data: "user="+$(this).attr("data-user"),
})
.done(function(data) {
	$(".button_set.accuont_btn a#add_friend").html(data);
});

				}
if ($(this).html()=="Add Friend") {
					
			$.ajax({
				url: '<?php get_domain("/ajax/account.add_friend.php") ?>',
				type: 'POST',
				data: "user="+$(this).attr("data-user"),
			})
			.done(function(data) {
				if (data=='Login and Try again.' || data=='It\'s You') {
					$(".button_set.accuont_btn a#add_friend").html(data);
					$(".button_set.accuont_btn a#add_friend").attr('disabled', 'disabled');
					$(".button_set.accuont_btn a#add_friend").css({
						transition: '1s ease',
						background: 'tomato',
						color: 'white',
					});
					setTimeout(function(){
					$(".button_set.accuont_btn a#add_friend").html("Add Friend");
					$(".button_set.accuont_btn a#add_friend").removeAttr('disabled');
					$(".button_set.accuont_btn a#add_friend").removeAttr('style');
					},5000);
				}
				 else if (data='Friend Request Sent') {
$(".button_set.accuont_btn a#add_friend").html(data);
					$(".button_set.accuont_btn a#add_friend").attr('disabled', 'disabled');
					$(".button_set.accuont_btn a#add_friend").css({
						transition: '1s ease',
						background: 'tomato',
						color: 'white',
					});
					setTimeout(function(){
					$(".button_set.accuont_btn a#add_friend").html("Cancel Friend Request");
					$(".button_set.accuont_btn a#add_friend").removeAttr('disabled');
					$(".button_set.accuont_btn a#add_friend").removeAttr('style');
					},1000);

				 } else {
					$(".button_set.accuont_btn a#add_friend").html(data);
				}
			});
			
				}
			}
		});
	});
</script>
<script>
	$(document).ready(function() {
		
	$(".button_set.accuont_btn a#msger").click(function(event) {
		event.preventDefault();
		var user = $(this).attr('data-user');
		if ($.trim(user)!='') {
		open_msg_only();
			add_user_to_msg(user);
		} else {
			alert("Messanger is unavailable to you.");
		}
		
	});
	});
</script>
<div class="body_content content_area" style="width: 96%">
<?php 
if (isset($_GET['profile'])) {
	$user = $_GET['profile'];
	$sql = "SELECT * FROM user WHERE user_name = '$user'";
	$q = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($q);
	if (mysqli_num_rows($q)==0){
		echo "<h2 style='text-align: center; color: purple;'>This User(".$user.") is not available now</h2>";
		?>
		<style>
			.aside_init .caption {
				background: linear-gradient(#dfdfdf,#efefef);
				color: black;
				text-align: center;
				padding: 10px;
				margin-top: 20px;
			}
		</style>
		<div class="aside_init">
		<?php get_aside("top_students"); ?>
			
		</div>
		</div>
<div class="aside_content content_area">
		<?php get_aside("find_users"); ?>
		<?php get_aside("upcoming_exams"); ?>
</div>
		<?php
exit();
	}
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$role = $row['role'];
	$class = $row['class'];
	$school = $row['school'];
	$Address = $row['Address'];
	$google_location = $row['google_location'];
	$interested = $row['interested'];
	$bio = $row['bio'];
	$rating = $row['rating'];
	$image = $row['image'];
	$friend = $row['friend'];
	$team = $row['team'];
	$balance = $row['balance'];
	$active = $row['active'];
	$background = $row['background'];
	$depertment = $row['depertment'];
	$phone_confirm = $row['phone_confirm'];
	$email_confirm = $row['email_confirm'];
	$maxrate = $row['max-rate'];
	$datetime = $row['datetime'];
	$id = $row['id'];
	$ppaa = $row['perfect_aa'];
	?>
<div class="smart_message"></div>
<script>
	$(document).ready(function() {
		$.ajax({
			url: '<?php get_domain("/ajax/profile.check_if_friend.php") ?>',
			type: 'POST',
			data: 'user=<?php echo $user; ?>',
		})
		.done(function(data) {
			$(".button_set.accuont_btn a#add_friend").html(data);
		});
	});
</script>
<div class="profile_header">
	<div class="profile_background" style="background: linear-gradient(#FFF,#FFF,#FFF)"></div>
	<div class="image_task">
	<img src="<?php get_domain("/"); echo $image ?>" alt="<?php echo $user ?>" class="profile_image">
	<div class="user_name">
		<?php if ($role==2) {
			?>
			<?php if ($user=='TravellerAlim'){ ?>
<h2 style="color: black; font-size: 16px; text-shadow: none;">Founder of Paipixel</h2>
			<?php } else {
				?>
<h2 style="color: black; font-size: 16px; text-shadow: none;"><?php if($rating==0){echo "Not Verified (AA: ".color(arial('0.0')."%","#20b99d").")";} else{
			echo color("✓","green")." Verified (AA: ".color(arial(number_format($rating,2))."%","#20b99d").")";
		} ?></h2>
				<?php
			} ?>
		
			<?php 
		} else {
			?>
		<h2 style=" font-size: 16px;"><?php echo name_by_rate($user) ?></h2>

			<?php 
		} ?>
		<h2 style="color: black; text-shadow: none;"><?php echo my_name($user) ?></h2>
	</div>
	</div>
</div>
<?php if ($role!=2): ?>
<?php 
$my_role = 0;
$my_id='';
if (isset($_SESSION['login_data_paipixel24'])) {
$me = $_SESSION['login_data_paipixel24'];
  $sql = "SELECT * FROM user WHERE user_name = '$me'";
  $q = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($q);
  $my_role = $row['role'];
  $my_id = $row['id'];
}
if ($my_role!=2) {
	
 ?>
<div class="button_set accuont_btn">
	<?php if ($my_id==$id) {
		

	} else {
		?>
		<?php if (is_block($user)): ?>
			
	<a href="javascript:void(0)" id="add_friend" data-user="<?php echo $user ?>">Add Friend</a>
		<?php endif ?>
		<?php if (user_detail("user_name")!='Nothing'): ?>
			
	<a href="javascript:void(0)" <?php if (block_content($user)=='Unblock') {
		?>
onclick="unblock('<?php echo $user ?>')"
		<?php
	} ?><?php if (block_content($user)=='Block') {
		?>
onclick="block('<?php echo $user ?>')"
		<?php
	} ?>><?php echo block_content($user); ?></a>
		<?php if (is_block($user)): ?>
			<?php if (is_friend($user)): ?>
				
	<a href="javascript:void(0)" id="msger" data-user="<?php echo $id ?>">Message</a>
			<?php endif ?>
		<?php endif ?>
		<?php endif ?>
	<div class="blocker" style="display: none;"></div>
	<script>
		function block(user){
$(".blocker").html("Are you sure you want to block "+user+"?");
$(".blocker").dialog({
	open: true,
	modal: true,
	show: "scale",
	hide: "explode",
	title: "confirmation",
	width: "auto",
	buttons:{
		"Yes":function(){
			$.ajax({
				url: '<?php get_domain("/ajax/block/block.php") ?>',
				type: "POST",
				data: {user: user},
			})
			.done(function(data) {
location.reload();
				
			});
			

		},
		"No":function(){
$(this).dialog("close");
		}
	}

});
		}
function unblock(user){
$(".blocker").html("Are you sure you want to unblock "+user+"?");
$(".blocker").dialog({
	open: true,
	modal: true,
	show: "scale",
	hide: "explode",
	title: "confirmation",
	width: "auto",
	buttons:{
		"Yes":function(){
			$.ajax({
				url: '<?php get_domain("/ajax/block/unblock.php") ?>',
				type: "POST",
				data: {user: user},
			})
			.done(function(data) {
location.reload();
				
			});
			

		},
		"No":function(){
$(this).dialog("close");
		}
	}

});
		}
	</script>
		<?php

	} ?>
</div>
<?php
}
 endif ?>
<div class="account_view">

<?php if ($user=='TravellerAlim'){ ?>
	
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;"> <?php echo $first_name; ?> <?php echo $last_name; ?></span>
</h3>
<?php 


$a1=0;
$a2=0;
$a3=0;
$a4=0;
$a5=0;


// ask_teacher
$sql = "SELECT id FROM ask_teacher WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM question_like WHERE question_id='$id' AND pending=1";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a1+= $row[0];

}
// echo "Question LIKE: ". $a1; br();

// ask ans

$sql = "SELECT id FROM ans_ask WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM answer_like WHERE question_id='$id'";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a2 += $row[0];

}
// echo "Answer Like: ".$a2; br();
// announce

$sql = "SELECT id FROM announce WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM blog_vote WHERE question_id='$id'";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a3 += $row[0];

}
// echo "Blog Like: ".$a3; br();

// blog_comment

$sql = "SELECT id FROM blog_comment WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM blog_cm_like WHERE question_id='$id'";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a4 += $row[0];

}
// echo "Blog comment LIKE: ".$a4; br();


// question

$sql = "SELECT id FROM question WHERE setter='$user' AND pending=1";
$m = mysqli_query($db,$sql);
$row = mysqli_num_rows($m);
$a5 = $row;
// echo "Question Add: ".$a5; br();
$dc="";
$cc = $a5*2+$a4+$a3+$a2+$a1;
if ($cc>0) {
	$dc.="+".$cc;
}else{
	$dc.=$cc;
}
?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Community Contribution (CC): </span><span style="color: purple;vertical-align: top;font: 20px arial; font-weight: bold;"><?php echo color(arial($dc),"green"); ?></span>
</h3>
<?php 
$sql = "SELECT id FROM question WHERE setter = '$user' AND pending=1";
$ag = mysqli_query($db,$sql);
$row1 = mysqli_num_rows($ag);
 ?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Total Added Questions: </span><span style="color: purple;vertical-align: top;font: 20px arial; font-weight: bold;"><?php echo color(arial($row1),"purple"); ?></span>
</h3>
<?php exit(); } ?>


<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;"> <?php echo $first_name; ?> <?php echo $last_name; ?></span>
</h3>

<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Institution: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo $school; ?></span>
</h3>
<?php if ($role==1): ?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Department/Group: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo $depertment; ?></span>
</h3>
<?php endif ?>
<?php if ($role==2): ?>
<?php 
$sql = "SELECT id FROM question WHERE setter = '$user' AND pending=1";
$ag = mysqli_query($db,$sql);
$row1 = mysqli_num_rows($ag);
 ?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Total Added Questions: </span><span style="color: purple;vertical-align: top;font: 20px arial; font-weight: bold;"><?php echo color(arial($row1),"purple"); ?></span>
</h3>

<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Department/Major: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo $school; ?></span>
</h3>
<?php endif ?>
<?php 
if ($role==1) {
?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Rating: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo rating($rating); ?></span> (<span style="color: #000;">Max Rating: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo rating($maxrate); ?></span>)
</h3>

<?php
}else {
?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Average Accuracy (AA): </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo arial(number_format($rating,2)); ?>%</span>
</h3>
<?php
}
?>
<?php 


$a1=0;
$a2=0;
$a3=0;
$a4=0;
$a5=0;


// ask_teacher
$sql = "SELECT id FROM ask_teacher WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM question_like WHERE question_id='$id' AND pending=1";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a1+= $row[0];

}
// echo "Question LIKE: ". $a1; br();

// ask ans

$sql = "SELECT id FROM ans_ask WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM answer_like WHERE question_id='$id'";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a2 += $row[0];

}
// echo "Answer Like: ".$a2; br();
// announce

$sql = "SELECT id FROM announce WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM blog_vote WHERE question_id='$id'";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a3 += $row[0];

}
// echo "Blog Like: ".$a3; br();

// blog_comment

$sql = "SELECT id FROM blog_comment WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM blog_cm_like WHERE question_id='$id'";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a4 += $row[0];

}
// echo "Blog comment LIKE: ".$a4; br();


// question

$sql = "SELECT id FROM question WHERE setter='$user' AND pending=1";
$m = mysqli_query($db,$sql);
$row = mysqli_num_rows($m);
$a5 = $row;
// echo "Question Add: ".$a5; br();
$dc="";
$cc = $a5+$a4+$a3+$a2+$a1;
if ($cc>0) {
	$dc.="+".$cc;
}else{
	$dc.=$cc;
}
?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Community Contribution (CC): </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo color(arial($dc),"green"); ?></span>
</h3>

<?php if ($role==1): ?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Perfect Accuracy Won: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo ($ppaa); ?> Exams</span>
</h3>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Lifetime Score: </span><span style="color: purple;vertical-align: top;font: 20px arial;">
		<?php 
$sql = "SELECT SUM(score) FROM score_leader_board WHERE user_name='$user'";
				$o = mysqli_query($db,$sql);
				$score = mysqli_fetch_array($o);
echo number_format($score[0],3);
		?>
	</span>
</h3>



<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Question Attempted: </span><span style="color: purple;vertical-align: top;font: 20px arial;">
		<?php 
		$sql = "SELECT SUM(total) FROM score_leader_board WHERE user_name='$user'";
		$ao = mysqli_query($db,$sql);
		$total = mysqli_fetch_array($ao);
		echo $total[0];
		?>
	</span>
</h3>


<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Class: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo $class; ?></span>
</h3>



<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Friends Of: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo count(explode(",",$friend))-1; ?> Users</span>
</h3>

<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Team: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo get_team($team) ?></span>
</h3>

<?php endif ?>

<?php
}

?>
<?php 

	date_default_timezone_set("Asia/Dhaka");
$date_time = date("Y-m-d H:i:s");
$status;

$inputSeconds = (strtotime($date_time)-strtotime($datetime));

$secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;
    $secondsInAMonth = 30 * $secondsInADay;
    $secondsInAYear = 12 * $secondsInAMonth;

    $years = floor($inputSeconds / $secondsInAYear);

    $monthSeconds = $inputSeconds % $secondsInAYear;
    $months = floor($monthSeconds / $secondsInAMonth);

    $daySeconds = $monthSeconds % $secondsInAMonth;
    $days = floor($daySeconds / $secondsInADay);

    $hourSeconds = $daySeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

if ($inputSeconds>31536001) {
	$status = $years." Year ".$months." Months Ago";
}
if ($inputSeconds<31536001) {
	$status = $months." Months ".$days." Days Ago";
}
if ($inputSeconds<2628001) {
	$status = $days." Days ".$hours." Hours Ago";
}
if ($inputSeconds<86401) {
	$status = $hours." Hours ".$minutes." Minutes Ago";
} 
if($inputSeconds<3601) {
	$status = $minutes." Minutes ".$seconds." seconds Ago";
}



 ?>

 <h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Registered : </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo $status ?></span>
</h3>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Status : </span><span style="color: green; font: 20px arial;" id="status_report<?php echo $id; ?>"></span>
</h3>


<?php 
if ($role==2) {
?>
      <div class="my_qualification">
<?php 

$aa = more_user("rating",$user);
?>
<?php 
$sql = "SELECT * FROM teachers_qualifications WHERE user='$user' AND qualify=1 ORDER BY score DESC";
$m = mysqli_query($db,$sql);

?>
<h3 style="color: black;">Qualified Subjects: <?php echo color(arial(mysqli_num_rows($m)),"#20b99d") ?></h3>
<?php
if (mysqli_num_rows($m)==0) {
    echo "<p style='color: blue'>".$user." hasn't been qualified yet.</p>";
}

$sql = "SELECT * FROM teachers_qualifications WHERE user='$user' GROUP BY class,subject ORDER BY score DESC";
$m = mysqli_query($db,$sql);
?>
<table class="func_table" style="width: 100%; border: 1px solid green">
    <tr>
        <th>Class</th>
        <th>Subject</th>
        <th>Score</th>
        <th>Accuracy</th>
        <th>Qualification Status</th>
    </tr>
<?php

while ($row = mysqli_fetch_array($m)) {
$classt= $row['class'];
$subjectt= $row['subject'];
$sql = "SELECT * FROM teachers_qualifications WHERE user='$user' AND class='$classt' AND subject='$subjectt' ORDER BY ((score*100)/total) DESC";
$p = mysqli_query($db,$sql);
$row = mysqli_fetch_array($p);
?>
<tr>
    <td><?php if($row['class']==9){echo "9-10";}else if($row['class']==11){echo "11-12";} else { echo $row['class'];} ?></td>
    <td><?php echo $row['subject'] ?></td>
    <td style="font-family: arial;"><?php echo color(number_format($row['score'],2),"#20b99d"); ?> out of <?php echo $row['total'] ?></td>
    <td style="font-family: arial;"><?php echo color(number_format((($row['score'])*100)/($row['total']),2)."%","#20b99d") ?></td>
    <td>
        <?php 
if ($row['qualify']==1) {
    echo color("Qualified","green");
} else {
    echo color("Disqualified","red");
}
        ?>
    </td>

</tr>
<?php
}
if (mysqli_num_rows($m)!=0) {
?>
</table>
<?php } ?>

	<?php
}


if ($role!=2) {
	?>
<iframe src="<?php get_domain("/graph_it.php?user=") ?><?php echo $user; ?>"></iframe>
	<?php
}
 ?>
</div>




	</div>
</div>
<style>
	iframe {
		width: 100%;
		height: 500px;
		border: none;
	}
</style>
<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/ajax/status_check.php?version=") ?><?php echo rand(); ?>',
		type: 'POST',
		data: 'profile=<?php echo $user; ?>'
	})
	.done(function(data) {
		$("#status_report<?php echo $id; ?>").html(data);
	});
	
},1000);
</script>
