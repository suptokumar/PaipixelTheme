<?php 
if (isset($_GET['handshake'])) {
include '../ajax/db_back.php';
include '../functions.php';
	include '../aside.php';
} else {
	include 'ajax/db_back.php';

}
?>

<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<div class="container">
	<div class="body_content content_area" style="width: 99%">
<link rel="stylesheet" href="<?php get_domain("/css/table.css?s5.0gs") ?>">
<style>

	.content_area.body_content {
		background: transparent;
		border: none;
		padding: 0px;
		margin-top: -5px;
	}
	.area_content {
		background: white;
		padding: 1%;
		border: 1px solid #ccc;
	}
</style>
<?php
$subject = '';
$class = '';
$chapter = '';
$keyword = '';
$page_per_post = 20;
if (isset($_GET['subject'])) {
	 $subject = $_GET['subject'];
}
if (isset($_GET['class'])) {
	 $class = $_GET['class'];
}if (isset($_GET['subject'])) {
	 $chapter = $_GET['chapter'];
}if (isset($_GET['keyword'])) {
	 $keyword = $_GET['keyword'];
}
if (isset($_GET['sql'])) {
$sql = "SELECT * FROM tutorial WHERE subject LIKE '%$subject%' AND class LIKE '%$class%' AND chapter LIKE '%$chapter%' AND (title LIKE '%$keyword%' OR tags LIKE '%$keyword%') ORDER BY 
CASE
WHEN title = '$keyword' THEN 0
WHEN title LIKE '$keyword%' THEN 1
WHEN title LIKE '_$keyword%' THEN 2
WHEN title LIKE '__$keyword%' THEN 3
WHEN title LIKE '%$keyword%' THEN 4
WHEN tags LIKE '%$keyword%' THEN 5
END, title,tags

LIMIT $page_per_post";
} else {
$sql = "SELECT * FROM tutorial ORDER BY id DESC LIMIT $page_per_post";
}
$q = mysqli_query($db,$sql);
if (isset($_GET['chapter'])) {
	
if (mysqli_num_rows($q)==0) {
	echo "<div style='text-align: center; margin-top: 10px; padding: 10px; border: 1px solid #ccc; background: #fcfcfc'><h2 style='font-weight: 600;'>Nothing Found For this search.</h2><br>";
	echo "<h2 style='font-weight: lighter;'>Search Query</h2>";
	echo "<h3 style='font-weight: lighter;'>Class: ".$class."</h3>";
	echo "<h3 style='font-weight: lighter;'>Subject: ".$subject."</h3>";
	echo "<h3 style='font-weight: lighter;'>Chapter: ".$chapter."</h3>";
	echo "<h3 style='font-weight: lighter;'>Keyword: ".$keyword."</h3>";
	echo "<br><p style='color: green; font-weight: bolder'>You can Skip the keyword for best search.</p>";
	echo "</div>";
} else {
	$e = "SELECT * FROM tutorial WHERE subject LIKE '%$subject%' AND class LIKE '%$class%' AND chapter LIKE '%$chapter%' AND (title LIKE '%$keyword%' OR tags LIKE '%$keyword%') ORDER BY 
CASE
WHEN title = '$keyword' THEN 0
WHEN title LIKE '$keyword%' THEN 1
WHEN title LIKE '_$keyword%' THEN 2
WHEN title LIKE '__$keyword%' THEN 3
WHEN title LIKE '%$keyword%' THEN 4
WHEN tags LIKE '%$keyword%' THEN 5
END, title,tags";
$g = mysqli_query($db,$e);
	echo "<div style='margin-top: 10px; padding: 10px; border: 1px solid #ccc; background: #fcfcfc'>Search result found: <b style='font-weight: 600; font-family: arial;'>".mysqli_num_rows($g)."</b></div>";

}
}
while ($row=mysqli_fetch_array($q)) {
	?>
<div class="area_content" style="margin: 10px auto;">
	<h2 class="title" style="text-align: center;"><?php echo $row['title'] ?> <br><span style="font: 16px cursive">By</span> <a href="<?php get_domain("/profile/".$row['teacher']) ?>" onclick="query_url(event,this,'from_main_body','<?php echo $row['teacher'] ?> | PaiPixel Online Exam','<?php get_domain("/profiles/".$row['teacher']) ?>')" style="font-size: 19px"><?php echo $row['teacher'] ?></a>
	<br>
	<span style="font: 16px tahoma"><?php echo $row['chapter'] ?>, <?php echo $row['subject'] ?> for class <?php echo $row['class'] ?></span>

<?php 

	date_default_timezone_set("Asia/Dhaka");
	$date_time = date("Y-m-d H:i:s");
	$status;
$datetime = $row['date_time'];
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



 ?><br>
	<span style="font: 10px tahoma"><?php echo $status ?></span>
	
	 </h2>
	<div class="main_content" style=" font-family: tahoma; color: #555; letter-spacing: 2px; line-height: 130%;margin: 10px auto;padding: 0px 10px; border-left: 3px solid #ccc;">
	<?php echo $row['content'] ?>	
	</div>
		<h4 href="" class="" style="clear: both;padding: 10px">Sold	<b class="arial"><?php echo $row['selltime'] ?> </b> Copies</h4>


	<div class="comment_center button_set" style="overflow: hidden;padding: 10px; display: block;">
		<?php 
		$cn1 = '';
		$cn2 = '';
		$ac1 = '';
		$ac2 = '';
if ($row['price']==0) {
	$cn1 =  "Free download full article without video";
} else {
	$cn1 =  "Buy full article without video <b>".$row['price']."BDT </b>";
}
if ($row['vprice']==0) {
	$cn2 =  "Free download full article with video";
} else {
	$cn2 =  "Buy full article with video <b>".$row['vprice']."BDT </b>";
}


		?>
		<a href="" class="button button_standard" style="float: right"><?php echo $cn2 ?></a>
		<a href="" class="button button_standard" style="float: right"><?php echo $cn1 ?></a> 
	</div>


</div>
	<?php
}
?>
<?php 

if (isset($_GET['page'])) {
$page = $_GET['page'];
$sql = "SELECT * FROM tutorial WHERE subject LIKE '%$subject%' AND class LIKE '%$class%' AND chapter LIKE '%$chapter%' AND (title LIKE '%$keyword%' OR tags LIKE '%$keyword%') ORDER BY 
CASE
WHEN title = '$keyword' THEN 0
WHEN title LIKE '$keyword%' THEN 1
WHEN title LIKE '_$keyword%' THEN 2
WHEN title LIKE '__$keyword%' THEN 3
WHEN title LIKE '%$keyword%' THEN 4
WHEN tags LIKE '%$keyword%' THEN 5
END, title,tags";
$total = mysqli_num_rows(mysqli_query($db,$sql));
if ($total<1) {
	exit();
}



function page_detect($page,$total,$limit,$s){
$crnt = $page;
$page_number = ceil($total/$limit);
echo "<ul class='pagination_bar'>";
if ($crnt==1) {
		?>
<li class="pagenation_list"><a href="javascript:void(0)"><<</a></li>
<li class="pagenation_list"><a href="javascript:void(0)"><</a></li>
		<?php 
	} else {
	?>
<li class="pagenation_list"><a href="javascript:void(0)" onclick="tu_page(1)"><<</a></li>
<li class="pagenation_list"><a href="javascript:void(0)" onclick="tu_page(<?php echo ($crnt-1) ?>)"><</a></li>
	<?php
}
for ($i=0; $i < $page_number; $i++) { 
	if (($i+1)==$crnt) {
		?>
<li class="pagenation_list"><a href="javascript:void(0)" class="selected_crnt_page"><?php echo ($i+1) ?></a></li>
		<?php 
	} else {
	?>
<li class="pagenation_list"><a href="javascript:void(0)" onclick="tu_page(<?php echo ($i+1) ?>)"><?php echo ($i+1) ?></a></li>
	<?php
}
}
if ($crnt==$page_number) {
		?>
<li class="pagenation_list"><a href="javascript:void(0)" disabled>></a></li>
<li class="pagenation_list"><a href="javascript:void(0)" disabled>>></a></li>
		<?php 
	} else {
	?>
<li class="pagenation_list"><a href="javascript:void(0)" onclick="tu_page(<?php echo ($crnt+1) ?>)">></a></li>
<li class="pagenation_list"><a href="javascript:void(0)" onclick="tu_page(<?php echo ($page_number) ?>)">>></a></li>
	<?php
}
echo "</ul>";
?>
<style>
	.pagination_bar{
	width: 100%;
	text-align: center;
	background: white;
	padding: 1%;
}
.pagenation_list {
	display: inline-block;
	margin-left: -3px;
}
.pagenation_list a {
	text-decoration: none;
	color: #242424;
	background: linear-gradient(rgba(215,215,220),rgba(225,225,230));
	padding: 10px 20px;
	display: block;
}
.pagenation_list a.selected_crnt_page {
	background: tomato !important;
}
.pagenation_list a:hover {
	background: yellowgreen;
}

</style>
<?php
}
page_detect($page,$total,$page_per_post,1);
}

 ?>
 	</div>