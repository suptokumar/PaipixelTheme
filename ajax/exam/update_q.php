<?php 
include '../extra/db.extra.php';
session_start();
if (!isset($_SESSION['login_data_paipixel24'])) {
	echo "Login Error";
	exit();
}
$setter = $_SESSION['login_data_paipixel24'];
$class = $_POST['class'];
$subject = $_POST['subject'];
if (isset($_POST['duration'])) {
$duration = $_POST['duration'];
} else {
$duration = '';
}
if (isset($_POST['date'])) {
$date = $_POST['date'];
} else {
$date = '';
}
$chapter = $_POST['chapter'];
$qno = $_POST['qno'];
$cout = intval($qno);
date_default_timezone_set("Asia/Dhaka");
$date_time = date("Y-m-d H:i:s");
$exam_id = date("YmdHis");

















$qu_type = $_POST['qu_type'];
$ref = $_POST['ref'];
$numb = $_POST['numb'];
if ($qu_type==1) {
	$exam_id = 0;
} else {
	$exam_id = user_detail("id").$ref;
	$message = $_POST['message'];
$sql = "INSERT INTO `proposal` (`id`, `proposal`, `date`, `ref`, `user`) VALUES (NULL, '$message', '$date_time', '$ref', '$setter')";
mysqli_query($db,$sql);
}
$success=true;
for ($i=0; $i < $numb; $i++) { 
	
	$q =  $_POST['q'.($i)];
	$opt1 = $_POST['opt'.($i).'1'];
	$opt2 = $_POST['opt'.($i).'2'];
	$opt3 = $_POST['opt'.($i).'3'];
	$opt4 = $_POST['opt'.($i).'4'];
	$currect = $_POST['currect'.($i)];
$Exam_name = $_POST['topic'.($i)];
	$tips = $_POST['tips'.($i)];
	$explain = $_POST['explain'.($i)];



$explain_eo = '';


if (isset($_FILES["audio".($i)]) && !empty($_FILES["audio".($i)]["name"])) {
	
$target_dir = "../../content/";
$target_file = $target_dir . rand() . basename($_FILES["audio".($i)]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["audio".($i)]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, Image already exists.";
  $uploadOk = 0;
}


// Allow certain file formats
if($imageFileType != "mp3" && $imageFileType != "wav" && $imageFileType != "ogg") {
  echo "Sorry, only MP3, WAV and  OGG files are allowed.";
  $uploadOk = 0;
}
$aut_type = 'mpeg';
if ($imageFileType=="mp3") {
	$aut_type = 'audio/mpeg';
}
if ($imageFileType=="ogg") {
	$aut_type = 'audio/ogg';
}
if ($imageFileType=="wav") {
	$aut_type = 'audio/wav';
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["audio".($i)]["tmp_name"], $target_file)) {
    $audio = $target_file;
    $explain_eo=' <audio controls>
  <source src="'.return_domain("/ajax/ask_teacher/").$audio.'" type="'.$aut_type.'">
Your browser does not support the audio element.
</audio> ';
  }
}

}


$rep = '';





if ($q!='') {
	$q=str_replace("'", "\'", $q);
	$opt1=str_replace("'", "\'", $opt1);
	$opt2=str_replace("'", "\'", $opt2);
	$opt3=str_replace("'", "\'", $opt3);
	$opt4=str_replace("'", "\'", $opt4);
	$explain=str_replace("'", "\'", $explain);
	$Exam_name=str_replace("'", "\'", $Exam_name);
$sql = "INSERT INTO `question` (`exam_id`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `currect`, `exam_starting_date`, `exam_duration`, `setter`, `registered`, `class`, `subject`, `chapter`,`date_time`,`Exam_name`,`tips`,`details`,`audio_explain`) VALUES ('$exam_id', '$q', '$opt1', '$opt2', '$opt3', '$opt4', '$currect', '$date', '$duration', '$setter', ',', '$class', '$subject', '$chapter', '$date_time', '$Exam_name', '$tips', '$explain', '$explain_eo')";
if (mysqli_query($db,$sql)) {
$rep = "<h2 style='color: green; text-align: center;padding: 10px'>Successfuly Added !</h2>";
$success=true;

if ($qu_type!=2) {
$sql = "UPDATE question_condi SET total=total+1 WHERE id='$qno'";
mysqli_query($db,$sql);
}
} else {
$rep= "<h2 style='color: red; text-align: center;padding: 10px'>Failed To Add !</h2>";
$success= false;
}
} else {
	$rep= "<h2 style='padding: 10px'>Please Check All The options are correct.</h2>";
$success= false;
}


}

if ($qu_type==2) {
	?>
<header class="w3-container <?php if ($success) {
        	echo "w3-teal";
        } else {
        	echo "w3-red";
        } ?>"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright w3-xlarge">&times;</span>
        <h2><?php if ($success) {
        	echo "Success";
        } else {
        	echo "Failed";
        } ?></h2>
      </header>
      <div class="w3-container" id="sono">
        <?php echo "Successfully Submited."; ?>
        <script>
        	alert("<?php if ($success) {
        	echo "Success";
        } else {
        	echo "Failed";
        } ?>");
        	location.reload();
        </script>
      </div>
	<?php
	exit();
}

$sql = "SELECT id FROM question WHERE setter = '$setter'";
$m = mysqli_query($db,$sql);
$row1 = mysqli_num_rows($m);

$sql = "SELECT id FROM question WHERE setter = '$setter' AND pending=0";
$m = mysqli_query($db,$sql);
$row2 = mysqli_num_rows($m);
$sql = "SELECT id FROM question WHERE setter = '$setter' AND pending=1";
$m = mysqli_query($db,$sql);
$row3 = mysqli_num_rows($m);
$sql = "SELECT id FROM question WHERE setter = '$setter' AND pending=2";
$m = mysqli_query($db,$sql);
$row4 = mysqli_num_rows($m);

?>
<header class="w3-container <?php if ($success) {
        	echo "w3-teal";
        } else {
        	echo "w3-red";
        } ?>"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright w3-xlarge">&times;</span>
        <h2><?php if ($success) {
        	echo "Success";
        } else {
        	echo "Failed";
        } ?></h2>
      </header>
      <div class="w3-container" id="sono">
        <?php echo $rep ?>
      </div>
      <footer class="w3-container w3-teal">
       
<style>
.area {
  display: inline-block;
  text-align: center;
  padding: 3.2%;
  background: linear-gradient(#39d0b5,#7efbef);
  border: 1px solid #20b99d;
  box-shadow: 0px 1px 3px 1px #ccc;
}
@media (max-width: 744px) {
	.area{
		width: 40%;
		margin: 1%;
		font-size: 15px
	}
}
</style>
<style>
	
 .area {
		animation: area .4s;
	}
@keyframes area {
		0%{
			transform: rotate(45deg);
		}
	}
</style>
<div class="area">
	<h3>Total Added</h3>
	<h4  style="font-family: arial; padding-top: 7px; color: #0077f5"><?php echo $row1 ?></h4>
</div>
<div class="area">
	<h3>Total Pending</h3>
	<h4  style="font-family: arial; padding-top: 7px; color: #0077f5"><?php echo $row2 ?></h4>
</div>
<div class="area">
	<h3>Total Approved</h3>
	<h4  style="font-family: arial; padding-top: 7px; color: #0077f5"><?php echo $row3 ?></h4>
</div>
<div class="area">
	<h3>Total Rejected</h3>
	<h4  style="font-family: arial; padding-top: 7px; color: #0077f5"><?php echo $row4 ?></h4>
</div>
      </footer>