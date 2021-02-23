<?php 
include '../extra/db.extra.php';
session_start();
$user = $_SESSION['login_data_paipixel24'];
$team = $_GET['team'];
$from = $_GET['from'];
$to = $_GET['to'];
$sql = "SELECT id FROM team_comments WHERE team = '$team'";
$q = mysqli_query($db,$sql);
$row = mysqli_num_rows($q);

$sql = "SELECT * FROM team_comments WHERE team = '$team' ORDER BY id DESC LIMIT $from, $to";
$qs = mysqli_query($db,$sql);
if (mysqli_num_rows($qs)!=0) {
	while ($row=mysqli_fetch_array($qs)) {
		?>
<div style="overflow: hidden">
<section class="msg_corner <?php if ($row['user']!=$user) {
	echo "dasbin_corner";
} ?>">
	<h3><a href="http://localhost/profile/<?php echo $row['user'] ?>" onclick="query_url(event,this,'from_main_body','<?php echo $row['user'] ?> | PaiPixel Online Exam','http://localhost/profiles/<?php echo $row['user'] ?>')"><?php echo $row['user'] ?></a></h3>
	<p title="<?php echo $row['show_time'] ?>"><?php echo $row['comment'] ?></p>
</section>
</div>
		<?php
	}
}else{
	echo "No Messages.";
}
if (mysqli_num_rows($q)>(($to)+($from))) {
	echo "<a href='javascript:void(0)' style='color: brown;
background: white;
padding: 10px;
margin: 10px;
display: block;
text-align: center;' onclick='load_message(".(($to)+($from)).",".$to.",".$team.")'>Load More Messages.</a>";
}
?>