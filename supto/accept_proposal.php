<?php 
include 'db.php';
$user = $_POST['user'];
$ref  = $_POST['ref'];

$sql = "UPDATE  proposal SET accept=1 WHERE user='$user' AND ref='$ref'";
mysqli_query($db,$sql);
$sql = "UPDATE question_condi SET assign='$user' WHERE id='$ref'";
mysqli_query($db,$sql);
$link = return_domain("/")."exam.php?add_question&ref=".$ref;
$content = "Your proposal has been accepted for <b>PaiPixel Individual Exam</b>. <em>click here</em> to add questions.";
send_notification($user,$link,$content);
echo "Accepted";
?>