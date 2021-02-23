<?php include 'db.php'; ?>
<?php session_start(); ?>
<?php $user = user_detail("user_name"); 
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

if (strtotime($_POST['from'])==0) {
	$from = date("Y-m-d H:i:s",time()-3600*24*30);
} else {
	$from = $_POST['from'];
}$from = date("Y-m-d H:i:s", strtotime($from));
if (strtotime($_POST['to'])==0) {
	$to = date("Y-m-d H:i:s");
} else {
	$to = $_POST['to'];
}
 $to = date("Y-m-d H:i:s", strtotime($to)+3600*24);
$timeplus2day = date("Y-m-d H:i:s",time()+3600*24*2);
 $sql = "SELECT * FROM `noti_provide_ans` WHERE provider='$user' AND `datetime`>'$from' AND `datetime`<'$to' ORDER BY id DESC";
$m = mysqli_query($db,$sql);
if ($role==2 AND mysqli_num_rows($m)==0) {
	echo "Nothing Found.";
}
while ($g = mysqli_fetch_array($m)) {
	if((strtotime($g['datetime'])+3600*24)>time() && $g['full']==0)
	{
		echo "<div class='cn'>You are selected to answer a question <a style='color: green;' href='".return_domain("/full_question.php?id=").$g['question']."'>".get_question($g['question'],"question")."</a> for <b>".get_question($g['question'],"price")." BDT </b>. You have to provide the content within ".date("h:ia, d M Y",(strtotime($g['datetime'])+3600*24)).". The <b>".get_question($g['question'],"need_deal")."</b> is ready? <a style='padding: 5px; color: white; background: green; text-decoration: none; border: 1px solid darkgreen;' href='javascript:void(0)' onclick='sonongno()'>click here to upload.</a></div>";
		?>
<style>
	.cn {
		padding: 10px;
		border: 1px solid #20b99d;
		font-size: 20px;
	}
</style>
<script>
$('#dnono10').submit(function(event) {
	event.preventDefault();
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
percent.show("fast");
    	        var formData = new FormData(this);
    $.ajax({
    	url: "<?php get_domain("/upload/upload_file.php") ?>",
    	data: formData,
    	type: "POST",
        cache:false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        xhr: function() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
                var percentComplete = (evt.loaded / evt.total) * 100;
                var percentVal = percentComplete+'%';
            bar.width(percentVal);
            percent.html(percentComplete.toFixed(2)+"% Uploaded");
            }
       }, false);
       return xhr;
    },
        success:function(data){
        	location.reload();
        }
    });
}); 

	function sonongno(){
		$("#sonodd10<?php echo $g['question'] ?>").dialog({
			title: "File Uploader",
			modal: true,
			hide: "fade",
			show: "fade",
			width: "auto"
		});
	}
</script>
<div id="sonodd10<?php echo $g['question'] ?>" style="display: none;">
<form action="file-echo2.php" method="post" id="dnono10" enctype="multipart/form-data">
    <input type="file" name="file" required=""><br>
<input type="hidden" name="question" value="<?php echo $g['question'] ?>">
<div class="progress" style="padding: 10px;margin: 10px;">
    <div class="percent" style="text-align: center; display: none;">0% Uploaded</div>
    <div class="bar" style="background: linear-gradient(90deg,skyblue,#20b99d);color: white;text-align: center;width: 100%;height: 18px;"></div>
</div>
<div class="button_set">.
    <input type="submit" class="button" value="Upload File">
</div>
</form>

</div>
		<?php
	}
	if((strtotime($g['datetime'])+3600*24)>time() && $g['full']==1)
	{
		if ($g['feedback']==0) {
			
		echo "<div class='cn'>You successfully delivered the question <a style='color: green;' href='".return_domain("/full_question.php?id=").$g['question']."'>".get_question($g['question'],"question")."</a> for <b>".get_question($g['question'],"price")." BDT </b> Your balance will be added to your account after student's feedback.</div>";
		} else {
		echo "<div class='cn'>You successfully answered the question <a style='color: green;' href='".return_domain("/full_question.php?id=").$g['question']."'>".get_question($g['question'],"question")."</a>. You have recieved ".floor(get_question($g['question'],"price")*0.8)." BDT  (80% of ".get_question($g['question'],"price")." BDT ) in your account.</div>";
		}
		?>
<style>
	.cn {
		padding: 10px;
		border: 1px solid #20b99d;
		font-size: 20px;
	}
</style>
		<?php
	}
}
$sql = "SELECT * FROM `noti_provide_ans` WHERE owner='$user' AND  `datetime`>'$from' AND `datetime`<'$to' ORDER BY id DESC";
$m = mysqli_query($db,$sql);

if ($role==1 AND mysqli_num_rows($m)==0) {
	echo "Nothing Found.";
}
while ($g = mysqli_fetch_array($m)) {
	if((strtotime($g['datetime'])+3600*24)>time() && $g['full']==0)
	{
		echo "<div class='cn'>You have assigned a teacher to answer a question <a style='color: green;' href='".return_domain("/full_question.php?id=").$g['question']."'>".get_question($g['question'],"question")."</a> for <b>".get_question($g['question'],"price")." BDT </b>. You may get the content within ".date("h:ia, d M Y",(strtotime($g['datetime'])+3600*24)).". The file will appeare here.</div>";
		?>
<style>
	.cn {
		padding: 10px;
		border: 1px solid #20b99d;
		font-size: 20px;
	}
</style>
		<?php
	}

$rs =rand();
	if((strtotime($g['datetime'])+3600*24)>time() && $g['full']==1)
	{
		echo "<div class='cn'>You assigned a teacher to answer a question <a style='color: green;' href='".return_domain("/full_question.php?id=").$g['question']."'>".get_question($g['question'],"question")."</a> for <b>".get_question($g['question'],"price")." BDT </b>. We collected the answer for you <a style='padding: 5px; color: white; background: green; text-decoration: none; border: 1px solid darkgreen;' href='".$g['answer']."' download>click here to download</a>";
		if ($g['feedback']==0) {
			echo " and <a style='padding: 5px; color: white; background: green; text-decoration: none; border: 1px solid darkgreen;' href='javascript:void(0)' onclick='givefidbak".$g['id'].$rs."()'>Give Feedback</a>";
		}
		echo "</div>";
		?>
<style>
	.cn {
		padding: 10px;
		border: 1px solid #20b99d;
		font-size: 20px;
	}
</style>
<script>
	function givefidbak<?php echo $g['id'].$rs; ?>(){
$(".sonodhahaha<?php echo $g['id'].$rs ?>").dialog({
	open: true,
	modal: true,
	title: "Feedback",
	width: "auto",
	buttons:{
		"Send Feedback":function(){
			$.ajax({
				url: '<?php get_domain("/feedback.php") ?>',
				type: 'POST',
				data: {id: '<?php echo $g['id'] ?>',rate: $("#rates<?php echo $g['id'].$rs; ?>").val(),feedback: $("#feedback<?php echo $g['id'].$rs; ?>").val(),},
			})
			.done(function(data) {
			$(".sonodhahaha<?php echo $g['id'].$rs ?>").dialog("close");
				search_dos();
			});
			
		},
		"Close":function(){
			$(this).dialog("close");
		},
	}
});
	}
</script>
<div class="sonodhahaha<?php echo $g['id'].$rs; ?>" style="display: none;">
	Rate (from 1-5): <select name="rate" id="rates<?php echo $g['id'].$rs; ?>" style="padding: 6px;">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
	</select><br>
	Your Feedback: <br>
	<textarea name="rate" id="feedback<?php echo $g['id'].$rs; ?>" cols="30" rows="10" maxlength=200></textarea>
</div>
		<?php
	}
}
?>