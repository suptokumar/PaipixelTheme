<?php include '../ajax/db_back.php'; ?>
<?php include '../functions.php'; ?>
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
</style><style>
			button[data-cmd="insertHTML"]:before{
        content: "Division Sign";
        font-weight: bold;
      }
      button[data-cmd="insertHTML"] .fr-svg{
        display: none !important;
      }	button[data-cmd="insertX"]:before{
        content: "Multiplication Sign";
        font-weight: bold;
      }
      button[data-cmd="insertX"] .fr-svg{
        display: none !important;
      }
      .fr-element.fr-view #sotnont td {
      	padding: 4px 14px !important;
      }
		</style>
	  <script>
	  	(function () {

   	FroalaEditor.DefineIcon('insertHTML', { NAME: 'plus', SVG_KEY: 'add' });

    FroalaEditor.RegisterCommand('insertHTML', {
      title: 'Insert HTML',
      focus: true,
      undo: true,
      pastePlain: true,
      refreshAfterCallback: true,
      callback: function () {
        this.html.insert('<table style="display: inline-block;vertical-align:middle; text-align: center;" id="sotnont"> <tbody><tr> <td style="border-bottom: 1px solid; padding: 4px 4px; ">x</td> </tr> <tr> <td style=" padding: 4px 4px; ">y</td> </tr> </tbody></table>');
        this.undo.saveStep();
      }
    });
    FroalaEditor.DefineIcon('insertX', { NAME: 'plus', SVG_KEY: 'add' });

    FroalaEditor.RegisterCommand('insertX', {
      title: 'Insert HTML',
      focus: true,
      pastePlain: true,
      undo: true,
      refreshAfterCallback: true,
      callback: function () {
        this.html.insert('<span style="font-family: arial;"> x </span>');
        this.undo.saveStep();
      }
    });
    
      const editorInstance = new FroalaEditor('#edit', {
        enter: FroalaEditor.ENTER_BR,
        toolbarButtons: {
      'moreText': {
        'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting', 'insertHTML', 'insertX']
      },
      'moreParagraph': {
        'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
      },
      'moreRich': {
        'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR','html']
      },
    },
        pastePlain: true,
      	imageUploadURL: '<?php get_domain("/upload/upload_image.php") ?>',
        enter: FroalaEditor.ENTER_BR,
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('area').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('area').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>

<div class="post_area" style="overflow: hidden;">
	<form id="myblogpost">
		<?php 
		if (isset($_POST['edit'])) {
		 	$id = $_POST['edit'];
		 	$sql = "SELECT * FROM announce WHERE id='$id'";
		 	$r = mysqli_query($db,$sql);
		 	$row = mysqli_fetch_array($r);
		 	?>
<input type="hidden" name="id" value="<?php echo $id; ?>">
		 	<?php
		 } ?>
		 	<script>
function get_subject(id,clas)
{
	$.ajax({
		url: '<?php get_domain("/ajax/teacher/subject.php") ?>',
		type: 'GET',
		data: {class: clas},
	})
	.done(function(data) {
		$("#"+id).html(data);
	});
	
}
</script>
<script>
function get_chapter(id,clas,subject)
{
	$.ajax({
		url: '<?php get_domain("/ajax/teacher/oddhay.php") ?>',
		type: 'GET',
		data: {class: clas, subject: subject},
	})
	.done(function(data) {
		$("#"+id).html(data);
	});
	
}
</script>
		<input type="text" name="header" class="input" style="border:2px solid green;" placeholder="Type Your content Header Here." value="<?php if(isset($_POST['edit'])){echo $row['header'];} ?>">
		<select name="class" id="class" style="border:1px solid #ccc; padding: 10px" onchange="get_subject('subject',this.value);get_chapter('chapter',this.value,document.getElementById('subject').value);">
			<option value="">--Select Class--</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		</select>
		<select name="subject" value="<?php echo $subject ?>" style="border:1px solid #ccc; padding: 10px" id="subject" onchange="get_chapter('chapter',document.getElementById('class').value,this.value);">
			<option value="">--Select Subject--</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		</select>
		<select name="chapter" value="<?php echo $chapter ?>" style="border:1px solid #ccc; padding: 10px" id="chapter">
			<option value="">--Select Chapter--</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		</select>
		<br><br>
		<textarea name="area" id="area" cols="30" rows="10" class="input" class="ararea" style="display: none;"><?php if(isset($_POST['edit'])){echo $row['body'];} ?></textarea>
		<div id="edit"><?php if(isset($_POST['edit'])){echo $row['body'];} ?></div>
		<button id="cd_button" style="cursor: pointer; border-radius: 2px; margin: 4px; float: right; font-size: 18px"><?php if (isset($_POST['edit'])) {
			echo "Update";
		} else {
			echo "Post";
		} ?></button>
	</form>

	<script>
		$(document).ready(function() {
			$("#myblogpost").submit(function(event) {
				event.preventDefault();
				var data = $(this).serialize();
				$.ajax({
					url: '<?php get_domain("/blog/post.php") ?>',
					type: 'POST',
					data: data,
				})
				.done(function(v) {
					alert(v);
					$(".nots").html(v);
					$(".input").val("");
					$(".fr-element.fr-view").html("");

					$.ajax({
			url: '<?php get_domain("/") ?>blog/post_area.php',
		})
		.done(function(data) {
			$(".mango_script").html(data);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

		
					$.ajax({
			url: '<?php get_domain("/") ?>blog/total_post.php',
		})
		.done(function(data) {
			$(".all_post").html(data);
		});
				});
				
			});
		});
	</script>
</div>

<?php  mysqli_close($db); ?>