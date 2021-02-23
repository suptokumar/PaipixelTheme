<?php 
if (isset($_POST['id'])) {

$id=$_POST['id'];
$content = $_POST['content'];
$tag = $_POST['hero-demo'];
$title = $_POST['title'];
$class = $_POST['class'];
$subject = $_POST['subject'];
$youtube_link = $_POST['youtube_link'];
$short_desc = $_POST['short_desc'];
$type = $_POST['ts25'];
$price = $_POST['price'];
$vprice = $_POST['vprice'];
$chapter = $_POST['chapter'];

if ($type == 'free') {
	$price = 0;
	$vprice = 0;
}
include '../extra/db.extra.php';
date_default_timezone_set("Asia/Dhaka");
$show_date = date("d M Y, h:i a");
$date_time = date("Y-m-d H:i:s");
$loc = return_domain("/upload/");
session_start();
if (!isset($_SESSION['login_data_paipixel24'])) {
	echo "Login Error";
} else {

	$teacher = $_SESSION['login_data_paipixel24'];
}


$r = rand();
if (isset($_FILES["file"]["name"]) && basename($_FILES["file"]["name"])!='') {
$a = '../../upload/'.$r.basename( $_FILES["file"]["name"]);
if (move_uploaded_file($_FILES["file"]["tmp_name"], $a)) {
 $short_desc = $loc.$r.basename( $_FILES["file"]["name"]);
} else {
	$short_desc = '';
	echo "Failed to upload<br>";
}
}
if ($short_desc!='') {
	
$sql = "UPDATE tutorial SET title='$title',class='$class',subject='$subject',youtube='$youtube',content='$content',tags='$tag',price='$price',type='$type', description='$short_desc',teacher='$teacher', chapter='$chapter', vprice='$vprice' WHERE id='$id'";

} else {

$sql = "UPDATE tutorial SET title='$title',class='$class',subject='$subject',youtube='$youtube',content='$content',tags='$tag',price='$price',type='$type', teacher='$teacher', chapter='$chapter', vprice='$vprice' WHERE id='$id'";

}
if (mysqli_query($db,$sql)) {
	echo "Tutorial Updated";
} else {
	echo "Failed to Update the Tutorial";
}
}
?>









<?php 
$content = $_POST['content'];
$tag = $_POST['hero-demo'];
$title = $_POST['title'];
$class = $_POST['class'];
$subject = $_POST['subject'];
$youtube_link = $_POST['youtube_link'];
$short_desc = $_POST['short_desc'];
$type = $_POST['ts25'];
$price = $_POST['price'];
$vprice = $_POST['vprice'];
$chapter = $_POST['chapter'];

if ($type == 'free') {
	$price = 0;
	$vprice = 0;
}
include '../extra/db.extra.php';
date_default_timezone_set("Asia/Dhaka");
$show_date = date("d M Y, h:i a");
$date_time = date("Y-m-d H:i:s");
$loc = return_domain("/upload/");
session_start();
if (!isset($_SESSION['login_data_paipixel24'])) {
	echo "Login Error";
} else {

	$teacher = $_SESSION['login_data_paipixel24'];
}


$r = rand();
if (isset($_FILES["file"]["name"]) && basename($_FILES["file"]["name"])!='') {
$a = '../../upload/'.$r.basename( $_FILES["file"]["name"]);
if (move_uploaded_file($_FILES["file"]["tmp_name"], $a)) {
 $short_desc = $loc.$r.basename( $_FILES["file"]["name"]);
} else {
	echo "Failed to upload<br>";
}
}


$sql = "INSERT INTO `tutorial` ( `title`, `class`, `subject`, `youtube`, `content`, `tags`, `price`, `type`, `description`, `view`, `currency`, `selltime`, `show_time`, `date_time`, `teacher`, `chapter`, `vprice`) VALUES ('$title', '$class', '$subject', '$youtube_link', '$content', '$tag', '$price', '$type', '$short_desc', '0', '0', '0', '$show_date', '$date_time', '$teacher','$chapter','$vprice')";
if (mysqli_query($db,$sql)) {
	echo "Tutorial Saved";
} else {
	echo "Failed to save the Tutorial";
}
?>