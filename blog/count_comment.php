<?php 
$db = mysqli_connect("localhost","paipixel_supto","Sk571960","paipixel_real") OR die("no connectiong available.");
$id = $_POST['id'];
$sql = "SELECT * FROM `blog_comment` WHERE blog_id='$id'";
$m = mysqli_query($db,$sql);
if (mysqli_num_rows($m)>1) {
echo mysqli_num_rows($m). " Comments";
} else {
echo mysqli_num_rows($m). " Comment";
}
?><?php  mysqli_close($db); ?>