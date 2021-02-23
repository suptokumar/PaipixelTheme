<?php 
if (isset($_GET['handshake'])) {
include '../ajax/db_back.php';
include '../functions.php';
	include '../aside.php';
} else {
	include 'ajax/db_back.php';

}

?>

<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css?ids2">
<div class="container" style="padding: 0px; margin: 0px;">

	<div class="body_content content_area" style="background: #fff;  margin: 0px; border:none; padding: 0px">
<style>
.userinfo {

    width: 15%;
    display: inline-block;
    text-align: center;
    background: linear-gradient(#53ecd0,#53ecd0,#53ecd0,#1EA990);
    font-size: 17px;
    color: white;
    border-radius: 10px;

}
.userinfo img{
  width: 100%;
}
@media (max-width: 500px) {
	.userinfo {
		width: 19%;
		font-size: 15px;
	}
	.alim_vai a{
		font-size: 20px !important;
	}
}
</style>
<div class="todays_top_score" style="padding: 1%; margin: 10px 1%; text-align: center; background: white; font-family: 'Source Sans Pro', sans-serif; border: 1px solid #20b99d">
<?php 
date_default_timezone_set("Asia/Dhaka");
$year = date("Y");
$month = date("m");
$day = date("d");

$prev_day = time()-60*60*24;


// $sql = "SELECT * FROM todays_model WHERE year(date)='$year' AND month(date)='$month' AND day(date)='$day' GROUP BY user ORDER BY score DESC LIMIT 5";
// $m = mysqli_query($db,$sql);
// $row = mysqli_fetch_array($m);
// $score1=$row['score'];


// $sql = "SELECT * FROM custom_score WHERE year(date)='$year' AND month(date)='$month' AND day(date)='$day' GROUP BY user,date ORDER BY score DESC LIMIT 5";
// $m = mysqli_query($db,$sql);
// $row = mysqli_fetch_array($m);
// $score2=$row['score'];


// $sql = "SELECT SUM(score) FROM exam_score WHERE year(datetime)='$year' AND month(datetime)='$month' AND day(datetime)='$day' GROUP BY user ORDER BY score DESC LIMIT 5";
// $m = mysqli_query($db,$sql);
// $row = mysqli_fetch_array($m);
// echo $score3=$row[0];

$sql = "SELECT *,SUM(score) FROM score_leader_board WHERE year(date)='$year' AND month(date)='$month' AND day(date)='$day' GROUP BY user_name ORDER BY SUM(score) DESC LIMIT 5";
$m = mysqli_query($db,$sql);
// echo mysqli_num_rows($m);
$gm = mysqli_num_rows($m);
if (($gm)==0) {
	?>
<h2 style="text-align: center; color: #20b99d">Today's Top Scorer</h2>
<h3 style="text-align: center; color: #18CEE9">No one has participated yet !</h3>
<h3 style="text-align: center; color: #20b99d"><a href="<?php get_domain("/model.php") ?>">Be First One</a></h3>

	<?php
}
if (($gm)!=0) {
	?>
<h2 style="text-align: center;">Today's Top Scorer</h2>

	<?php
}
while($row = mysqli_fetch_array($m))
{
?>
<div class="userinfo">
	<a href="<?php get_domain("/profile/") ?><?php echo $row['user_name'] ?>" style="text-decoration: none;">
<img src="<?php echo more_user("image",$row['user_name']); ?>" alt="<?php echo $row['user_name']; ?>" class="ondo">
<h4 style="color: yellow;"><?php echo my_name($row['user_name']); ?></h4>
<h4 style="color: yellow;"><?php echo number_format($row['SUM(score)'],3); ?></h4>
	</a>
</div>
<?php
	
}
$prev_day = time()-60*60*24;
$year = date("Y",$prev_day);
$month = date("m",$prev_day);
$day = date("d",$prev_day);


$sql = "SELECT *,SUM(score) FROM score_leader_board WHERE year(date)='$year' AND month(date)='$month' AND day(date)='$day' GROUP BY user_name ORDER BY SUM(score) DESC LIMIT 5";
$m = mysqli_query($db,$sql);
// echo mysqli_num_rows($m);
$gm = mysqli_num_rows($m);
if (($gm)==0) {
	?>

	<?php
}
if (($gm)!=0) {
	?>
<h2 style="text-align: center;">Yesterday's Top Scorer</h2>

	<?php
}
while($row = mysqli_fetch_array($m))
{
?>
<div class="userinfo">
	<a href="<?php get_domain("/profile/") ?><?php echo $row['user_name'] ?>" style="text-decoration: none;">
<img src="<?php echo more_user("image",$row['user_name']); ?>" alt="<?php echo $row['user_name']; ?>" class="ondo">
<h4 style="color: yellow;"><?php echo my_name($row['user_name']); ?></h4>
<h4 style="color: yellow;"><?php echo number_format($row['SUM(score)'],3); ?></h4>
	</a>
</div>
<?php
	
}
?>
</div>

<div class="ass">
	
</div>
<script>

	$.ajax({
		url: '<?php get_domain("/home_posts.php") ?>',
		type: 'GET',
	})
	.done(function(data) {
		$(".ass").html(data);
	})
	.fail(function() {
		$(".ass").html("Network Error.");
	});
	
</script>

 </div>
	<div class="aside_content content_area">
		<?php get_aside(); ?>
	</div>
</div>

<style>




.footer_part {
  background: #212121;
  color: white;
  width: 100%;
  overflow: hidden;
}
.footer_part .partitions {
  width: 25%;
  margin: 10px 2%;
  padding: 2%;
  font-size: 15px; 
  float: left;
}
.footer_part .partitions h2{
  color: #59e8ce;
  letter-spacing: 2px;
  margin-bottom: 5px;
}
.footer_part .partitions h4{
  color: #59e8ce;
  letter-spacing: 2px;
  margin-bottom: 5px;
  margin-top: -5px;
}
.footer_part .partitions a{
  display: block;
  color: white;
  text-decoration: none;
  padding: 2.5px 0px;
}
.footer_part .partitions a:hover{
  color: #20b99d;
}
.footer_part .partitions li{
  list-style: none;
}

.footer_part .partitions span.images_ft img {
  width: 22px !important;
  vertical-align: bottom;
  padding: 10px 10px 0px 0px;
  border-radius: 5px;
}

@media (max-width:1148px)
{
  .w80 {
    width: 92% !important;
  margin: 0 !important;
    text-align: center;
  }
  .footer_part .partitions {
    width: 25%;
    margin: 10px 10%;
  }
}

@media (max-width:570px)
{
  .w80 {
    width: 92% !important;
  margin: 0 !important;
    text-align: center;
  }
  .footer_part .partitions {
    width: 40%;
    margin: 10px 2%;
  }
}

</style>


<div class="footer_part">
  <div class="partitions w80">
    <h2 style="font-family: 'Orbitron', sans-serif;">PaiPixel</h2>
    <h4 style="font-family: 'Orbitron', sans-serif;">More Exam, More Skills</h4>
    <br>
    <p>
      PaiPixel বাংলাদেশের সর্ববৃহৎ Student-Teacher Interactive Educational Platform যেটি বেশি বেশি প্রতিযোগিতামূলক পরীক্ষার মাধ্যমে শিক্ষার্থীদের নিজ নিজ বিষয়ে দক্ষ করে তোলে। PaiPixel বিশ্বাস করে একজন ছাত্র কে গড়ে তুলতে হলে তাকে প্রথমে ছাত্র করে তুলতে হবে। কেউ নিজের দুর্বলতাটা জানতে পারলেই সেটাকে শক্ত করে আগলে ধরে উন্নতির দিকে ধাবিত হতে পারবে। তাই শিক্ষার্থীদের পরীক্ষা ও প্রতিযোগিতাকে মজার মধ্যে এনে তাদের জীবনকে আলোকিত করাই PaiPixel এর লক্ষ্য ।
    </p>
  </div>
   <div class="partitions">
    <h2>PaiPixel</h2>
    <ul>
    	<li><a href="<?php get_domain("/who_we_are.php") ?>">Who We Are</a></li>
    	<li><a href="<?php get_domain("/careers.php") ?>">Careers</a></li>
    	<li><a href="<?php get_domain("/termsandconditions.php") ?>">Terms & conditions</a></li>
    	<li><a href="<?php get_domain("/privacy.php") ?>">Privacy Policy</a></li>
    	<li><a href="<?php get_domain("/callaborate.php") ?>">Callaborate PaiPixel</a></li>
    	<li><a href="<?php get_domain("/feedback.php") ?>">Give Feedback</a></li>
    	<li><a href="<?php get_domain("/contact.php") ?>">Contact us</a></li>
    </ul>
  </div>
   <div class="partitions">
    <h2>Follow us</h2>
    <ul>
    	<li><a href=""><span class="images_ft"><img style="width: 18px;" src="<?php get_domain("/image/social/facebook.png") ?>"/></span>Facebook Page</a></li>
    	<li><a href=""><span class="images_ft"><img style="width: 18px;" src="<?php get_domain("/image/social/youtube.png") ?>"/></span>Youtube</a></li>
    	<li><a href=""><span class="images_ft"><img style="width: 18px;" src="<?php get_domain("/image/social/instragram.png") ?>"/></span>Instragram</a></li>
    	<li><a href=""><span class="images_ft"><img style="width: 18px;" src="<?php get_domain("/image/social/linkedin.png") ?>"/></span>LinkedIn</a></li>
    </ul>
  </div>
</div>

<div class="ending" style="color: white; background: #0E0E0E; padding: 10px; font-style: italic; text-align: center;">
	Copyright©2020 PaiPixel. All Rights Reserved.
</div>