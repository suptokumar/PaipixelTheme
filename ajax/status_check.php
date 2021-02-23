<?php 
include 'db.php';

$profile = $_POST['profile'];

$sql = "SELECT * FROM user WHERE user_name='$profile'";
$q= mysqli_query($db,$sql);
$row = mysqli_fetch_array($q);
	$active = $row['active'];
	if ($active=="0000-00-00 00:00:00") {
	$datetime = $row['datetime'];
		
	date_default_timezone_set("Asia/Dhaka");
	$date_time = date("Y-m-d H:i:s");
	$status;

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

echo  $status;
exit();
}
	$reg = 
	date_default_timezone_set("Asia/Dhaka");
	$date_time = date("Y-m-d H:i:s");
	$status;
	if ((strtotime($date_time)-strtotime($active))>10) {


$inputSeconds = (strtotime($date_time)-strtotime($active));

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
	} else {
		$status="active";
	}

echo $status;

?>