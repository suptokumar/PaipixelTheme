<?php 
if (isset($_GET['handshake'])) {
include '../ajax/db.php';
include '../aside.php';
session_start();
} else {
include 'ajax/db_back.php';
}

?>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/profile.css?c=3">
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/jquery.datetimepicker.css">
<script src="<?php get_domain("/"); ?>js/jquery.datetimepicker.full.js"></script>
<style>
	.assist {
  background: red;
  color: white;
  padding: 5px;
  border-radius: 10px;
  font-family: arial;
}
</style>
<div class="container">
	<div class="body_content content_area" style="width: 96%">
<?php 
if (isset($_SESSION['login_data_paipixel24'])) {
	$user = $_SESSION['login_data_paipixel24'];
	$sql = "SELECT * FROM user WHERE user_name = '$user'";
	$q = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($q);
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
	$balance = $row['balance'];
	$active = $row['active'];
	$background = $row['background'];
	$phone_confirm = $row['phone_confirm'];
	$email_confirm = $row['email_confirm'];
	?>
<script>
	$(document).ready(function() {
$.ajax({
				url: '<?php get_domain("/ajax/account.notifications.php") ?>',
				type: 'POST',

				data: {user: '<?php echo $user; ?>',page:1},
				beforeSend:function(){
					$(".account_view").html('<h3 style="text-align: center;">Loading...</h3>');
				}
			})
			.done(function(data) {
				$(".account_view").html(data);
			})
			.fail(function() {
				$(".smart_message").html("Network Error !");
				$(".smart_message").dialog({
					open: true,
					title: "Failed",
					modal: true,
					buttons:{
						"ok":function(){
							$(this).dialog("close");
						}
					}
				});
			});




		$(".accuont_btn a").click(function(event) {
			$(".accuont_btn a").removeClass('active_btn');
			event.preventDefault();
			var uri = $(this).attr("data-uri");
			var d = $(this).attr("data-handle");
			var data = "user=<?php echo $user; ?>&&"+d;
			$(this).addClass('active_btn');
			$.ajax({
				url: uri,
				type: 'POST',

				data: data,
				beforeSend:function(){
					$(".account_view").html('<h3 style="text-align: center;">Loading...</h3>');
				}
			})
			.done(function(data) {
				$(".account_view").html(data);
			})
			.fail(function() {
				$(".smart_message").html("Network Error !");
				$(".smart_message").dialog({
					open: true,
					title: "Failed",
					modal: true,
					buttons:{
						"ok":function(){
							$(this).dialog("close");
						}
					}
				});
			});
			
		});
	});
</script>
<div class="smart_message"></div>
<div class="profile_header">
	<div class="profile_background" style="background: linear-gradient(#FFF,#FFF,#FFF)"></div>
	<div class="image_task">
	<img src="<?php get_domain("/"); echo $image ?>" alt="<?php echo $user ?>" class="profile_image">
	<div class="user_name">
		<?php if ($role==2) {
			?>
		<h2 style="color: black; font-size: 16px; text-shadow: none;"><?php if($rating==0){echo "Not Verified (AA: ".color(arial('0.0')."%","#20b99d").")";} else{
			echo color("✓","green")." Verified (AA: ".color(arial(number_format($rating,2))."%","#20b99d").")";
		} ?></h2>
			<?php 
		} else {
			?>
		<h2 style=" font-size: 16px;"><?php echo name_by_rate($user) ?></h2>

			<?php 
		} ?>
		<h2 style="color: black; text-shadow: none;"><?php echo my_name($user) ?></h2>
		<h3><a href="<?php get_domain("/profile/".$user); ?>">View Profile in public Mode</a></h3>
	</div>
	</div>
</div>
<script>
setInterval(function(){
$.ajax({
	url: '<?php get_domain("/ajax/noti/show.php") ?>',
})
.done(function(data) {
	// alert(data);
	$(".resp_noti").html(data);
});

},1000);
</script>
<?php if ($role==2) {
	?>
<div class="button_set accuont_btn">
	
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/account.notifications.php") ?>" data-handle="page=1" class="active_btn">Notifications <span class="resp_noti"></span></a>
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/account.personal_details.php") ?>">Personal Details</a>
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/account.blog.php") ?>">Blog</a>
	<!-- <a href="javascript:void(0)" id="post_tu" data-uri="<?php get_domain("/ajax/teacher/post.php") ?>">Post A Tutorial</a> -->
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/teacher/my_post.php?page=1&&cls&&subject&&chapter&&fst&&status") ?>" id="my_tu">My Questions</a>
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/account.asked_q.php") ?>">Assigned Question</a>
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/teacher/qualifications.php") ?>">My Qualifications</a>
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/teacher/withdraw.php") ?>">Withdraw Money</a>
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/account.settings.php") ?>">Settings</a>
</div>
	<?php
} else {
	?>
<div class="button_set accuont_btn">
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/account.notifications.php") ?>" data-handle="page=1" class="active_btn">Notifications <span class="resp_noti"></span></a>
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/account.personal_details.php") ?>">Personal Details</a>
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/account.exam_list.php") ?>">My Exams</a>
	<?php 
$fr_rq = user_detail('fr_rq');
$fr_rq = explode(",", $fr_rq);
$req  = count($fr_rq)-1;
	if ($req!=0) {
	$fsono = '<span class="assist">'.$req.'</span>';
} else {
	$fsono = '';

}
 ?>
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/account.friends.php") ?>">Friends <?php echo $fsono ?></a>
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/account.asked_q.php") ?>">Asked Question</a>
	<?php 
	$team = user_detail("team");
$sql = "SELECT * FROM team WHERE rand_id = '$team'";
$dg1 = mysqli_query($db,$sql);
$w = mysqli_fetch_array($dg1);
$apply = $w['apply'];
$apply=explode(",", $apply);
$req = count($apply)-2;
if ($req!=0) {
	$fsono = '<span class="assist">'.$req.'</span>';
} else {
	$fsono = '';

}
if ($team=='') {
	$fsono = '';
}

 ?>
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/account.my_team.php") ?>" class="my_team15">My Team <?php echo $fsono ?></a>
	<a href="javascript:void(0)" data-uri="<?php get_domain("/ajax/account.settings.php") ?>">Settings</a>
</div>
	<?php
} ?>



<div class="account_view">
	<h3 style="text-align: center;">Loading...</h3>
</div>
	<?php
}

?>

	</div>

</div>