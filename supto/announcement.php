<?php 
include 'db.php';
if (isset($_GET['del'])) {
$id = $_GET['del'];
$sql = "DELETE FROM `announce` WHERE id='$id'";
mysqli_query($db,$sql);
}
?>
<?php if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM `announce` WHERE id='$id'";
	$m = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($m);
} ?>
<html style="background:url(<?php get_domain("/image/check.gif") ?>) 0 0 / 100% 100%">
<head>
	<title>Announcement - Paipixel DashBoard</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=0.01"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php get_domain("/")?>css/main.css">
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
<body style="background:url(<?php get_domain("/image/check.gif") ?>) 0 0 / 100% 100%">
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
<div class="main_box" style="margin: 10px;">
<form id="amni_form" style="max-width: 1200px; margin: 0px auto; overflow: hidden;">
	<?php if (isset($_GET['id'])) {
		?>
<h3>Editing: <?php echo $_GET['id'] ?> <a href="announcement.php" style="font-family: arial; color:red;">x</a></h3>
<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
		<?php
	} ?>
<input type="text" name="header" style="width:100%" value="<?php if (isset($_GET['id'])) {
echo $row['header'];
  } ?>" class="input" placeholder="header">
	<div id="edit"><?php if (isset($_GET['id'])) {
echo $row['body'];
	} ?></div>
	<textarea name="consoe" id="consoe" cols="30" rows="10" style="display: none;"><?php if (isset($_GET['id'])) {
echo $row['body'];
	} ?></textarea>
	<button id="cd_button" onclick="uploadit()">Submit</button>
	<style>
#cd_button {
  background: none;
  color: #ff3c00;
  border: 1px solid #ff3c00;
  border-radius: 11px;
  padding: 9px 20px;
  margin: 10px;
  float: right;
}
#cd_button:hover {
  background: #ff3c00;
  color: white;
}
	</style>
</form>

<style>
	#insertVideo-1 {
		display: none;
	}
</style>

  <div id="preview" style="overflow: hidden;height: 0px; width: 0px;"></div>
  <div id="d"></div>
<script>
 $(document).ready(function() {
	$("#amni_form").submit(function(event) {
		event.preventDefault();
    var formData = new FormData(this);
	$.ajax({
	  url: 'announce_post.php',
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
		  alert(data);
		  window.location="announcement.php";
     
		})
		.fail(function() {
			alert("Network Error");
		});
		
	});
});
</script>
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
		  <script>
   (function () {
      const editorInstance = new FroalaEditor('#edit', {
        enter: FroalaEditor.ENTER_P,
        imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('consoe').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('consoe').innerHTML = editor.html.get()
          }

        }
      })
    })()
  </script>


 <div class="old_anonceq" style="max-width: 1200px; margin: 0px auto;">
<?php 
$sql = "SELECT * FROM `announce` ORDER BY id DESC";
$q= mysqli_query($db,$sql);
while ($row=mysqli_fetch_array($q)) {
	?>
<div style="padding: 1%; margin: 1%; border: 1px solid #ccc; background: white; overflow: hidden">
 	<a id="cd_button" style="text-decoration: none;" href="announcement.php?id=<?php echo $row['id'] ?>">edit</a><a style="text-decoration: none;" id="cd_button" href="announcement.php?del=<?php echo $row['id'] ?>">delete</a>
<h3><?php echo $row['header'] ?></h3>
<div class="alim_vai">
	<?php echo $row['body'] ?>
</div>

</div>
	<?php
}
?>
 </div>
</body>
</html>