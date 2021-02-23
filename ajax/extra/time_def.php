<?php 
include 'db.extra.php';
date_default_timezone_set("Asia/Dhaka");
$go = strtotime($_GET['time']);
$date = time() - $go;
$status;

$inputSeconds = $date;


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
	$status = $years." Year ".$months." Months";
}
if ($inputSeconds<31536001) {
	$status = $months." Months ".$days." Days";
}
if ($inputSeconds<2628001) {
	$status = $days." Days ".$hours." Hours";
}
if ($inputSeconds<86401) {
	$status = $hours." Hours ".$minutes." Minutes";
} 
if($inputSeconds<3601) {
	$status = $minutes." Minutes ".$seconds." seconds";
}

echo $status;
?>