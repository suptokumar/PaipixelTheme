<?php 
include 'ajax/db_back.php';
include 'header.php';
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = "SELECT * FROM announce WHERE id='$id'";
	$m = mysqli_query($db,$sql);
	if (mysqli_num_rows($m)==0) {
		?>
<?php get_header("Sorry No Post Found"); ?>
		<?php
	} else {
		$row = mysqli_fetch_array($m);
		?>
<?php get_header($row['header']." - Paipixel"); ?>
		<?php
	}
}else {
?>
<?php get_header("Paipixel All Posts"); ?>
<?php
} ?>


<style>
.fr-emoticon{
    padding: 9px;
    background-repeat: no-repeat !important;
    background-position: 0 0 !important;
    background-size: 100% 100% !important;
}
.alim_vai ul,.alim_vai ol {
	padding-left: 2% !important;
}
.fr-fic.fr-dib {
    max-width: 100%;
}
</style>
<script>
function add_vote(id)
{
	$.ajax({
	url: '<?php get_domain("/blog/") ?>vote_up.php',
		type: 'POST',
		data: {id: id},
	})
	.done(function(data) {
		if ($.trim(data)!='') {
			alert(data);
		}
	});
	
}
function out_vote(id)
{
	$.ajax({
		url: '<?php get_domain("/blog/") ?>vote_down.php',
		type: 'POST',
		data: {id: id},
	})
	.done(function(data) {
		if ($.trim(data)!='') {
			alert(data);
		}
	});
	
}

function add_sub_vote(id)
{
	$.ajax({
		url: '<?php get_domain("/blog/") ?>ans.vote_up.php',
		type: 'POST',
		data: {id: id},
	})
	.done(function(data) {
		if ($.trim(data)!='') {
			alert(data);
		}
	});
	
}
function out_sub_vote(id)
{
	$.ajax({
		url: '<?php get_domain("/blog/") ?>ans.vote_down.php',
		type: 'POST',
		data: {id: id},
	})
	.done(function(data) {
		if ($.trim(data)!='') {
			alert(data);
		}
	});
	
}
</script>
<script>
	function get_comments(id,a,t){
t.remove();
$.ajax({
	url: '<?php get_domain("/blog/all_comments.php") ?>',
	type: 'POST',
	data: {id: id, a:a},
})
.done(function(data) {
	$(".sd"+id+'1').prepend(data);
});
	}
</script>

<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu();
?>
<div class="from_main_body">


<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css?ids2">
<div class="container" style="padding: 0px; margin: 0px;">
<div class="body_content content_area" style="background: #eee;  margin: 0px; border:none; padding: 0px;">
<link rel="stylesheet" href="<?php get_domain("/css/table.css?s5.0gs") ?>">
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">


<?php 
if (isset($_GET['id'])) {
$sql = "SELECT * FROM `announce` WHERE pending=1 AND id='$id' ORDER BY datetime DESC LIMIT 20";
}else {
$sql = "SELECT * FROM `announce` WHERE pending=1 ORDER BY datetime DESC LIMIT 20";
}
$q= mysqli_query($db,$sql);
date_default_timezone_set("Asia/Dhaka");

if (mysqli_num_rows($q)==0) {
?>
<div style="padding: 1%; margin: 10px 1%; background: white; font-family: 'Source Sans Pro', sans-serif;">
<div class="alim_vai">
<h1 style="text-align: center; color: red;">Sorry !</h1>
<p style="text-align: center; font-size: 20px; font-family: cursive;">The post your are searching for isn't available right now.</p>
</div>
</div>
<?php
}





while ($row=mysqli_fetch_array($q)) {
	?>
<div style="padding: 1%; margin: 10px 1%; background: white; font-family: 'Source Sans Pro', sans-serif;">
<div class="alim_vai">
	<h3><a href="<?php get_domain("/") ?>post/<?php echo $row['id'] ?>" style="font-size: 30px; letter-spacing: 1.4px; font-weight: 400; text-decoration: none; color: #36D2FF;"><?php echo $row['header'] ?></a></h3>
	<div class="at24">By <strong><a style="font-weight: bold; font-size: 20px; color: #800003" href="<?php get_domain("/profile/") ?><?php echo $row['user'] ?>"><?php echo $row['user'] ?></a></strong>, <time class="at<?php $af=rand(); echo $row['id'].$af; ?>"></time></div>
	<script>
	setInterval(function(){
$.ajax({
	url: '<?php get_domain("/ajax/extra/time_def.php") ?>',
	type: 'GET',
	data: {time: '<?php echo $row['datetime']; ?>'},
})
.done(function(data) {
	$(".at<?php echo $row['id'].$af; ?>").html(data);
});

	},1000);
	</script>
<script>
	setInterval(function(){
$.ajax({
		url: '<?php get_domain("/") ?>blog/question_vote.php',
		type: 'POST',
		data: {id: '<?php echo $row['id'] ?>'},
	})
	.done(function(data) {
		$(".main_vote<?php echo $row['id'] ?>").html(data);
	});
	
},1000);
</script>
<script>
function open_comments(id)
{
	var open = $(".sond"+id).attr("data-open");
	if (open=='false') {
$.ajax({
	url: '<?php get_domain("/blog/comment.php") ?>',
	type: 'POST',
	data: {id: id},
})
.done(function(data) {
	$(".commnt_"+id).html(data);
});

	}
	$(".commnt_"+id).toggle("slow");

}
</script>
<?php 
if (isset($_GET['id'])) {
?>
<script>
	$(document).ready(function() {
 open_comments('<?php echo $_GET['id']; ?>');
	});
</script>
<?php
} ?>
	<div style="padding: 1%">
	<?php echo $row['body'] ?>
	</div>
		<div class="vote_counter">
		<div class="voter_machine">
<a href="javascript:void(0)" class="sond<?php echo $row['id'] ?>" onclick="open_comments(<?php echo $row['id'] ?>)" data-open="false" style="float: right; font-size: 19px;">Comments</a>
<table>
<tr>
<td>
<img style="cursor: pointer" src="<?php get_domain("/image/voteup.png") ?>" alt="vote up" title="I like it." onclick="add_vote(<?php echo $row['id']; ?>);">
<span class="main_vote<?php echo $row['id'] ?>" style="font-family: arial; font-weight: bold; font-size: 23px; padding: 10px 0px; text-align: center;"></span>
<img style="cursor: pointer" src="<?php get_domain("/image/votedown.png") ?>" alt="vote up" title="I don't like it." onclick="out_vote(<?php echo $row['id']; ?>);">
</td>
</tr>
<tr>
	<td id="notif">
		
	</td>
</tr>
</table>
</div>
</div>
<div class="comment_box commnt_<?php echo $row['id'] ?>" style='display: none; border-top: 3px groove #3C3C3C; padding-top: 7px;'>
	
</div>
</div>
<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/blog/count_comment.php") ?>',
		type: 'POST',
		data: {id: '<?php echo $row['id'] ?>'},
	})
	.done(function(data) {
		$(".sond<?php echo $row['id'] ?>").html(data);
	});
	
},1000);
</script>
</div>
	<?php
}
?>
 </div>









	<div class="aside_content content_area">
		<?php get_aside(); ?>
	</div>





</div>
</div>
</div>


<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();
?>

