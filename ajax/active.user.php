<?php 
include 'db.php';
session_start();
date_default_timezone_set("Asia/Dhaka");
if (isset($_SESSION['login_data_paipixel24'])) {
	$user = $_SESSION['login_data_paipixel24'];
	$date = date("Y-m-d H:i:s");
	$sql = "UPDATE user SET active='$date' WHERE user_name='$user'";
	mysqli_query($db,$sql);
}


$sql = "SELECT * FROM weektime WHERE DATE_ADD(`date`, INTERVAL 7 DAY)<CURRENT_TIME AND res=0";
$m = mysqli_query($db,$sql);
$n = mysqli_num_rows($m);
if ($n!=0) {
$r = mysqli_fetch_array($m);
	$id = $r['id'];
	$sql = "UPDATE weektime SET res=1 WHERE id='$id'";
	mysqli_query($db,$sql);

	$date = $r['date'];
	$sql = "SELECT user_name,SUM(score),SUM(currect),SUM(total) FROM score_leader_board WHERE `date`>'$date' GROUP BY user_name ORDER BY SUM(score) DESC LIMIT 10";
$t = mysqli_query($db,$sql);
$i = 0;
while ($s = mysqli_fetch_array($t)) {
	$i++;
	echo $user_name = $s['user_name'];
	$score = $s['SUM(score)'];
	$currect = $s['SUM(currect)'];
	$total = $s['SUM(total)'];
	$v = "INSERT INTO `weektopscore` (`id`, `date`, `week`, `user_name`, `position`, `score`, `correct`, `total`) VALUES (NULL, '$date', '$id', '$user_name', '$i', '$score', '$currect', '$total')";
	mysqli_query($db,$v);
	$content = "<b>Congratulations!</b> You became a top scorer on <b>PaiPixel Weekly ScoreBoard</b> (week: $id, position: $i)";
send_notification($user_name,"",$content);
	
}
		$deat = date("Y-m-d H:i:s");
		$sql = "INSERT INTO weektime(`date`,`res`) VALUES('$deat',0)";
mysqli_query($db,$sql);	

}


$sql = "SELECT * FROM team_chal WHERE ADDDATE(date,INTERVAL 1 DAY)<CURRENT_TIME AND parent=0 AND res=0 AND accept_id=1";
$m = mysqli_query($db,$sql);
while ($row=mysqli_fetch_array($m)) {
	$id = $row['id'];
	$sql = "SELECT * FROM team_chal WHERE parent='$id'";
	$s = mysqli_query($db,$sql);
	$f = mysqli_fetch_array($s);
	$other_id = $f['id'];

$sql = "UPDATE team_chal SET res=1 WHERE id='$id' OR id='$other_id'";
mysqli_query($db,$sql);

// Before geting update the auto mark point.

// check who wins on the vote

$sql = "SELECT COUNT(id),user1,user2,chal FROM report_vote WHERE chal='$id' AND type=1 GROUP BY user1,chal";
$m = mysqli_query($db,$sql);
while ($rq = mysqli_fetch_array($m)) {
$result = $rq[0]; 
$auser1 = $rq[1]; 
$auser2 = $rq[2]; 
$chals = $rq[3]; 
$sql = "SELECT COUNT(id) FROM report_vote WHERE chal='$chals' AND type=0 AND user1='$auser1' AND user2='$auser2'";
$m = mysqli_query($db,$sql);
$rqs = mysqli_fetch_array($m);
$results = $rqs[0];

if ($result>$results) {
$sql = "UPDATE team_score SET score=score-2 WHERE chal='$chals' AND user2='$auser2' AND question='Auto Mark'";
mysqli_query($db,$sql);
$sql = "UPDATE team_score SET score=score+2 WHERE chal='$chals' AND user1='$auser1' AND question='Auto Mark'";
mysqli_query($db,$sql);
} else {
$sql = "UPDATE team_score SET score=score-2 WHERE chal='$chals' AND user1='$auser1' AND question='Auto Mark'";
mysqli_query($db,$sql);
$sql = "UPDATE team_score SET score=score+2 WHERE chal='$chals' AND user2='$auser2' AND question='Auto Mark'";
mysqli_query($db,$sql);
}
}



// check who wins on the vote

$sql = "SELECT COUNT(id),user1,user2,chal FROM report_vote WHERE chal='$other_id' AND type=1 GROUP BY user1,chal";
$m = mysqli_query($db,$sql);
while ($rq = mysqli_fetch_array($m)) {
$result = $rq[0]; 
$auser1 = $rq[1]; 
$auser2 = $rq[2]; 
$chals = $rq[3]; 
$sql = "SELECT COUNT(id) FROM report_vote WHERE chal='$chals' AND type=0 AND user1='$auser1' AND user2='$auser2'";
$m = mysqli_query($db,$sql);
$rqs = mysqli_fetch_array($m);
$results = $rqs[0];

if ($result>$results) {
$sql = "UPDATE team_score SET score=score-2 WHERE chal='$chals' AND user2='$auser2' AND question='Auto Mark'";
mysqli_query($db,$sql);
$sql = "UPDATE team_score SET score=score+2 WHERE chal='$chals' AND user1='$auser1' AND question='Auto Mark'";
mysqli_query($db,$sql);
} else {
$sql = "UPDATE team_score SET score=score-2 WHERE chal='$chals' AND user1='$auser1' AND question='Auto Mark'";
mysqli_query($db,$sql);
$sql = "UPDATE team_score SET score=score+2 WHERE chal='$chals' AND user2='$auser2' AND question='Auto Mark'";
mysqli_query($db,$sql);
}
}



	// Get Results..
	$score = 0;
	$score1 = 0;
	$sql = "SELECT * FROM team_score WHERE chal='$id'";
	$g = mysqli_query($db,$sql);
	while ($so = mysqli_fetch_array($g)) {
		$score += $so['score'];
	}

	$sql = "SELECT * FROM team_score WHERE chal='$other_id'";
	$g = mysqli_query($db,$sql);
	while ($so = mysqli_fetch_array($g)) {
		$score1 += $so['score'];
	}

	// check for Wining Team.
$win = '';
$lose = '';
	if ($score>$score1) {
		$win=$id;
		$lose=$other_id;
	} else {
		$win = $other_id;
		$lose = $id;
	}

	// Select Users of the Winning Team team
	$sql = "SELECT * FROM team_chal WHERE id='$win'";
	$s = mysqli_query($db,$sql);
	$ef = mysqli_fetch_array($s);
	$member = substr($ef['member'], 1);
	$team = $ef['team'];

	// Select Id of the Losing Team team
	$sql = "SELECT * FROM team_chal WHERE id='$lose'";
	$s = mysqli_query($db,$sql);
	$ef = mysqli_fetch_array($s);
	$lose_team = $ef['team'];

	// GET losing team Pre rating
	
	$sql = "SELECT * FROM team WHERE rand_id='$lose_team'";
	$s = mysqli_query($db,$sql);
	$ef = mysqli_fetch_array($s);
	$l_pre = $ef['my_rating'];
	if ($ef['isnew']==0) {
		$l_pre = 3500;
	}


// indevisual rating changer.
	$mem = explode(",", $member);
	$total_score = (5*(count($mem)));
for ($e=0; $e < count($mem); $e++) { 
	$cm_id = $mem[$e].$win;
	$mem_id = $mem[$e];
	$sql = "SELECT * FROM team_score WHERE cm_id='$cm_id' ";
	$g = mysqli_query($db,$sql);
	$in_score = 0;
	while ($so = mysqli_fetch_array($g)) {
		$in_score += $so['score'];
	}
	$pre_rate = more_user("rating",member_by_id($mem_id));
if ($pre_rate==0) {
		$pre_rate = 3500;
	}
	$score100 = ($score/$total_score)*100;
	$expected_score = (($pre_rate)/100);
	$score_def = (($score100)-($expected_score));

if ($pre_rate<1000) {
	$c = ($pre_rate) + floor(($score_def)*0.4);
} else if($pre_rate>=1000 && $pre_rate<2000){
	$c = ($pre_rate) + floor(($score_def)*3.5);
} else if($pre_rate>=2000 && $pre_rate<3000){
	$c = ($pre_rate) + floor(($score_def)*3);
}
 else if($pre_rate>=3000 && $pre_rate<4000){
	$c = ($pre_rate) + floor(($score_def)*2.8);
}
 else if($pre_rate>=4000 && $pre_rate<5000){
	$c = ($pre_rate) + floor(($score_def)*2.5);
}
 else if($pre_rate>=5000 && $pre_rate<6000){
	$c = ($pre_rate) + floor(($score_def)*2.3);
}
 else if($pre_rate>=6000 && $pre_rate<7000){
	$c = ($pre_rate) + floor(($score_def)*2.1);
}
 else if($pre_rate>=7000 && $pre_rate<8000){
	$c = ($pre_rate) + floor(($score_def)*1.9);
}
 else if($pre_rate>=8000 && $pre_rate<9000){
	$c = ($pre_rate) + floor(($score_def)*1.6);
} else {
	$c = ($pre_rate) + floor(($score_def)*1);
}
$sql = "UPDATE user SET rating='$c' WHERE id='$mem_id'";
mysqli_query($db,$sql);
}


	// GET winning team Pre rating
	
	$sql = "SELECT * FROM team WHERE rand_id='$team'";
	$s = mysqli_query($db,$sql);
	$ef = mysqli_fetch_array($s);
	$pre_rate = $ef['my_rating'];
	if ($ef['isnew']==0) {
		$pre_rate = 3500;
	}

	// Check For team Total Score100
	$score100 = ($score/$total_score)*100;
	$expected_score = (($pre_rate)/100);
	$score_def = (($score100)-($expected_score));


if ($pre_rate<1000) {
	$c = ($pre_rate) + floor(($score_def)*0.4);
} else if($pre_rate>=1000 && $pre_rate<2000){
	$c = ($pre_rate) + floor(($score_def)*3.5);
} else if($pre_rate>=2000 && $pre_rate<3000){
	$c = ($pre_rate) + floor(($score_def)*3);
}
 else if($pre_rate>=3000 && $pre_rate<4000){
	$c = ($pre_rate) + floor(($score_def)*2.8);
}
 else if($pre_rate>=4000 && $pre_rate<5000){
	$c = ($pre_rate) + floor(($score_def)*2.5);
}
 else if($pre_rate>=5000 && $pre_rate<6000){
	$c = ($pre_rate) + floor(($score_def)*2.3);
}
 else if($pre_rate>=6000 && $pre_rate<7000){
	$c = ($pre_rate) + floor(($score_def)*2.1);
}
 else if($pre_rate>=7000 && $pre_rate<8000){
	$c = ($pre_rate) + floor(($score_def)*1.9);
}
 else if($pre_rate>=8000 && $pre_rate<9000){
	$c = ($pre_rate) + floor(($score_def)*1.6);
} else {
	$c = ($pre_rate) + floor(($score_def)*1);
}

$score_main_tance = ($c)-($pre_rate);
$ot_ma = ($l_pre)-($score_main_tance);


//Set winning Team Rating.
$date= date("Y-m-d H:i:s");
$sql = "INSERT INTO `team_rating_change` (`id`, `team`, `chal_id`, `pre_rating`, `now_rating`, `date`) VALUES (NULL, '$team', '$win', '$pre_rate', '$c', '$date') ";
mysqli_query($db,$sql);

//Set Losing Team Rating.
$sql = "INSERT INTO `team_rating_change` (`id`, `team`, `chal_id`, `pre_rating`, `now_rating`, `date`) VALUES (NULL, '$lose_team', '$lose', '$l_pre', '$ot_ma', '$date') ";
mysqli_query($db,$sql);


$sql = "UPDATE team SET my_rating='$c' , isnew=1 WHERE rand_id='$team'";
if (mysqli_query($db,$sql)) {
	$sql = "UPDATE team SET my_rating='$ot_ma' , isnew=1 WHERE rand_id='$lose_team'";
	mysqli_query($db,$sql);
}

}
?>