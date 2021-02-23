<?php 
include '../ajax/db_back.php';
include '../functions.php';
session_start();
?>
<?php 
$id = $_POST['id'];
?>
<script>
function read_comment(id,a)
{
$.ajax({
  url: '<?php get_domain("/blog/all_comments.php") ?>',
  type: 'POST',
  data: {id: id, a:a},
})
.done(function(data) {
  $(".sd"+id+a).html(data);
});

}
</script>

<div class="sd<?php echo $id ?>1">
  
</div>
<?php
if (isset($_SESSION['login_data_paipixel24'])) {
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


<form id="sdfg<?php echo $id; ?>" style="overflow: hidden;">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<textarea name="content" id="cn<?php echo $id; ?>" cols="30" rows="10" style="display: none;"></textarea>
	<div id="edit"></div>
	<input type="submit" name="submit" value="Comment" id="cd_button" style="float: right; border-radius: 4px;margin: 4px;">
</form>
  <script>
   (function () {
      const editorInstance = new FroalaEditor('#edit', {
      	videoUploadURL: '<?php get_domain("/upload/upload_video.php") ?>',
      	imageUploadURL: '<?php get_domain("/upload/upload_image.php") ?>',
        enter: FroalaEditor.ENTER_P,
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('cn<?php echo $id; ?>').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('cn<?php echo $id; ?>').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>
  <script>
  	$(document).ready(function() {
  		$("#sdfg<?php echo $id; ?>").submit(function(event) {
  			event.preventDefault();
  			if ($.trim($("#cn<?php echo $id; ?>").html())!='') {

  			var data = $(this).serialize();
  			$.ajax({
  				url: '<?php get_domain("/blog/post_comment.php") ?>',
  				type: 'POST',
  				data: data,
  			})
  			.done(function(data) {
  				$(".sd<?php echo $id ?>1").append(data);
  				$("#cn<?php echo $id; ?>").html("");
  				$(".fr-element.fr-view").html("");
  			});
  			}
  			
  		});
  	});
  </script>
  <?php
} else {
	echo "Login To Comment";
}
?>
<script>
	$(document).ready(function() {
		read_comment('<?php echo $id ?>',1);
	});
</script>