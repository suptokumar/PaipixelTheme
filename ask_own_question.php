<?php 
include 'header.php';
get_header("Add Own Question - PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
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

<?php
$role = user_detail("role");
if ($role==1) {
	?>
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




<form action="" id="teacher_post_form">
<label for="questions">
<h2>Your Question</h2>
<input type="text" name="questions" class="input" id="questions">
</label>
<div id="editor">
<h2>Detail , Description OR examples</h2>
<div id='edit' style="margin-top: 30px;"></div>
</div>


 <div class="overflow">
<fieldset>
    <legend>Question Details: </legend>
    <script>
		$(document).ready(function() {
			get_subject("subject",<?php echo user_detail("class") ?>);
			get_chapter("chapter",<?php echo user_detail("class") ?>,'বাংলা প্রথম পত্র');
		});
	</script>
	<div class="border_box">
		<label for="subject"><h3>Subject</h3>
			<select class="input" name="subject" id="subject" onchange="get_chapter('chapter',<?php echo user_detail("class") ?>,this.value);"></select>
		</label>
	</div>
	<div class="border_box">
		<label for="chapter"><h3>Chapter</h3>
			<select class="input" name="chapter" id="chapter"></select>
		</label>
	</div>
</fieldset>
<fieldset>
    <legend>Question Type: </legend>
    <div class="atp">
    <input type="radio" checked onclick="ft(1)" value="Free" name="radio-1" id="radio-a" />
    <label for="radio-a">Free</label>
    </div>
    <div class="atp">
    <input type="radio" onclick="ft(0)" value="Premium" name="radio-1" id="radio-b" />
    <label for="radio-b">Premium</label>
    </div>
</fieldset>
<fieldset style="display: none;" class="atondo">
    <legend>Premium Details: </legend>
    <div style="overflow: hidden;">
    	
    <h3>How do you want to get the result?</h3>
    <div class="atp">
    <input type="radio" checked value="Article" name="radio-2" id="radio-1" />
    <label for="radio-1">Article</label>
    </div>
    <div class="atp">
    <input type="radio" checked name="radio-2" value="Audio" id="radio-2" />
    <label for="radio-2">Audio</label>
    </div>
    <div class="atp">
    <input type="radio" name="radio-2" value="Video" id="radio-3" />
    <label for="radio-3">Video</label>
    </div>
    <div class="atp">
    <input type="radio" name="radio-2" value="Explained Content" id="radio-4" />
    <label for="radio-4">Explained Content</label>
    </div>
    <div class="atp">
    <input type="radio" name="radio-2" value="Live Video Call" id="radio-5" />
    <label for="radio-5">Live Video Call</label>
    </div>
    </div>
    <div class="parts" style="display: block;">
    <h3>
    	Offer a Price to get your Answer. (Good Price can make the fastest response and best answer for you).
    </h3>
    <input type="number" min="50" name="price" class="input">
    </div>
</fieldset>
<fieldset class="atondo">
<legend>About Question Type: </legend>
<div class="content_set">

<h3>General Rules</h3>
<p>
	If your question contains hate speech, violence, harassment, scams or any kind of violation of PaiPixel Privacy Policy, then your account may get temporarily or permanently blocked.
</p>

<h3>Free Features: </h3>
<ul style="margin: 1% 5%">
	<li>Anyone(Student/Teacher) can answer your question. </li>
	<li>Your question may remain in pending mode more than a few hours or days. Even you may not get your answer at all, if no one is willing to answer.</li>
	<li>You may get inappropriate answer. Because anyone can answer your question as long as they may not have enough knowledge about the topic you've questioned</li>
	<li>You won't get an answer in Audio, Video or Live Video Call mode.</li>
</ul>
<h3>Premium Features: </h3>
<ul style="margin: 1% 5%">
	<li>Only verified teacher will answer your question according to your preferred answer type.</li>
	<li>Your preferred answer type can be in Article, Explained Article, Audio, Video and Live Video Call.</li>
	<li>You can select the teacher of your own choice to get your question answered.</li>
	<li>You will definitely get your answer within 8 hours after selecting the teacher.</li>
</ul>
</div>
</fieldset>
<script>
function ft(t)
{
if (t==0) {
$(".atondo").slideDown(400);
} else {
$(".atondo").slideUp(400);
}
}
</script>
 </div>
<div class="overflow">
<input id="cd_button" type="submit" class="button right" style="margin: 10px" value="Post Question">
</div>

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
      	videoUploadURL: '<?php get_domain("/upload/upload_video.php") ?>',
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
			url: '<?php get_domain("/") ?>ajax/ask_teacher/post.php',
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
		  var data = $.trim(data);
        $("#teacher_post_form").html(data);
		})
		.fail(function() {
			alert("Network Error");
		});
		
	});
});
</script>


<style>
	
.e10fd {
  font-size: 24px;
}
.box_edon {
  border: 1px solid #ccc;
  padding: 1%;
  background: lightgreen;
}
.box_edon div {
  text-align: center;
}
.box_edon div h2 {
  font-size: 17px;
  color: blue;
  margin-top: 10px;
}
.ullink {
  text-decoration: none;
  display: inline-block;
  padding: 13px;
  margin-top: 10px;
  border: 1px solid #ccc;
  color: white;
  transition: .4s;
}
.ullink:hover {
	border: 1px solid red;
	color: red;
	background: transparent !important;
}
.eo{
	background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>;
}
.edd{
	background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>;
}
</style>














	<?php
}
 
	?>
			</div>
	</div>
</div>
</div>
</div>
</div>
</body>
</html>