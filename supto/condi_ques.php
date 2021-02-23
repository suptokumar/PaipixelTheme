<?php 
include 'db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Question adding conditions</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!-- The Css Links -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- Icon -->
	<link rel="icon" href="../image/favicon.png">
	<!-- Default Css Links -->
	<link rel="stylesheet" href="../css/main.css?qs">
	<link rel="stylesheet" href="../css/table.css?q">
	<script>
function get_subject(id,clas)
{
	$.ajax({
		url: '<?php get_domain("/ajax/teacher/subject.php") ?>',
		type: 'GET',
		data: {class: clas},
	})
	.done(function(data) {
		$("#"+id).html(data);
	});
	
}
</script>
<script>
function get_chapter(id,clas,subject)
{
	$.ajax({
		url: '<?php get_domain("/ajax/teacher/oddhay.php") ?>',
		type: 'GET',
		data: {class: clas, subject: subject},
	})
	.done(function(data) {
		$("#"+id).html(data);
	});
	
}
</script>
</head>
<body>
<form action="" method="POST" style="width: 1000px; margin: 1% auto; padding: 1%; border: 1px solid #ccc; background: white;">
	<?php 
	if (isset($_POST['submit'])) {

date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
$title = $_POST['title'];
$type = $_POST['type'];
$desc = $_POST['desc'];
$class = $_POST['class'];
$subject = $_POST['subject'];
$chapter = $_POST['chapter'];
$maxq = $_POST['maxq'];
$sql = "INSERT INTO `question_condi` (`id`, `title`, `description`, `class`, `subject`, `chapter`, `max`, `total`, `datetime`, `type`) VALUES (NULL, '$title', '$desc', '$class', '$subject', '$chapter', '$maxq', '0', '$date', '$type')" ;
if (mysqli_query($db,$sql)) {
	echo "Successfuly Added this Statement !";
	$sql = "SELECT id FROM question_condi ORDER BY id DESC LIMIT 1";
	$m = mysqli_query($db,$sql);

	$row = mysqli_fetch_array($m);
	echo "statement Id: ".arial($row[0]);
} else {
	echo "Failed to Add this Statement.";
}
}
 ?>
<input type="text" name="title" class="input" placeholder="Title">
<textarea name="desc" placeholder="Description" class="input"></textarea>
<input type="number" class="input" name="maxq" placeholder="Max Questions">
<select name="class" class="input" id="class" onchange="get_subject('subject',this.value);">
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
</select>
<select name="subject" class="input" id="subject" onchange="get_chapter('chapter',document.getElementById('class').value,this.value)"></select>
<select name="chapter" class="input" id="chapter"></select>
<select name="type" id="type" class="input">
	<option value="1">Question Bank</option>
	<option value="2">Live Exam</option>
</select>
<input type="submit" name="submit" value="Submit" class="cd_button" style="padding: 10px">
</form>
		<script>
		$(document).ready(function() {
			get_subject("subject",6);
			get_chapter("chapter",6,"বাংলা প্রথম পত্র");
		});
	</script>
</body>
</html>
