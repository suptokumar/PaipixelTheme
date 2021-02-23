<?php 
function get_domain($more = "")
{
	echo "http://".$_SERVER['HTTP_HOST'].$more;
}
function return_domain($more = "")
{
	return "http://".$_SERVER['HTTP_HOST'].$more;
}
function get_title(){
	echo "PaiPixel Online Exam";
}
function is_block($user){
	global $db;
	$usa = user_detail("user_name");
	$sql = "SELECT * FROM block WHERE (`from`='$user' AND `to`='$usa') OR (`from`='$usa' AND `to`='$user')";
	$m = mysqli_query($db,$sql);
	if (mysqli_num_rows($m)==0) {
		return true;
	} else {
		return false;
	}
}
function x($a)
{
	$role = user_detail("role");
	if ($role==1) {
		return $a;
	}
	if ($a=='Ask') {
		return "Answer";
	}
}
function weekly_pos($a)
{
	global $db;
	$sql = "SELECT * FROM weektime ORDER BY id DESC LIMIT 1";
	$m = mysqli_query($db,$sql);
	$r = mysqli_fetch_array($m);
	$date = $r['date'];
	$sql = "SELECT user_name FROM score_leader_board WHERE `date`>'$date' GROUP BY user_name ORDER BY SUM(score) DESC";
	$m  = mysqli_query($db,$sql);
	$i = 1;
	while ($r = mysqli_fetch_array($m)) {
if ($r[0]==$a) {
	return $i;
}

$i++;
	}
}
function block_content($user){
	global $db;
	$usa = user_detail("user_name");
	$sql = "SELECT * FROM block WHERE (`from`='$user' AND `to`='$usa')";
	$m = mysqli_query($db,$sql);
	if (mysqli_num_rows($m)!=0) {
		return "You are Blocked";
	}

	$sql = "SELECT * FROM block WHERE (`from`='$usa' AND `to`='$user')";
	$m = mysqli_query($db,$sql);
	if (mysqli_num_rows($m)!=0) {
		return "Unblock";
		

	}

	return "Block";
}
function is_page($name)
{
	if (isset($_GET[$name])) {
		return true;
	} else {
		return false;
	}
}
function is_friend($name)
{
	global $db;
	$usa = user_detail("user_name");
	$sql = "SELECT friend FROM user WHERE user_name='$usa'";
	$m = mysqli_query($db,$sql);
	$r = mysqli_fetch_array($m);
	$friend = explode(",",$r[0]);
	$dar = count($friend);
	for ($i=1; $i < $dar; $i++) { 
		if ($friend[$i]==$name) {
			return 1;
		}
	}
	return 0;

}
function int_rate($val){
if ($val=='Unrated') {
	return 0;
} else {
	return $val;
}
}
function get_number($id){
	global $db;
	$user = user_detail("user_name");
	$sql = "SELECT id FROM question WHERE setter='$user' AND pending=1 ORDER BY id ASC";
	$m = mysqli_query($db,$sql);
	$i=0;
	while ($row = mysqli_fetch_array($m)) {
		$i++;
		if ($row[0]==$id) {
			return $i;
		}
	}
}
function get_numbers($id,$user){
	global $db;
	$sql = "SELECT id FROM question WHERE setter='$user' AND pending=1 ORDER BY id ASC";
	$m = mysqli_query($db,$sql);
	$i=0;
	while ($row = mysqli_fetch_array($m)) {
		$i++;
		if ($row[0]==$id) {
			return $i;
		}
	}
}
function get_exam_id($id){
	global $db;
	$user = user_detail("user_name");
	$sql = "SELECT exam FROM exam_score WHERE user='$user' GROUP BY exam ORDER BY id ASC";
	$m = mysqli_query($db,$sql);
	$i=0;
	while ($row = mysqli_fetch_array($m)) {
		$i++;
		if ($row[0]==$id) {
			return $i;
		}
	}
}
function count_exam_no($id){
	global $db;
	$user = user_detail("user_name");
	$sql = "SELECT exam_id FROM question WHERE exam_id!=0 AND pending=1 GROUP BY exam_id ORDER BY id DESC";
	$m = mysqli_query($db,$sql);
	$i=0;
	while ($row = mysqli_fetch_array($m)) {
		$i++;
		if ($row[0]==$id) {
			return $i;
		}
	}
}
function get_question($id,$con){
	global $db;
	$user = user_detail("user_name");
	$sql = "SELECT $con FROM ask_teacher WHERE id='$id'";
	$m = mysqli_query($db,$sql);
	$r = mysqli_fetch_array($m);
	return $r[0];
}
function multipul_translate($val)
{
$len = strlen($val);
$st = "";
$st.= $val;
$r = '';
for ($i=0; $i < $len; $i++) { 
	$r.=translate($st[$i]);
}
return $r;
}
function translate($val)
{
	$len = strlen($val);
	if ($len>1) {
		return multipul_translate($val);
	}
if ($val==1) {
	return "১";
}
if ($val==2) {
	return "২";
}
if ($val==3) {
	return "৩";
}
if ($val==4) {
	return "৪";
}
if ($val==5) {
	return "৫";
}
if ($val==6) {
	return "৬";
}
if ($val==7) {
	return "৭";
}
if ($val==8) {
	return "৮";
}
if ($val==9) {
	return "৯";
}
if ($val=="A") {
	return "ক";
}
if ($val=="B") {
	return "খ";
}
if ($val=="C") {
	return "গ";
}
if ($val=="D") {
	return "ঘ";
}


return $val;
}
function color($doc,$val)
{
	return "<span style='color:".$val."'>".$doc."</span>";
}
function rating($val)
{
	if ($val==0 || $val=='') {
		return "<span style='color: black; font-weight: bold;'>Unrated</span>";
	}
	if ($val<1999) {
		return "<span style='color: gray; font-weight: bold;'>".$val."</span>";
	}
	if ($val<3999) {
		return "<span style='color: green; font-weight: bold;'>".$val."</span>";
	}
	if ($val<5999) {
		return "<span style='color: blue; font-weight: bold;'>".$val."</span>";
	}
	if ($val<7999) {
		return "<span style='color: #FFFF00; font-weight: bold;'>".$val."</span>";
	}
	if ($val<=9999) {
		return "<span style='color: red; font-weight: bold;'>".$val."</span>";
	}
}

function my_name($user)
{
	$val = more_user("rating",$user);
	$s = more_user("isnew",$user);
	if ($s==0) {
		return "<span style='color: black; font-weight: bold'>".$user."<span>";
	}
	if ($val==0 || $val=='') {
		return "<span style='color: gray; font-weight: bold'>".$user."<span>";
	}
	if ($val<1999) {
		return "<span style='color: gray; font-weight: bold'>".$user."<span>";
	}
	if ($val<3999) {
		return "<span style='color: green; font-weight: bold'>".$user."<span>";
	}
	if ($val<5999) {
		return "<span style='color: blue; font-weight: bold'>".$user."<span>";
	}
	if ($val<7999) {
		return "<span style='color: #FFFF00; font-weight: bold'>".$user."<span>";
	}
	if ($val<=9999) {
		return "<span style='color: red; font-weight: bold'>".$user."<span>";
	}
}
function get_exam_name($gt)
{
	include 'ajax/db_back.php';
	$sql = "SELECT * FROM question WHERE exam_id='$gt' AND pending=1 LIMIT 1";
	$q  = mysqli_query($db,$sql);
	$m = mysqli_fetch_array($q);
	return $m['name'];

}
function arial($a){
	return '<span style="font-family: arial;">'.$a.'</span>';
}



function get_contribute_position($gt)
{
	include 'ajax/db_back.php';
	$i=1;
	$add = '';
	$sql = "SELECT cc FROM user WHERE user_name!='TravellerAlim' ORDER BY cc DESC";
	$e = mysqli_query($db,$sql);
	while($score = mysqli_fetch_array($e)){
		if ($score[0]==$gt) {
			return $i;
		}
$i++;
	}
}



function cc_inst($class,$gt)
{
	include 'ajax/db_back.php';
	$i=1;
	$add = '';
	$sql = "SELECT cc FROM user WHERE role='$class' AND user_name!='TravellerAlim' ORDER BY cc DESC";
	$e = mysqli_query($db,$sql);
	while($score = mysqli_fetch_array($e)){
		if ($score[0]==$gt) {
			return $i;
		}
$i++;
	}
}



function teacher_position($gt)
{
	include 'ajax/db_back.php';
	$i=1;
	$add = '';
	$sql = "SELECT rating FROM user WHERE role=2 ORDER BY rating DESC";
	$e = mysqli_query($db,$sql);
	while($score = mysqli_fetch_array($e)){
		if ($score[0]==$gt) {
			return $i;
		}
$i++;
	}
}



function teacher_class($class,$gt)
{
	include 'ajax/db_back.php';
	$add = '';


	$sql = "SELECT * FROM `teachers_qualifications` WHERE class='$class'";
	$m = mysqli_query($db,$sql);
	$psql = "AND ( ";
	$i=0;
	$mt = mysqli_num_rows($m);
while ($row = mysqli_fetch_array($m)) {
	$i++;
	$i;
	$psql .=" user_name='".$row['user']."' ";
	if ($i==$mt) {
		$psql.=" )";
	} else {
		$psql.=" OR ";
	}
}
if ($psql == "AND ( ") {
	$psql="";
}
 $sql = "SELECT rating FROM user WHERE role=2 ".$psql. " ORDER BY rating DESC";
	$e = mysqli_query($db,$sql);
	$i=1;
	while($score = mysqli_fetch_array($e)){
		if ($score[0]==$gt) {
			return $i;
		}
$i++;
	}
}




function teacher_class_subject($class,$inst,$gt)
{
	include 'ajax/db_back.php';
	$add = '';


	$sql = "SELECT * FROM `teachers_qualifications` WHERE class='$class' AND subject='$inst'";
	$m = mysqli_query($db,$sql);
	$psql = "AND ( ";
	$i=0;
	$mt = mysqli_num_rows($m);
while ($row = mysqli_fetch_array($m)) {
	$i++;
	$i;
	$psql .=" user_name='".$row['user']."' ";
	if ($i==$mt) {
		$psql.=" )";
	} else {
		$psql.=" OR ";
	}
}
if ($psql == "AND ( ") {
	$psql="";
}



	$i=1;


	$sql = "SELECT rating FROM user WHERE role=2 ".$psql. " ORDER BY rating DESC";
	$e = mysqli_query($db,$sql);
	while($score = mysqli_fetch_array($e)){
		if ($score[0]==$gt) {
			return $i;
		}
$i++;
	}
}

function get_position_by_score($gt)
{
	include 'ajax/db_back.php';
	$i=1;
	$add = '';
	$sql = "SELECT SUM(score) FROM score_leader_board GROUP BY user_name ORDER BY SUM(score) DESC";
	$e = mysqli_query($db,$sql);
	while($score = mysqli_fetch_array($e)){
		if ($score[0]==$gt) {
			return $i;
		}
$i++;
	}
}


function position_class_inst($class,$institution,$gt)
{
	include 'ajax/db_back.php';
	$i=1;
	$add = '';
	$sql = "SELECT *,SUM(score) FROM score_leader_board GROUP BY user_name ORDER BY SUM(score) DESC";
	$e = mysqli_query($db,$sql);
	while($score = mysqli_fetch_array($e)){
		if (more_user("class",$score['user_name'])!=$class AND more_user("school",$score['user_name'])!=$institution) {
			continue;
		}
		if ($score['SUM(score)']==$gt) {
			return $i;
		}
$i++;
	}
}


function position_class($class,$gt)
{
	include 'ajax/db_back.php';
	$i=1;
	$add = '';
	$sql = "SELECT *,SUM(score) FROM score_leader_board GROUP BY user_name ORDER BY SUM(score) DESC";
	$e = mysqli_query($db,$sql);
	while($score = mysqli_fetch_array($e)){
		if (more_user("class",$score['user_name'])!=$class) {
			continue;
		}
		if ($score['SUM(score)']==$gt) {
			return $i;
		}
$i++;
	}
}


function position_inst($inst,$gt)
{
	include 'ajax/db_back.php';
	$i=1;
	$add = '';
	$sql = "SELECT *,SUM(score) FROM score_leader_board GROUP BY user_name ORDER BY SUM(score) DESC";
	$e = mysqli_query($db,$sql);
	while($score = mysqli_fetch_array($e)){
		if (strtoupper(more_user("school",$score['user_name']))!=$inst) {
			continue;
		}
		if ($score['SUM(score)']==$gt) {
			return $i;
		}
$i++;
	}
}






function get_position($gt)
{
	include 'ajax/db_back.php';
	$sql = "SELECT * FROM user ORDER BY rating DESC";
	$q  = mysqli_query($db,$sql);
	$i=1;
	while($m = mysqli_fetch_array($q)){
		if ($m['rating']==$gt) {
	return $i;
		}
$i++;
}
}


function rate_class($class,$gt)
{
	include 'ajax/db_back.php';
	$sql = "SELECT * FROM user WHERE class='$class' ORDER BY rating DESC";
	$q  = mysqli_query($db,$sql);
	$i=1;
	while($m = mysqli_fetch_array($q)){
		if ($m['rating']==$gt) {
	return $i;
		}
$i++;
}
}




function rate_inst($inst,$gt)
{
	include 'ajax/db_back.php';
	$sql = "SELECT * FROM user WHERE school='$inst' ORDER BY rating DESC";
	$q  = mysqli_query($db,$sql);
	$i=1;
	while($m = mysqli_fetch_array($q)){
		if ($m['rating']==$gt) {
	return $i;
		}
$i++;
}
}




function rate_class_inst($class,$inst,$gt)
{
	include 'ajax/db_back.php';
	$sql = "SELECT * FROM user WHERE class='$class' AND school='$inst' ORDER BY rating DESC";
	$q  = mysqli_query($db,$sql);
	$i=1;
	while($m = mysqli_fetch_array($q)){
		if ($m['rating']==$gt) {
	return $i;
		}
$i++;
}
}
function name_by_rate($user)
{
	$val = more_user("rating",$user);
	$s = more_user("isnew",$user);
	if ($s==0) {
		return "<span style='color: black; font-weight: bold; text-shadow: none;'>Unrated<span>";
	}
	if ($val<1999) {
		return "<span style='color: gray; font-weight: bold; text-shadow: none;'>Inexpert<span>";
	}
	if ($val<3999) {
		return "<span style='color: green; font-weight: bold; text-shadow: none;'>Fresher<span>";
	}
	if ($val<5999) {
		return "<span style='color: blue; font-weight: bold; text-shadow: none;'>Great<span>";
	}
	if ($val<7999) {
		return "<span style='color: #FFFF00; font-weight: bold; text-shadow: none;'>Brilliant<span>";
	}
	if ($val<=9999) {
		return "<span style='color: red; font-weight: bold; text-shadow: none;'>Genius<span>";
	}
}
function deep_page($name)
{
	if (isset($_GET[$name])) {
		echo $_GET[$name];
	} else {
		return false;
	}
}
function get_language()
{
	$lang = "en";
}
function br()
{
	echo "<br>";
}
function has_registry($exam)
{
	if (!isset($_SESSION['login_data_paipixel24'])) {
		return "Nothing";
	}
	include 'ajax/db_back.php';
	$d =$_SESSION['login_data_paipixel24'];
	$sql = "SELECT * FROM `exam_reg` WHERE `exam` = '$exam' AND `user`='$d'";
	$q = mysqli_query($db,$sql);
	if (mysqli_num_rows($q)==0) {
		return false;
	} else {
		return true;
	}
}
function user_detail($table)
{
	if (!isset($_SESSION['login_data_paipixel24'])) {
		return "Nothing";
	}
	include 'ajax/db_back.php';
	$d =$_SESSION['login_data_paipixel24'];
	$sql ="SELECT `$table` FROM `user` WHERE user_name='$d'";
	$q = mysqli_query($db,$sql);
	$r = mysqli_fetch_array($q);
	return $r[0];
}

function member_by_id($table)
{
	include 'ajax/db_back.php';
	$sql ="SELECT `user_name` FROM `user` WHERE id='$table'";
	$q = mysqli_query($db,$sql);
	$r = mysqli_fetch_array($q);
	return $r[0];
}

function get_team($table)
{
	include 'ajax/db_back.php';
	$sql ="SELECT `team_name` FROM `team` WHERE rand_id='$table'";
	$q = mysqli_query($db,$sql);
	$r = mysqli_fetch_array($q);
	if ($r[0]=='') {
		return "Not joined yet.";
	}
	return $r[0];
}
function get_chal($table)
{
	include 'ajax/db_back.php';
	$sql ="SELECT * FROM `team_chal` WHERE id='$table'";
	$q = mysqli_query($db,$sql);
	$r = mysqli_fetch_array($q);
	return $r[0];
}
function more_user($table,$d)
{

	include 'ajax/db_back.php';
	$sql ="SELECT `$table` FROM `user` WHERE user_name='$d'";
	$q = mysqli_query($db,$sql);
	$r = mysqli_fetch_array($q);
	return $r[0];
}

function exam_info($property, $exam)
{

	include 'ajax/db_back.php';
	$sql ="SELECT $property FROM question WHERE exam_id='$exam' AND pending=1";
	$e = mysqli_query($db,$sql);
	$a = mysqli_fetch_array($e);
	return $a[0];
}
function def_time($active)
{
	date_default_timezone_set("Asia/Dhaka");
	$date_time = date("Y-m-d H:i:s");
	$status;
$inputSeconds = (strtotime($active)-strtotime($date_time));
	if ((strtotime($active)-strtotime($date_time))>0) {

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
	} else {
		$status="Exam Has Finished";
	}

return $status;
}


function dir_time($exam_time)
{
	date_default_timezone_set("Asia/Dhaka");
	$date_time = date("Y-m-d H:i:s");
	$status;

$inputSeconds = ($exam_time-strtotime($date_time));

	if (($exam_time-strtotime($date_time))>0) {

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
	} else {
		$status="Exam Has Finished";
	}

return $status;
}
function get_report_content($user_id,$user_name)
{
	global $db;
	$sql = "SELECT id,chal FROM team_score WHERE report=1";
	$opv = mysqli_query($db,$sql);
	$id = [];
	$member = [];
	$i = 0;
	while ($r = mysqli_fetch_array($opv)) {
		$chal = $r['chal'];
		$sql ="SELECT res,member,date,parent FROM team_chal WHERE id='$chal'";
		$ms = mysqli_query($db,$sql);
		$rs = mysqli_fetch_array($ms);
		if ($rs[0]!=1) {
		$date = strtotime($rs['date']);
		if ($date>0) {
			$psql = " WHERE parent='$chal' ";
		} else {
			$parent = $rs['parent'];
			$psql = " WHERE id='$parent' ";
		}
		$sql = "SELECT member FROM team_chal ".$psql;
		$g = mysqli_query($db,$sql);
		$q = mysqli_fetch_array($g);
		$more_member = $q['member'];
		$id[$i]=$r['id'];
		$member[$i]=$rs['member'].$q['member'];
		$i++;
		}
	}

	// user_difine

$max = count($member);
$error = 0;
$r_id = "";
for ($i=0; $i < $max; $i++) { 
	$us_id = explode(",",$member[$i]);
	$mx = count($us_id);
	for ($j=0; $j < $mx; $j++) { 
		if ($us_id[$j]==$user_id) {
			$error = 1;
		}
	}
	if ($error == 0) {
		$sql = "SELECT * FROM report_vote WHERE voting_user='$user_name' AND score_id='".$id[$i]."'";
		$v = mysqli_query($db,$sql);
		$c = mysqli_num_rows($v);
		if ($c==0) {
		$r_id.=",".$id[$i];
		}
	}
}
if ($r_id!='') {
	
$new = explode(",", substr($r_id,1));
$choise = $new[rand(0,count($new)-1)];

// The algorithm Finished. Now the user Interface;
$sql = "SELECT * FROM team_score WHERE id='$choise'";
$st = mysqli_query($db,$sql);
$row = mysqli_fetch_array($st);
?>
<div class="manta">
<div class="part_question" style="font-family: tahoma; background: white; padding: 1%; margin: 1%; max-width: 600px;text-align: left;">

	<h3 style="overflow: hidden;"><span style="float:left;"><?php echo translate("1") ?>.</span> &nbsp;<?php echo $row["question"] ?></h3>

	<div class="input_party">
		<strong>
			<table>
			<tr>
				<td>ক.</td>
				<td><label for="question1<?php echo $i+1 ?>">&nbsp;<?php echo $row['opt1'] ?></label></td>
			</tr>
			</table>
		</strong>
		<strong>
			<table>
			<tr>
				<td>খ.</td>
				<td><label for="question2<?php echo $i+1 ?>">&nbsp;<?php echo $row['opt2'] ?></label></td>
			</tr>
			</table>
		</strong>
		<strong>
			<table>
			<tr>
				<td>গ.</td>
				<td><label for="question3<?php echo $i+1 ?>">&nbsp;<?php echo $row['opt3'] ?></label></td>
			</tr>
			</table>
		</strong>
		<strong>
			<input type="hidden" name="id<?php echo $i+1 ?>" value="<?php echo $row['id'] ?>">
			<table>
			<tr>
				<td>ঘ.</td>
				<td><label for="question4<?php echo $i+1 ?>">&nbsp;<?php echo $row['opt4'] ?></label></td>
			</tr>
			</table>
		</strong>
	</div>
</div>
<div class="dain" style="font-size: 20px">
	<a href="<?php get_domain("/profile/") ?><?php echo $row['user'] ?>"  style="color: blue; font-weight: bold; text-decoration: none;"><?php echo $row['user'] ?></a> Reported <a style="color: blue; font-weight: bold; text-decoration: none;" href="<?php get_domain("/profile/") ?><?php echo protipokkho($row['user'],$row['chal']) ?>"><?php echo protipokkho($row['user'],$row['chal']) ?></a>'s quesion in team exam <?php if ($row['report_about']!=''): ?>
		 and said that,"<?php echo $row['report_about']; ?>"
	<?php endif ?>
	<p>Do you think he is correct?</p>
	<button class="hd_button" onclick="report_vote(1,'<?php echo $row['user'] ?>','<?php echo protipokkho($row['user'],$row['chal']) ?>','<?php echo $row['chal'] ?>','<?php echo $row['id'] ?>')">Yes</button>
	<button class="hd_button" onclick="report_vote(0,'<?php echo $row['user'] ?>','<?php echo protipokkho($row['user'],$row['chal']) ?>','<?php echo $row['chal'] ?>','<?php echo $row['id'] ?>')">No</button>
</div>
</div>
<div class="thankyou"  style="display: none;">Thank You</div>
<style>
	.hd_button {
	    background: #F6F6F6;
	    color: black;
	    border: 1px solid #ccc !important;
	    padding: 11px 39px;
	    margin-right: 5px;
	    display: inline-block;
	    border-radius: 10px;
	    transition: .4s;
	    cursor: pointer;
	}
	.hd_button:hover{
		background:#EBEBEB;
	}
	.thankyou {
    font-size: 5vw;
    font-family: cursive;
    color: #ff5858;
    text-align: center;
    margin: 40px;
    animation: rotate10 1s;
}
@keyframes rotate10 {
    0%{
        transform: rotateY(150deg);
    }
}
</style>
<script>
	function report_vote(type,user1,user2,chal,id)
	{
		$.ajax({
			url: '<?php get_domain("/ajax/model/plz.team_exam_report.save.php") ?>',
			type: 'POST',
			data: {type: type,user1:user1,user2:user2,chal:chal,id:id},
		})
		.done(function(data) {
			$(".manta").fadeOut(100);
			$(".thankyou").show(0);
			setTimeout(function(){
$(".vote_part").slideUp("slow");
			},2000);
		});
		
	}
</script>
<?php

} else {
	?>
<style>
	.vote_part{
		display: none;
	}
</style>
	<?php
}
}
function protipokkho($user,$chal)
{
	global $db;
	date_default_timezone_set("Asia/Dhaka");
	$user = more_user("id",$user);
	$sql = "SELECT * FROM team_chal WHERE id='$chal'";
	$d5 = mysqli_query($db,$sql);
	$rs = mysqli_fetch_array($d5);
	$member = explode(",",substr($rs['member'],1));
	$index = 0;
	$cs = count($member);
	for ($i=0; $i < $cs; $i++) { 
		if ($member[$i]==$user) {
			$index = $i;
		}
	}
	$date = strtotime($rs['date']);
	if ($date>0) {
		$psql = " WHERE parent='$chal' ";
	} else {
		$parent = $rs['parent'];
		$psql = " WHERE id='$parent' ";
	}
	$sql = "SELECT * FROM team_chal ".$psql;
	$d5 = mysqli_query($db,$sql);
	$rs = mysqli_fetch_array($d5);
	$member = explode(",",substr($rs['member'],1));
	return member_by_id($member[$index]);
}

function send_notification($user,$link,$content)
{
	global $db;
	date_default_timezone_set("Asia/Dhaka");
	$date = date("Y-m-d H:i:s");
	$content = str_replace("'", "\'", $content);
$sql = "INSERT INTO `noti` (`id`, `user`, `link`, `content`, `seen`, `date`) VALUES (NULL, '$user', '$link', '$content', '0', '$date')";
mysqli_query($db,$sql);


}
?>