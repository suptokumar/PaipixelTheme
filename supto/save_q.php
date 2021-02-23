<?php 
include 'db.php';
$s = $_POST['id'];
  $q =  $_POST['q'.(1)];
	$opt1 = $_POST['opt'.(1).'1'];
	$opt2 = $_POST['opt'.(1).'2'];
	$opt3 = $_POST['opt'.(1).'3'];
	$opt4 = $_POST['opt'.(1).'4'];
	$currect = $_POST['currect'.(1)];
$Exam_name = $_POST['topic'.(1)];
	$tips = $_POST['tips'.(1)];
	$explain = $_POST['explain'.(1)];



$explain_eo = '';


if (isset($_FILES["audio".(1)]) && !empty($_FILES["audio".(1)]["name"])) {
	
$target_dir = "../content/";
$target_file = $target_dir . rand() . basename($_FILES["audio".(1)]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["audio".(1)]["tmp_name"]);
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
  if (move_uploaded_file($_FILES["audio".(1)]["tmp_name"], $target_file)) {
    $audio = $target_file;
    $explain_eo=' <audio controls>
  <source src="'.return_domain("/ajax/").$audio.'" type="'.$aut_type.'">
Your browser does not support the audio element.
</audio> ';
  }
}

}

if ($explain_eo=='') {
$sql = "UPDATE `question` SET `Exam_name` = '$Exam_name', `question` = '$q', `opt1` = '$opt1', `opt2` = '$opt2', `opt3` = '$opt3', `opt4` = '$opt4', `currect` = '$currect', `tips` = '$tips', `details` = '$explain', `pending` = '0'  WHERE `question`.`id` = '$s' ";
} else {
$sql = "UPDATE `question` SET `Exam_name` = '$Exam_name', `question` = '$q', `opt1` = '$opt1', `opt2` = '$opt2', `opt3` = '$opt3', `opt4` = '$opt4', `currect` = '$currect', `tips` = '$tips', `details` = '$explain', `pending` = '0', `audio_explain` = '$explain_eo' WHERE `question`.`id` = '$s' ";
}

if (mysqli_query($db,$sql)) {
	echo "Succcess";
}
?>