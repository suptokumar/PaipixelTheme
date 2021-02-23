
<?php 
include '../extra/db.extra.php';
?>

<?php
$r = $_GET['r'];

for ($i=0; $i < $r; $i++) { 
	$a = rand(0,9);
	$b = rand(0,9);
	$c = rand(0,9);
	?>
	<div class="question_set" style="background:#<?php echo $a.$b.$c.$a.$b.$c.'15'; ?>">

		<h2>Question <?php echo $i+1 ?>:</h2><span style="color: orangered; font-size: 13px">* if you can't make questions with the following tools & options, then please prepare questions in microsoft word or other editors, make a screenshot, crop the question and upload here.</span>
		<textarea  style="display:none" class="input" name="q<?php echo $i+1 ?>" id="main_q<?php echo $i+1 ?>" placeholder="eg: in which date, we got independence?"></textarea>
		<div id="question<?php echo $i+1 ?>"></div>
		<table>
			<tr>
				<td>
					<h2>Option 1.</h2>
				</td>
				<td>
					 <textarea  style="display:none" name="opt<?php echo $i+1 ?>1" id="opt<?php echo $i+1 ?>1" placeholder="option 1" class="mid_in"></textarea>
		<div id="at<?php echo $i+1 ?>1" style="max-width: 450px"></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 2.</h2>
				</td>
				<td>
					<textarea  style="display:none" name="opt<?php echo $i+1 ?>2" id="opt<?php echo $i+1 ?>2" placeholder="option 2" class="mid_in"></textarea>
		<div id="at<?php echo $i+1 ?>2" style="max-width: 450px"></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 3.</h2>
				</td>
				<td>
					 <textarea  style="display:none" name="opt<?php echo $i+1 ?>3" id="opt<?php echo $i+1 ?>3" placeholder="option 3" class="mid_in"></textarea>
		<div id="at<?php echo $i+1 ?>3" style="max-width: 450px"></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 4.</h2>
				</td>
				<td>
					<textarea type="text" style="display:none"  name="opt<?php echo $i+1 ?>4" id="opt<?php echo $i+1 ?>4" placeholder="option 4" class="mid_in"></textarea>
		<div id="at<?php echo $i+1 ?>4" style="max-width: 450px"></div>
				</td>
			</tr>
		</table>

			<br>
		<table>
		<tr>
			<td>Currect </td>
			<td>
		<select  name="currect<?php echo $i+1 ?>" id="" class="mid_in">
			<option value="1">option 1</option>
			<option value="2">option 2</option>
			<option value="3">option 3</option>
			<option value="4">option 4</option>
		</select>
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
    
      const editorInstance = new FroalaEditor('#edit<?php echo $i+1 ?>', {
        enter: FroalaEditor.ENTER_BR,
        toolbarButtons: {
      'moreText': {
        'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting', 'insertHTML', 'insertX']
      },
      'moreParagraph': {
        'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
      },
      'moreRich': {
        'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR',<?php if (user_detail("user_name")=='TravellerAlim') {echo "'html'";} ?>]
      },
    },
        imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('explain<?php echo $i+1 ?>').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('explain<?php echo $i+1 ?>').innerHTML = editor.html.get()
          }

        }
      })
    })()
  </script>
 <script>
   (function () {
      const editorInstance = new FroalaEditor('#question<?php echo $i+1 ?>', {
      	imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        enter: FroalaEditor.ENTER_BR,
        toolbarButtons: {
      'moreText': {
        'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting', 'insertHTML', 'insertX']
      },
      'moreParagraph': {
        'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
      },
      'moreRich': {
        'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR',<?php if (user_detail("user_name")=='TravellerAlim') {echo "'html'";} ?>]
      },
    },
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('main_q<?php echo $i+1 ?>').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('main_q<?php echo $i+1 ?>').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>
  <script>
   (function () {
      const editorInstance = new FroalaEditor('#at<?php echo $i+1 ?>1', {
        enter: FroalaEditor.ENTER_BR,
        toolbarButtons: {
      'moreText': {
        'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting', 'insertHTML', 'insertX']
      },
      'moreParagraph': {
        'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
      },
      'moreRich': {
        'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR',<?php if (user_detail("user_name")=='TravellerAlim') {echo "'html'";} ?>]
      },
    },
        imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('opt<?php echo $i+1 ?>1').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('opt<?php echo $i+1 ?>1').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>
  <script>
   (function () {
      const editorInstance = new FroalaEditor('#at<?php echo $i+1 ?>2', {
        enter: FroalaEditor.ENTER_BR,
        toolbarButtons: {
      'moreText': {
        'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting', 'insertHTML', 'insertX']
      },
      'moreParagraph': {
        'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
      },
      'moreRich': {
        'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR',<?php if (user_detail("user_name")=='TravellerAlim') {echo "'html'";} ?>]
      },
    },
        imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('opt<?php echo $i+1 ?>2').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('opt<?php echo $i+1 ?>2').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>  <script>
   (function () {
      const editorInstance = new FroalaEditor('#at<?php echo $i+1 ?>3', {
      	imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        enter: FroalaEditor.ENTER_BR,
        toolbarButtons: {
      'moreText': {
        'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting', 'insertHTML', 'insertX']
      },
      'moreParagraph': {
        'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
      },
      'moreRich': {
        'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR',<?php if (user_detail("user_name")=='TravellerAlim') {echo "'html'";} ?>]
      },
    },
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('opt<?php echo $i+1 ?>3').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('opt<?php echo $i+1 ?>3').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>  <script>
   (function () {
      const editorInstance = new FroalaEditor('#at<?php echo $i+1 ?>4', {
      	imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        enter: FroalaEditor.ENTER_BR,
        toolbarButtons: {
      'moreText': {
        'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting', 'insertHTML', 'insertX']
      },
      'moreParagraph': {
        'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
      },
      'moreRich': {
        'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR',<?php if (user_detail("user_name")=='TravellerAlim') {echo "'html'";} ?>]
      },
    },
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('opt<?php echo $i+1 ?>4').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('opt<?php echo $i+1 ?>4').innerHTML = editor.html.get()
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

	<?php
}

 ?>

 <input type="submit" value="Create Question" id="cd_button" class="button" name="create_q">
