<?php 
include 'db.php';
$s = $_POST['search'];
$sql = "SELECT * FROM question WHERE id='$s'";
$m = mysqli_query($db,$sql);
$row = mysqli_fetch_array($m);
if (mysqli_num_rows($m)==0) {
	echo "BAD LINK";
	exit();
}
?>


<form id="ft<?php echo $s ?>" method="POST">
<input type="hidden" name="id" value="<?php echo $s ?>">
<div class="question_set">

		<h2>Question <?php echo 1 ?>:</h2>
		<textarea  style="display:none" class="input" name="q<?php echo 1 ?>" id="main_q<?php echo 1 ?>" placeholder="eg: in which date, we got independence?"><?php echo $row['question'] ?></textarea>
		<div id="question<?php echo 1 ?>"><?php echo $row['question'] ?></div>
		<table>
			<tr>
				<td>
					<h2>Option 1.</h2>
				</td>
				<td>
					 <textarea  style="display:none" name="opt<?php echo 1 ?>1" id="opt<?php echo 1 ?>1" placeholder="option 1" class="mid_in"><?php echo $row['opt1'] ?></textarea>
		<div id="at<?php echo 1 ?>1" style="max-width: 450px"><?php echo $row['opt1'] ?></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 2.</h2>
				</td>
				<td>
					<textarea  style="display:none" name="opt<?php echo 1 ?>2" id="opt<?php echo 1 ?>2" placeholder="option 2" class="mid_in"><?php echo $row['opt2'] ?></textarea>
		<div id="at<?php echo 1 ?>2" style="max-width: 450px"><?php echo $row['opt2'] ?></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 3.</h2>
				</td>
				<td>
					 <textarea  style="display:none" name="opt<?php echo 1 ?>3" id="opt<?php echo 1 ?>3" placeholder="option 3" class="mid_in"><?php echo $row['opt3'] ?></textarea>
		<div id="at<?php echo 1 ?>3" style="max-width: 450px"><?php echo $row['opt3'] ?></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 4.</h2>
				</td>
				<td>
					<textarea type="text" style="display:none"  name="opt<?php echo 1 ?>4" id="opt<?php echo 1 ?>4" placeholder="option 4" class="mid_in"><?php echo $row['opt4'] ?></textarea>
		<div id="at<?php echo 1 ?>4" style="max-width: 450px"><?php echo $row['opt4'] ?></div>
				</td>
			</tr>
		</table>

			<br>
		<table>
<?php 
function make_selec($a,$b)
{
if ($a==$b) {
	echo "selected";
}
}
?>
		<tr>
			<td>Currect </td>
			<td>
		<select  name="currect<?php echo 1 ?>" id="" class="mid_in">
			<option value="1" <?php make_selec($row['currect'],"1") ?>>option 1</option>
			<option value="2" <?php make_selec($row['currect'],"2") ?>>option 2</option>
			<option value="3" <?php make_selec($row['currect'],"3") ?>>option 3</option>
			<option value="4" <?php make_selec($row['currect'],"4") ?>>option 4</option>
		</select>
	</td>
		</tr>
		<tr>
			<td>Topic Name </td>
			<td><textarea  name="topic<?php echo 1 ?>" id="topic<?php echo 1 ?>" cols="30" rows="2" class="mid_in" placeholder="seperate using comma"><?php echo $row['Exam_name'] ?></textarea></td>
		</tr>
		<tr style="display: none;">
			<td>Hints: </td>
			<td><textarea  name="tips<?php echo 1 ?>" id="tips<?php echo 1 ?>" cols="30" rows="2" class="mid_in"><?php echo $row['tips'] ?></textarea></td>
		</tr>
		<tr>
			<td>Explain: </td>
			<td><textarea style="display: none"  name="explain<?php echo 1 ?>" id="explain<?php echo 1 ?>" cols="30" rows="2" class="mid_in"><?php echo $row['details'] ?></textarea><div id="edit<?php echo 1 ?>"><?php echo $row['details'] ?></div>
      </td>
		</tr>
    <tr>
      <td>Audio Explaination: </td>
      <td>
      	<?php echo $row['audio_explain'];br(); ?>
      	<?php 
if ($row['audio_explain']=='') {
	echo "No audio Yet Here";br();
}
      	?>
<input type="file" name="audio<?php echo 1 ?>" id="audio">
      </td>
    </tr>
		</table>
<style>
      button[data-cmd="insertHTML"]:before{
        content: "Division Sign";
        font-weight: bold;
      }
      button[data-cmd="insertHTML"] .fr-svg{
        display: none !important;
      } button[data-cmd="insertX"]:before{
        content: "Multiplication Sign";
        font-weight: bold;
      }
      button[data-cmd="insertX"] .fr-svg{
        display: none !important;
      }
      .fr-element.fr-view #sotnont td {
        padding: 4px 14px !important;
      }
      .fr-popup {
        z-index: 40000 !important;
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
    
      const editorInstance = new FroalaEditor('#edit<?php echo 1 ?>', {
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
        imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('explain<?php echo 1 ?>').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('explain<?php echo 1 ?>').innerHTML = editor.html.get()
          }

        }
      })
    })()
  </script>
<script>
   (function () {
      const editorInstance = new FroalaEditor('#question<?php echo 1 ?>', {
        imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        pastePlain: true,
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
        enter: FroalaEditor.ENTER_BR,
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('main_q<?php echo 1 ?>').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('main_q<?php echo 1 ?>').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>
  <script>
   (function () {
      const editorInstance = new FroalaEditor('#at<?php echo 1 ?>1', {
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
        enter: FroalaEditor.ENTER_BR,
        imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        pastePlain: true,
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('opt<?php echo 1 ?>1').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('opt<?php echo 1 ?>1').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>
  <script>
   (function () {
      const editorInstance = new FroalaEditor('#at<?php echo 1 ?>2', {
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
        enter: FroalaEditor.ENTER_BR,
        imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        pastePlain: true,
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('opt<?php echo 1 ?>2').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('opt<?php echo 1 ?>2').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>  <script>
   (function () {
      const editorInstance = new FroalaEditor('#at<?php echo 1 ?>3', {
        imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
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
        enter: FroalaEditor.ENTER_BR,
        pastePlain: true,
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('opt<?php echo 1 ?>3').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('opt<?php echo 1 ?>3').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>  <script>
   (function () {
      const editorInstance = new FroalaEditor('#at<?php echo 1 ?>4', {
        imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
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
        enter: FroalaEditor.ENTER_BR,
        pastePlain: true,

        events: {
          initialized: function () {
            const editor = this
            document.getElementById('opt<?php echo 1 ?>4').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('opt<?php echo 1 ?>4').innerHTML = editor.html.get()
          },
          'image.error': function (error, response) {
        // Bad link.
        if (error.code == 4) { alert(response); }
      }
        }
      })
    })()
  </script>
	</div>
	</div>
</form>