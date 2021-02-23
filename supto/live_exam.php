
<html>
<head>
	<title>Teacher's Question - Paipixel DashBoard</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=0.01"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<?php include 'db.php'; ?>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/froala_editor.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/froala_style.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/plugins/code_view.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/plugins/colors.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/plugins/emoticons.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/plugins/image_manager.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/plugins/image.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/plugins/line_breaker.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/plugins/table.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/plugins/char_counter.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/plugins/video.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/plugins/fullscreen.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/plugins/file.css">
<link rel="stylesheet" href="<?php get_domain("/ajax/teacher/editor/")?>css/plugins/quick_insert.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
<link rel="stylesheet" href="<?php get_domain("/")?>css/table.css?s">
<script type="text/javascript"
    src="<?php get_domain("/js/")?>codemirror.min.js"></script>
 <script type="text/javascript"
    src="<?php get_domain("/js/")?>xml.min.js"></script>
<script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/froala_editor.min.js"></script>

 <style>
.second-toolbar #logo{
		display: none !important;
	}

#cd_button {
  background: none;
  color: #ff3c00;
  border: 1px solid #ff3c00;
  border-radius: 11px;
  padding: 9px 20px;
}
#cd_button:hover {
  background: #ff3c00;
  color: white;
}

.atp {
  padding: 10px;
  background: #a3ff00;
  float: left;
  margin: 1%;
  border-radius: 10px;
}

</style>
<style>
@media (max-width: 500px) {
	.fr-btn-grp.fr-float-right {
		display: none !important;
	}
}
</style>

<style>
	#insertVideo-1 {
		display: none;
	}
</style>
</head>	
<body>
<?php 
session_start();
if (!isset($_SESSION['dbpx'])) {
	echo "Login to Go to dashboard.";
	?>
<a href="login.php">Click Here</a>
	<?php
	exit();
}
?>
<div class="main_box">
<div class="question_support" style="display: none"></div>
<div class="question_details" style="display: none"></div>
<script>

function searchit(v) {
$.ajax({
	url: 'get_proposal.php',
	type: 'POST',
	data: "search="+v,
})
.done(function(data) {
	$(".table_support .w3-table-all").html(data);
});

}
$(document).ready(function() {
	searchit("");
});
</script>
<div class="reject_info" style="display: none;">
Rejecting Reason:
<textarea name="dmdjmngdfgbjmdfjfgs" id="dmdjmngdfgbjmdfjfgs" cols="30" rows="10"></textarea>
</div>
<script>
function open_total(user)
{
$.ajax({
	url: 'open_total.php',
	type: 'POST',
	data: "search="+user,
})
.done(function(data) {
	$(".question_support").html(data);
	$(".question_support").dialog({
		open:true,
		title: "Details",
		width: "100%",
		buttons:{
			"close":function()

			{
				$(this).dialog("close");
			}
		}
	});

});
	
}

function approve(id,user)
{
	$(".approvenos").html('	<div class="border_box"><label for="exam_name"><h4>Exam Name</h4><input type="text" class="input datetime" name="exam_name" id="exam_name"></label></div><div class="border_box"> <label for="duration"><h4>Exam Duration</h4> <select  name="duration" id="duration" class="input"> <option value="0">-- Select Min--</option> <option value="5">5</option> <option value="10">10</option> <option value="15">15</option> <option value="20">20</option> <option value="25">25</option> <option value="30">30</option> <option value="40">40</option> <option value="45">45</option> <option value="40">50</option> <option value="60">60</option> </select> </label> </div> <div class="border_box"> <label for="date"><h4>Exam Starting Date</h4> <input type="text" class="input datetime" name="date" id="date"> </label> </div> ');
	$(".approvenos").dialog({
		open:true,
		title: "Confirmation",
		modal: true,
		width: "auto",
		buttons:{
			"ok":function(){
				$(this).dialog("close");
				$.ajax({
	url: 'approves.php',
	type: 'POST',
	data: "search="+id+"&&exam_name="+$("#exam_name").val()+"&&duration="+$("#duration").val()+"&&date="+$("#date").val(),
}).done(function(data) {
	alert(data+ "\na refresh will make it shown.");
	$(".question_details").dialog("close");
	open_total(user);
	
});
			},
			"close":function(){
				$(this).dialog("close");
			}
		}
	});

}
function reject(id,user)
{
$(".reject_info").dialog({
	open: true,
	modal: true,
	title: "Confirmation",
	buttons:{
		"Reject":function(){
$.ajax({
	url: 'rejects.php',
	type: 'POST',
	data: "search="+id+"&data="+$("#dmdjmngdfgbjmdfjfgs").val(),
}).done(function(data) {
	alert(data+ "\na refresh will make it shown.");
	$(".reject_info").dialog("close");
	$(".question_details").dialog("close");
	open_total(user);
});
		}
	}
});

}

function open_question_set(id,user)
{
$.ajax({
	url: 'view_all_model.php',
	type: 'POST',
	data: "id="+id,
})
.done(function(data) {
	$(".question_details").html(data);
	$(".question_details").dialog({
		open:true,
		title: "Question:"+id,
		width: "100%",
		buttons:{
			"Approve the set":function()

			{
				approve(id,user);
				$(this).dialog("close");
			},
			"Reject the set":function()

			{
				reject(id,user);
				$(this).dialog("close");
			},
			"Close":function()

			{
				$(this).dialog("close");
				open_total(user);
			},
		}
	});

});
	
}

function accept645dsf(user,ref){
$.ajax({
	url: 'accept_proposal.php',
	type: 'POST',
	data: "user="+user+"&&ref="+ref,
	beforeSend:function()
	{
		$(".question_details").html("Prepareing Editor...");
	}
})
.done(function(data) {
	alert(data);
	searchit($("#sodfnoedf0").val());
});

}
function edit_question(id,user)
{
$.ajax({
	url: 'editor.php',
	type: 'POST',
	data: "search="+id,
	beforeSend:function()
	{
		$(".question_details").html("Prepareing Editor...");
	}
})
.done(function(data) {
	$(".question_details").html(data);
	$(".question_details").dialog({
		open:true,
		title: "Edit Question:"+id,
		width: "100%",
		buttons:{
			"Save":function()

			{
				var form = $("#ft"+id)[0];
		var data = new FormData(form);

        $.ajax({
            type:'POST',
            url: 'save_q.php',
            data:data,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function()
	{
		$(".question_details").html("Saving...");
		$(".question_details").dialog("close");
	},
            success:function(data){
            	alert(data);
               open_row(id,user);
            },
            error: function(data){
                alert("Failed to connect to the server.");
            }
        });


				
			},
			"Close":function()

			{
				$(this).dialog("close");
			},
		}
	});

});
	
}

function open_approved(user)
{
	alert(user);
}

function open_rejected(user)
{
	alert(user);
}
</script>

<div class="approvenos"></div>
<input type="search" name="search" placeholder="search" id="sodfnoedf0" style="padding: 10px; width: 100%" onkeyup="searchit(this.value)">
	<div class="table_support">
	<table class="w3-table-all">
		
	</table>
	</div>
</div>

  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/align.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/char_counter.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/code_beautifier.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/code_view.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/colors.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/draggable.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/emoticons.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/entities.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/file.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/font_size.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/font_family.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/fullscreen.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/image.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/image_manager.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/line_breaker.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/inline_style.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/link.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/lists.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/paragraph_format.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/paragraph_style.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/quick_insert.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/quote.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/table.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/save.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/url.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/plugins/video.min.js"></script>
</body>

</html>