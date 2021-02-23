<?php include 'db.php'; ?>
<?php $user = $_POST['user']; 
	$sql = "SELECT * FROM user WHERE user_name = '$user'";
	$q = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($q);
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$role = $row['role'];
	$email = $row['email'];
	$phone_number = $row['phone_number'];
	$class = $row['class'];
	$school = $row['school'];
	$Address = $row['Address'];
	$google_location = $row['google_location'];
	$interested = $row['interested'];
	$bio = $row['bio'];
	$rating = $row['rating'];
	$image = $row['image'];
	$friend = $row['friend'];
	$friend = explode(',', $friend);
	$balance = $row['balance'];
	$active = $row['active'];
	$background = $row['background'];
	$phone_confirm = $row['phone_confirm'];
	$email_confirm = $row['email_confirm'];
	$datetime = $row['datetime'];
	$depertment = $row['depertment'];
	$ppaa = $row['perfect_aa'];
	$maxrate = $row['max-rate'];
	$team = $row['team'];
?>
<style>
@media (max-width: 572px) {
	.atodin {
		width: 100% !important;
	}
	.noti {
		width: 100% !important;
	}
}
</style>
<div class="account_view">

<?php if ($user=='TravellerAlim'){ ?>
	
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;"> <?php echo $first_name; ?> <?php echo $last_name; ?></span>
</h3>
<?php 


$a1=0;
$a2=0;
$a3=0;
$a4=0;
$a5=0;


// ask_teacher
$sql = "SELECT id FROM ask_teacher WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM question_like WHERE question_id='$id' AND pending=1";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a1+= $row[0];

}
// echo "Question LIKE: ". $a1; br();

// ask ans

$sql = "SELECT id FROM ans_ask WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM answer_like WHERE question_id='$id'";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a2 += $row[0];

}
// echo "Answer Like: ".$a2; br();
// announce

$sql = "SELECT id FROM announce WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM blog_vote WHERE question_id='$id'";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a3 += $row[0];

}
// echo "Blog Like: ".$a3; br();

// blog_comment

$sql = "SELECT id FROM blog_comment WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM blog_cm_like WHERE question_id='$id'";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a4 += $row[0];

}
// echo "Blog comment LIKE: ".$a4; br();


// question

$sql = "SELECT id FROM question WHERE setter='$user' AND pending=1";
$m = mysqli_query($db,$sql);
$row = mysqli_num_rows($m);
$a5 = $row;
// echo "Question Add: ".$a5; br();
$dc="";
$cc = $a5*2+$a4+$a3+$a2+$a1;
if ($cc>0) {
	$dc.="+".$cc;
}else{
	$dc.=$cc;
}
?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Community Contribution (CC): </span><span style="color: purple;vertical-align: top;font: 20px arial; font-weight: bold;"><?php echo color(arial($dc),"green"); ?></span>
</h3>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Balance(BDT ): </span><span style="color: purple;vertical-align: top;font: 20px arial; font-weight: bold;">BDT <?php echo $balance; ?></span>
</h3>
<?php 
$sql = "SELECT id FROM question WHERE setter = '$user' AND pending=1";
$ag = mysqli_query($db,$sql);
$row1 = mysqli_num_rows($ag);
 ?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Total Added Questions: </span><span style="color: purple;vertical-align: top;font: 20px arial; font-weight: bold;"><?php echo color(arial($row1),"purple"); ?></span>
</h3>
<?php exit(); } ?>

<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;"> <?php echo $first_name; ?> <?php echo $last_name; ?></span>
</h3>

<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Institution: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo $school; ?></span>
</h3>
<?php if ($role==1): ?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Department/Group: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo $depertment; ?></span>
</h3>
<?php endif ?>
<?php if ($role==2): ?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Department/Major: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo $school; ?></span>
</h3>
<?php 
$sql = "SELECT id FROM question WHERE setter = '$user' AND pending=1";
$ag = mysqli_query($db,$sql);
$row1 = mysqli_num_rows($ag);
 ?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Total Added Questions: </span><span style="color: purple;vertical-align: top;font: 20px arial; font-weight: bold;"><?php echo color(arial($row1),"purple"); ?></span>
</h3>
<?php endif ?>
<?php 
if ($role==1) {
?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Rating: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo rating($rating); ?></span> (<span style="color: #000;">Max Rating: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo rating($maxrate); ?></span>)
</h3>

<?php
}else {
?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Average Accuracy (AA): </span><span style="color: purple;vertical-align: top;font: 20px arial; font-weight: bold;"><?php echo arial(number_format($rating,2)); ?>%</span>
</h3>
<?php
}
?>
<?php 


$a1=0;
$a2=0;
$a3=0;
$a4=0;
$a5=0;


// ask_teacher
$sql = "SELECT id FROM ask_teacher WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM question_like WHERE question_id='$id' AND pending=1";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a1+= $row[0];

}
// echo "Question LIKE: ". $a1; br();

// ask ans

$sql = "SELECT id FROM ans_ask WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM answer_like WHERE question_id='$id'";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a2 += $row[0];

}
// echo "Answer Like: ".$a2; br();
// announce

$sql = "SELECT id FROM announce WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM blog_vote WHERE question_id='$id'";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a3 += $row[0];

}
// echo "Blog Like: ".$a3; br();

// blog_comment

$sql = "SELECT id FROM blog_comment WHERE user='$user'";
$m = mysqli_query($db,$sql);

while($row = mysqli_fetch_array($m)){
$id = $row[0];
// question_like

$sql = "SELECT SUM(vote) FROM blog_cm_like WHERE question_id='$id'";
$asdfg = mysqli_query($db,$sql);
$row = mysqli_fetch_array($asdfg);
$a4 += $row[0];

}
// echo "Blog comment LIKE: ".$a4; br();


// question

$sql = "SELECT id FROM question WHERE setter='$user' AND pending=1";
$m = mysqli_query($db,$sql);
$row = mysqli_num_rows($m);
$a5 = $row;
// echo "Question Add: ".$a5; br();
$dc="";
$cc = $a5+$a4+$a3+$a2+$a1;
if ($cc>0) {
	$dc.="+".$cc;
}else{
	$dc.=$cc;
}
?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Community Contribution (CC): </span><span style="color: purple;vertical-align: top;font: 20px arial; font-weight: bold;"><?php echo color(arial($dc),"green"); ?></span>
</h3>
<?php if ($role==1): ?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Perfect Accuracy Won: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo ($ppaa); ?> Exams</span>
</h3>
<?php endif ?>

<?php if ($role==2): ?>
	
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Balance(BDT ): </span><span style="color: purple;vertical-align: top;font: 20px arial; font-weight: bold;">BDT <?php echo $balance; ?></span>
</h3>
<?php endif ?>
<?php if ($role==1): ?>

<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Remaining Exams: </span><span style="color: purple;vertical-align: top;font: 20px arial; font-weight: bold;"><?php echo $balance; ?></span>
</h3>

	

<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Lifetime Score: </span><span style="color: purple;vertical-align: top;font: 20px arial;">
		<?php 
$sql = "SELECT SUM(score) FROM score_leader_board WHERE user_name='$user'";
				$o = mysqli_query($db,$sql);
				$score = mysqli_fetch_array($o);
echo number_format($score[0],3);
		?>
	</span>
</h3>



<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Question Attempted: </span><span style="color: purple;vertical-align: top;font: 20px arial;">
		<?php 
		$sql = "SELECT SUM(total) FROM score_leader_board WHERE user_name='$user'";
		$ao = mysqli_query($db,$sql);
		$total = mysqli_fetch_array($ao);
		echo $total[0];
		?>
	</span>
</h3>


<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Class: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo $class; ?></span>
</h3>



<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Friends Of: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo count($friend)-1; ?> Users</span>
</h3>

<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Team: </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo get_team($team) ?></span>
</h3>

<?php endif ?>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Phone Number : </span><span style="font: 20px arial;"><?php echo $phone_number ?></span>
</h3>
<?php if ($email!='') {
?>

<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Email : </span><span style="font: 20px arial;"><?php echo $email ?></span>
</h3>
<?php
} ?>
<?php if ($Address!='') {
?>

<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Address : </span><span style="font: 20px arial;"><?php echo $Address ?></span>
</h3>
<?php
} ?>
<?php if ($bio!='') {
?>

<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Bio : </span><span style="font: 20px arial;"><?php echo $bio ?></span>
</h3>
<?php
} ?>
<?php 

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



 ?>

 <h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Registered : </span><span style="color: purple;vertical-align: top;font: 20px arial;"><?php echo $status ?></span>
</h3>
<h3 style="vertical-align: top; overflow: hidden;">
	<span class="material-icons" style="font-size: 25px; vertical-align: top; color: tomato; float: left;">star_rate</span>
	<span style="color: #000;">Status : </span><span style="color: green; font: 20px arial;" id="status_report<?php echo $id; ?>">Active</span>
</h3>

<?php 
if ($role==2) {
?>

      <div class="my_qualification">
<?php 

$aa = more_user("rating",$user);
?>
<?php 
$sql = "SELECT * FROM teachers_qualifications WHERE user='$user' AND qualify=1 ORDER BY score DESC";
$m = mysqli_query($db,$sql);

?>
<h3 style="color: black;">Qualified Subjects: <?php echo color(arial(mysqli_num_rows($m)),"purple") ?></h3>
<?php
if (mysqli_num_rows($m)==0) {
    echo "<p style='color: blue'>".$user." hasn't been qualified yet.</p>";
}

$sql = "SELECT * FROM teachers_qualifications WHERE user='$user' GROUP BY class,subject ORDER BY score DESC";
$m = mysqli_query($db,$sql);
?>
<table class="func_table" style="width: 100%; border: 1px solid green">
    <tr>
        <th>Class</th>
        <th>Subject</th>
        <th>Score</th>
        <th>Accuracy</th>
        <th>Qualification Status</th>
    </tr>
<?php

while ($row = mysqli_fetch_array($m)) {
$classt= $row['class'];
$subjectt= $row['subject'];
$sql = "SELECT * FROM teachers_qualifications WHERE user='$user' AND class='$classt' AND subject='$subjectt' ORDER BY ((score*100)/total) DESC";
$p = mysqli_query($db,$sql);
$row = mysqli_fetch_array($p);
?>
<tr>
    <td><?php if($row['class']==9){echo "9-10";}else if($row['class']==11){echo "11-12";} else { echo $row['class'];} ?></td>
    <td><?php echo $row['subject'] ?></td>
    <td style="font-family: arial;"><?php echo color(number_format($row['score'],2),"#20b99d"); ?> out of <?php echo $row['total'] ?></td>
    <td style="font-family: arial;"><?php echo color(number_format((($row['score'])*100)/($row['total']),2)."%","#20b99d") ?></td>
    <td>
        <?php 
if ($row['qualify']==1) {
    echo color("Qualified","green");
} else {
    echo color("Disqualified","red");
}
        ?>
    </td>

</tr>
<?php
}
if (mysqli_num_rows($m)!=0) {
?>
</table>
<?php } ?>
</div>

<?php 
if ($role!=2) {
	?>
<iframe src="<?php get_domain("/graph_it.php?user=") ?><?php echo $user; ?>"></iframe>

	<?php
}
}
 ?>

























