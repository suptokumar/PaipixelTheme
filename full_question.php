<?php 
include 'header.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "UPDATE ask_teacher SET view=view+1 WHERE id='$id'";
	mysqli_query($db,$sql);
	$sql = "SELECT * FROM ask_teacher WHERE id='$id'";
	$m = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($m);
}
get_header($row['question'] . " - Paipixel"); // Site Title "Paipxel Online Exam"
	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu("menu_item_ask_teacher");
?>
<div class="from_main_body">

<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<div class="container">
	<div class="body_content content_area" style="width: 96.7%">
		<div class="main_box" style="max-width: 1200px; margin: 0px auto;">
<div class="tiptap" style="min-width: 1200px; margin: 0px auto;">
<style>
	.acure_part {
    width: 100% !important;
  }
  .acure {
    float: left;
    padding: 4px 10px;
    border-radius: 10px;
    margin-bottom: 10px;
  }
  .acure h2, .acure h3 {
    float: left;
    font-size: 17px;
  }
  .acure h3 {
    text-align: center;
    margin-left: 3px;
    font-size: 12px;
    margin-top: 4px;
  }
  .cd_button {
  background: none;
  color: #ff3c00;
  border: 1px solid #ff3c00;
  border-radius: 11px;
  padding: 9px 20px;
  transition: .2s;
  text-decoration: none;
}
.cd_button:hover {
  background: #ff3c00;
  color: white;
}
</style>
</div>
<?php
$role = user_detail("role");
if ($role==1) {
}
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM ask_teacher WHERE id='$id'";
	$m = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($m);
}
?>

<div class="barItem">
	<div class="acure_part" style="overflow: hidden; float:left; width: 20%">
		<div class="acure" style="float: right">
			<h3><strong>Asked By: </strong> <span style="color: green"><?php echo $row['user']; ?></span></h3>
		</div>
		<div class="acure">
			<h2><?php echo $row['view'] ?></h2>
			<h3>Views</h3>
		</div>
		<div class="acure">
			<h3><strong>Asked:</strong> <span class="time_counter" style="font-family: arial;">0 Min</span> Ago</h3>
		</div>
	</div>
</div>
<div class="image_box" title="Image Viewer"></div>
<script>
$(document).ready(function() {
	$(".Question img").click(function(event) {
		var w = $(window).width();
var h = $(window).height();
	$(".image_box").html('<div style="text-align: center; z-index: 10; position: relative;"><img src="'+$(this).attr("src")+'" alt="image" style="position: relative;width: auto !important; /></div><div style="text-align: center; z-index: 10; position: relative;"><br><br><a href="'+$(this).attr("src")+'" download class="cd_button button" style="text-shadow: 1px 1px 0px white">Download</a></div><div style="text-align: center"></div><div class="cf2" style="background:url('+$(this).attr("src")+') 0 0 / 100% 100%; filter: blur(10px); margin-top:-'+(h)+'px;width: 100% !important; height:'+h+'px;"></div>');
	$(".image_box").dialog({
		open: true,
		modal: true,
		show: 'fade',
		hide: "explode",
		width: "90%",
		height: h
	});
	});
});
</script>

<style>
.Question img {
	cursor: pointer;
}
.voter_machine .material-icons{
	font-size: 70px;
	cursor: pointer;
}
.main_vote,.sub_vote {
  font-size: 29px;
  padding: 9px;
}
.voter_machine .material-icons:hover{
	color: orange;
}
@media(max-width: 700px)
{
	.Question img {
		width: 100% !important;
	}
}
</style>
<script>
	setInterval(function(){
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/extra/time_def.php',
			type: 'GET',
			data: {time: '<?php echo $row['date_time'] ?>'},
		})
		.done(function(data) {
			$(".time_counter").html(data);
		});

		$.ajax({
			url: '<?php get_domain("/") ?>ajax/ask_teacher/question_vote.php',
			type: 'POST',
			data: {id: '<?php echo $row['id'] ?>'},
		})
		.done(function(data) {
			$(".main_vote").html(data);
		});
		
	},1000);
</script>
<div class="Question">
	<h2><?php echo $row['question']; $question_id = $row['id']; ?></h2>
	<div class="question_content" style="padding: 1%; border: 1px solid #ccc; margin-top: 10px;">
	<?php echo $row['content'] ?>
	</div>
</div>
<script>
function add_vote(id)
{
	$.ajax({
		url: '<?php get_domain("/ajax/ask_teacher/") ?>vote_up.php',
		type: 'POST',
		data: {id: id},
	})
	.done(function(data) {
		if ($.trim(data)!='') {
			alert(data);
		}
	});
	
}
function out_vote(id)
{
	$.ajax({
		url: '<?php get_domain("/ajax/ask_teacher/") ?>vote_down.php',
		type: 'POST',
		data: {id: id},
	})
	.done(function(data) {
		if ($.trim(data)!='') {
			alert(data);
		}
	});
	
}

function ans_ad_vote(id)
{
	$.ajax({
		url: '<?php get_domain("/ajax/ask_teacher/") ?>ans.vote_up.php',
		type: 'POST',
		data: {id: id},
	})
	.done(function(data) {
		if ($.trim(data)!='') {
			alert(data);
		}
	});
	
}
function ans_bd_vote(id)
{
	$.ajax({
		url: '<?php get_domain("/ajax/ask_teacher/") ?>ans.vote_down.php',
		type: 'POST',
		data: {id: id},
	})
	.done(function(data) {
		if ($.trim(data)!='') {
			alert(data);
		}
	});
	
}
</script>
<div class="question_marker" style="overflow: hidden;">
<div class="ap" style="float: right">
<?php 
if ($row['post_type']=='Premium') {
?>
<img width="100px" src="<?php get_domain("/image/Premium_logo.png") ?>">

<?php
} else{
?>
<a href="javascript:void(0)" style="color: #00B5FF; text-decoration: none;font-size: 22px">
<?php
$sql = "SELECT * FROM `ans_ask` WHERE question='$question_id'";
$m = mysqli_query($db,$sql);
$r = mysqli_num_rows($m);
?>
<span class="torldo"><?php echo $r; ?></span>
 answer<?php if ($r>1) {
 	echo "s";

 } ?></a><?php } ?></div>
	<div class="vote_counter">
		<div class="voter_machine">
<table>
<tr>
<td>
<img style="cursor: pointer" src="<?php get_domain("/image/voteup.png") ?>" alt="vote up" title="I like it." onclick="add_vote(<?php echo $row['id']; ?>);">
<span class="main_vote" style="font-family: arial; text-align: center;"></span>
<img style="cursor: pointer" src="<?php get_domain("/image/votedown.png") ?>" alt="vote up" title="I don't like it." onclick="out_vote(<?php echo $row['id']; ?>);">
</td>
</tr>
<tr>
	<td id="notif">
		
	</td>
</tr>
</table>

</div>
</div>
</div>

<?php 
if ($row['post_type']=='Premium' OR (user_detail("user_name")==$row['user'])) {
?>

	

<div class="answers_part">
</div>

<script>
function load_answers() {
	$.ajax({
		url: '<?php get_domain("/ajax/ask_teacher/load_ans.php") ?>',
		type: 'POST',
		data: {id: '<?php echo $question_id ?>'},
	})
	.done(function(data) {
		$(".answers_part").html(data);
	})
	.fail(function() {
		$(".answers_part").html("Network Error.");
	});
	
}
$(document).ready(function() {
	load_answers();
});
</script>












<?php if ($row['post_type']=='Premium'): ?>
	


<h3>✅ Content Type: <span style="color: green"><?php echo $row['need_deal'] ?></span></h3>
<h3>✅ Amount of this Question: <?php echo arial($row['price']) ?> BDT </h3>
<h3>✅ Total Proposals: <span style="color: green">
<?php 
$sql = "SELECT * FROM `ans_ask` WHERE question='$question_id'";
$m = mysqli_query($db,$sql);
echo arial(mysqli_num_rows($m));
?></span></h3>

<?php 
$sql = "SELECT * FROM `ans_ask` WHERE question='$question_id' AND accept='1'";
$m = mysqli_query($db,$sql);
$tr = mysqli_fetch_array($m);
$dosn = $tr['user'];
if(mysqli_num_rows($m)>0){
?>
<h3>✅ Teacher Selected: <a href="<?php get_domain("/profile/") ?><?php echo $dosn ?>" onclick="withdrowit('<?php echo $question_id ?>','<?php echo $dofn ?>')"><?php echo $dosn ?></a></h3>
<?php 
$sql = "SELECT * FROM noti_provide_ans WHERE question='$question_id'";
$fo = mysqli_query($db,$sql);
$g = mysqli_fetch_array($fo);
if ($g['feedback']!=0) {
?>
<h3>✅ Student Rated: <span style="color: green; font-family: arial;"><?php echo $g['feedback'] ?> out of 5</span></h3>
<h3>✅ Student's Feedback: <span style="color: black; font-weight: 100"><?php echo $g['feed_back_text'] ?></span></h3>
<?php
}
?>
<?php
exit();
}


?>

<?php 
$dofn = user_detail("user_name");
$sql = "SELECT * FROM `ans_ask` WHERE question='$question_id' AND user='$dofn'";
$m = mysqli_query($db,$sql);
if(mysqli_num_rows($m)>0){
?>
<h3>✅ Your Proposal Submited. <a href="javascript:void(0)" onclick="withdrowit('<?php echo $question_id ?>','<?php echo $dofn ?>')">Cancel Proposal</a></h3>
<script>
function withdrowit(id,user)
{
$.ajax({
	url: '<?php get_domain("/ajax/ask_teacher/withdrow.php") ?>',
	type: 'POST',
	data: "id="+id+"&&user="+user,
})
.done(function(data) {
	alert("Success ! \n We are reloading for you.");
	location.reload();
})
.fail(function() {
	alert("failed to proccess your request");
});

}
</script>
<?php
exit();
}


?>
<?php endif ?>

<?php if (user_detail("role")==2 || $row['post_type']!='Premium' ): ?>

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

<form action="" id="teacher_post_form" style="margin-top: 15px;">

<div id="editor">
<h3>Your <?php if ($row['post_type']=='Premium'): ?>
	Proposal
<?php endif ?><?php if ($row['post_type']!='Premium'): ?>
	Answer
<?php endif ?> : </h3>
<div id='edit' style="margin-top: 5px;"></div>
</div>

<div class="overflow">
<input id="cd_button" type="submit" class="button right" style="margin: 10px" value="Submit Proposal">
</div>
<input type="hidden" name="id" value="<?php echo $question_id ?>">
</form>

  <script type="text/javascript"
    src="<?php get_domain("/js/")?>codemirror.min.js"></script>
  <script type="text/javascript"
    src="<?php get_domain("/js/")?>xml.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/froala_editor.min.js"></script>




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
<style>
	#insertVideo-1 {
		display: none;
	}
</style>
  <script>
   (function () {
      const editorInstance = new FroalaEditor('#edit', {
        enter: FroalaEditor.ENTER_P,
        events: {
          'image.beforeUpload': function (files) {
            const editor = this
            if (files.length) {
              var reader = new FileReader()
              reader.onload = function (e) {
                var result = e.target.result
                editor.image.insert(result, null, null, editor.image.get())
              }
              reader.readAsDataURL(files[0])
            }
            return false
          },
          initialized: function () {
            const editor = this
            document.getElementById('preview').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('preview').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>
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

  </style>
<div id="preview" style="overflow: hidden;height: 0px; width: 0px;"></div>
<div id="d"></div>

<script>
 $(document).ready(function() {
	$("#teacher_post_form").submit(function(event) {
		event.preventDefault();
		// var data = $(this).serialize();
    var html  = $('#preview').html();
    var formData = new FormData(this);
    formData.append('content' , html);
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/ask_teacher/answer_submit.php',
			type: 'POST',
			data: formData,
      cache:false,
      contentType: false,
      processData: false,
      before:function(){
        $("#cd_button").html("Loading...");
      }
		})
		.done(function(data) {
			$('.fr-element.fr-view').html('');
			$('#preview').html("");
			<?php if ($row['post_type']=='Premium') {
				?>
			alert("proposal Submited ! \n You will be notified if the student accept your proposal.");

				<?php
			} ?>
		  location.reload();
		})
		.fail(function() {
			alert("Network Error");
		});
		
	});
});
</script>





<?php endif ?>
















<?php
	exit();
}
if ($row['post_type']=='Premium') {
	exit();
}
?>
<div class="answers_part">
</div>

<script>
function load_answers() {
	$.ajax({
		url: '<?php get_domain("/ajax/ask_teacher/load_ans.php") ?>',
		type: 'POST',
		data: {id: '<?php echo $question_id ?>'},
	})
	.done(function(data) {
		$(".answers_part").html(data);
	})
	.fail(function() {
		$(".answers_part").html("Network Error.");
	});
	
}
$(document).ready(function() {
	load_answers();
});
</script>
<div class="answering_part">
	






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




<form action="" id="teacher_post_form" style="margin-top: 15px;">

<div id="editor">
<h3>Your Answer: </h3>
<div id='edit' style="margin-top: 5px;"></div>
</div>

<div class="overflow">
<input id="cd_button" type="submit" class="button right" style="margin: 10px" value="Submit Answer">
</div>
<input type="hidden" name="id" value="<?php echo $question_id ?>">
</form>

  <script type="text/javascript"
    src="<?php get_domain("/js/")?>codemirror.min.js"></script>
  <script type="text/javascript"
    src="<?php get_domain("/js/")?>xml.min.js"></script>
  <script type="text/javascript" src="<?php get_domain("/ajax/teacher/editor/")?>js/froala_editor.min.js"></script>




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
<style>
	#insertVideo-1 {
		display: none;
	}
</style>
  <script>
   (function () {
      const editorInstance = new FroalaEditor('#edit', {
        enter: FroalaEditor.ENTER_P,
        events: {
          'image.beforeUpload': function (files) {
            const editor = this
            if (files.length) {
              var reader = new FileReader()
              reader.onload = function (e) {
                var result = e.target.result
                editor.image.insert(result, null, null, editor.image.get())
              }
              reader.readAsDataURL(files[0])
            }
            return false
          },
          initialized: function () {
            const editor = this
            document.getElementById('preview').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('preview').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>
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

  </style>
<div id="preview" style="overflow: hidden;height: 0px; width: 0px;"></div>
<div id="d"></div>
<script>
 $(document).ready(function() {
	$("#teacher_post_form").submit(function(event) {
		event.preventDefault();
		// var data = $(this).serialize();
    var html  = $('#preview').html();
    var formData = new FormData(this);
    formData.append('content' , html);
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/ask_teacher/answer_submit.php',
			type: 'POST',
			data: formData,
      cache:false,
      contentType: false,
      processData: false,
      before:function(){
        $("#cd_button").html("Loading...");
      }
		})
		.done(function(data) {
			$('.fr-element.fr-view').html('');
			$('#preview').html("");
			load_answers();
		  
		})
		.fail(function() {
			alert("Network Error");
		});
		
	});
});
</script>










</div>


</div>
</div>
</div>
</div>
<?php get_footer() ?>
