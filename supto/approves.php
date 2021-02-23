
<?php 
include 'db.php';
$s = $_POST['search'];
$exam_name = $_POST['exam_name'];
$duration = $_POST['duration'];
$date = $_POST['date'];

$sql = "UPDATE question SET pending=1,name='$exam_name',exam_duration='$duration',exam_starting_date='$date' WHERE exam_id='$s'";
if (mysqli_query($db,$sql)) {
	echo "Approved !";
}

$sql = "SELECT * FROM question WHERE exam_id='$s'";
$m = mysqli_query($db,$sql);
$row = mysqli_fetch_array($m);

$class = $row['class'];
$subject = $row['subject'];
$chapter = $row['chapter'];


$bal = 0;

if($subject=='গনিত' || $subject=='উচ্চতর গনিত' || $subject=='উচ্চতর গনিত প্রথম পত্র' || $subject=='উচ্চতর গনিত দ্বিতীয় পত্র'){
	$bal = 4;
} else if($subject=='রসায়ন' || $subject=='পদার্থ বিজ্ঞান' || $subject=='রসায়ন প্রথম পত্র' || $subject=='রসায়ন দ্বিতীয় পত্র' || $subject=='পদার্থ বিজ্ঞান পত্র' || $subject=='পদার্থ বিজ্ঞান দ্বিতীয় পত্র'){
	$bal = 3.5;
}  else if($subject=='জীববিজ্ঞান' || $subject=='সাধারণ বিজ্ঞান' || $subject=='হিসাববিজ্ঞান' || $subject=='ফিন্যান্স ও ব্যাংকিং' || $subject=='তথ্য ও যোগাযোগ প্রযুক্তি' || $subject=='পদার্থ বিজ্ঞান দ্বিতীয় পত্র' || $subject=='ইংরেজি প্রথম পত্র' || $subject=='ইংরেজি দ্বিতীয় পত্র'){
	$bal = 3;
} else {
	$bal = 2.5;
}

$q_t = mysqli_num_rows($m);
$bal = $bal*$q_t;
$sql = "SELECT setter FROM question WHERE id='$s'";
$r = mysqli_query($db,$sql);
$row = mysqli_fetch_array($r);
$setter = $row[0];

$sql = "UPDATE user SET cc=cc+2 WHERE user_name='$setter'";
mysqli_query($db,$sql);

$sql = "SELECT * FROM user WHERE user_name='$setter'";
$m = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m);
$balance = $r['balance'];
$bal += ($balance);
$sql = "UPDATE user SET balance='$bal' WHERE user_name='$setter'";
mysqli_query($db,$sql);

?>