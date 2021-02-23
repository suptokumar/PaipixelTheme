<?php 

if (isset($_POST['id'])) {

?>


<?php 
include '../extra/db.extra.php';
?>
<style>
  .second-toolbar #logo{
    display: none !important;
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




<?php 
$id = $_POST['id'];
$sql = "SELECT * FROM tutorial WHERE id='$id'";
$s = mysqli_query($db,$sql);
$row = mysqli_fetch_array($s);

function match_class($v1,$v2)
{
  if ($v1==$v2) {
    echo "selected";
  }
}
?>
<script>
  $(document).ready(function() {
    get_subject(<?php echo $row['class'] ?>);
  });
</script>

<form action="" id="teacher_post_form">
<div class="incoder">
  <label for="title">Title / Topic</label>
  <input name="title" value="<?php echo $row['title'] ?>" placeholder="eg: বেগ ও বেগের পরিবর্তন" class="input" id="title" type="text">
</div>
<div class="incoder">
  <label for="class">Select A Class (optional)</label>
  <select name="class" class="input" onchange="get_subject(this.value)" id="class">
    <option value="" <?php match_class('',$row['class']) ?>>--Select--</option>
    <option value="6" <?php match_class(6,$row['class']) ?>>6</option>
    <option value="7" <?php match_class(7,$row['class']) ?>>7</option>
    <option value="8" <?php match_class(8,$row['class']) ?>>8</option>
    <option value="9" <?php match_class(9,$row['class']) ?>>9</option>
    <option value="10" <?php match_class(10,$row['class']) ?>>10</option>
    <option value="11" <?php match_class(11,$row['class']) ?>>11</option>
    <option value="12" <?php match_class(12,$row['class']) ?>>12</option>
  </select>
</div>

<div class="incoder">
  <label for="subject">Select A Subject (optional)</label>
  <select name="subject" class="input" id="subject">
<option value="">--Select--</option>
<option value="বাংলা প্রথম পত্র">বাংলা প্রথম পত্র</option>
<option value="বাংলা দ্বিতীয় পত্র">বাংলা দ্বিতীয় পত্র</option>
<option value="ইংরেজি প্রথম পত্র">ইংরেজি প্রথম পত্র</option>
<option value="ইংরেজি দ্বিতীয় পত্র">ইংরেজি দ্বিতীয় পত্র</option>
<option value="গনিত">গনিত</option>
<option value="সাধারণ বিজ্ঞান">সাধারণ বিজ্ঞান</option>
<option value="কৃষিশিক্ষা">কৃষিশিক্ষা</option>
<option value="বাংলাদেশ ও বিশ্ব পরিচয়">বাংলাদেশ ও বিশ্ব পরিচয়</option>
<option value="তথ্য ও যোগাযোগ প্রযুক্তি">তথ্য ও যোগাযোগ প্রযুক্তি</option>
<option value="ইসলাম ও নৈতিক শিক্ষা">ইসলাম ও নৈতিক শিক্ষা</option>
<option value="হিন্দু ধর্ম ও নৈতিক শিক্ষা">হিন্দু ধর্ম ও নৈতিক শিক্ষা</option>
<option value="খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা">খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা</option>
<option value="বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা">বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা</option>
<option value="চারু ও কারু কলা">চারু ও কারু কলা</option>
<option value="কর্ম ও জীবনমুখী শিক্ষা">কর্ম ও জীবনমুখী শিক্ষা</option>
<option value="শারীরিক শিক্ষা">শারীরিক শিক্ষা</option>
</select>
</div>
<div class="incoder">
  <label for="chapter">Select A Chapter (optional)</label>
  <select name="chapter" class="input" id="chapter">
<option value="">--Select--</option>
<option value="1st">1st</option>
<option value="2nd">2nd</option>
</select>
</div>
<script>
  function get_subject(val)
  {
    $.ajax({
      url: '<?php get_domain("/") ?>ajax/teacher/subject.php',
      type: 'GET',
      data: {class: val},
    })
    .done(function(data) {
      $("#subject").html(data);
    })
    .fail(function() {
      $("#subject").html('<option value="">--Select--</option> <option value="বাংলা প্রথম পত্র">বাংলা প্রথম পত্র</option> <option value="বাংলা দ্বিতীয় পত্র">বাংলা দ্বিতীয় পত্র</option> <option value="ইংরেজি প্রথম পত্র">ইংরেজি প্রথম পত্র</option> <option value="ইংরেজি দ্বিতীয় পত্র">ইংরেজি দ্বিতীয় পত্র</option> <option value="গনিত">গনিত</option> <option value="সাধারণ বিজ্ঞান">সাধারণ বিজ্ঞান</option> <option value="কৃষিশিক্ষা">কৃষিশিক্ষা</option> <option value="বাংলাদেশ ও বিশ্ব পরিচয়">বাংলাদেশ ও বিশ্ব পরিচয়</option> <option value="তথ্য ও যোগাযোগ প্রযুক্তি">তথ্য ও যোগাযোগ প্রযুক্তি</option> <option value="ইসলাম ও নৈতিক শিক্ষা">ইসলাম ও নৈতিক শিক্ষা</option> <option value="হিন্দু ধর্ম ও নৈতিক শিক্ষা">হিন্দু ধর্ম ও নৈতিক শিক্ষা</option> <option value="খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা">খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা</option> <option value="বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা">বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা</option> <option value="চারু ও কারু কলা">চারু ও কারু কলা</option> <option value="কর্ম ও জীবনমুখী শিক্ষা">কর্ম ও জীবনমুখী শিক্ষা</option> <option value="শারীরিক শিক্ষা">শারীরিক শিক্ষা</option>'); }); } </script>
<div class="incoder">
  <label for="youtube_link">Youtube Video Link (optional)</label>
  <input name="youtube_link" placeholder="eg: http://youtube.com/watch?=efo264t0c4" class="input" value="<?php echo $row['youtube'] ?>" id="youtube_link" type="text">
</div>

<div id="editor">
<label for="edit">Tutorial Contents</label>
    <div id='edit' style="margin-top: 30px;"><?php echo $row['content'] ?></div>
</div>
<div class="incoder"><br><br>
  <label for="upload_main">
    <?php if ($row['description']!='') {
     echo "Change Uploaded Content";
    } else {?>Full Content Upload <?php } ?></label>
  <input type="file" name="file" class="input" id="upload_main">
</div>
<div class="incoder"><br><br>
  <label for="hero-demo">Tags</label>
  <textarea id="hero-demo" style="padding: 10px" name="hero-demo"><?php echo $row['tags'] ?></textarea>
</div>
<div class="incoder"><br>
  <label for="ts25">Is the tutorial free or Paid? If paid, you will earn 80% of every sell.</label>


  <select name="ts25" id="ts25" onchange="change_incoder(this.value);" class="input">
    <option value="paid" <?php match_class("paid", $row['type']) ?>>paid</option>
    <option value="free" <?php match_class("free", $row['type']) ?>>free</option>
  </select>
</div>
<script>
  $(document).ready(function() {
    change_incoder("<?php echo $row['type'] ?>");
  });
</script>
<script>
function change_incoder(val)
{
if (val=='free') {
  $(".price_range").hide("slow");
} else {
  $(".price_range").show("slow");
}
}
</script>
<div class="incoder price_range"><br>
  <label for="price">Make a right price for a good sell.</label>
  <input type="number" name="price" value="<?php echo $row['price'] ?>" id="price" class="input">
</div>
<div class="incoder price_range"><br>
  <label for="vprice">Price with video</label>
  <input type="number" name="vprice" value="<?php echo $row['vprice'] ?>" id="vprice" class="input">
</div>
<div class="overflow">
  <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
<input id="cd_button" type="submit" class="button right" style="margin: 10px" value="Edit Post">
</div>

</form>

<script src="<?php get_domain("/js/") ?>jquery-1.11.1.min.js"></script>
<script src="<?php get_domain("/js/") ?>jquery-ui.min.js"></script>

<script src="<?php get_domain("/ajax/teacher/")?>jquery.caret.min.js"></script>
<script src="<?php get_domain("/ajax/teacher/")?>jquery.tag-editor.js"></script>
<script>
        // jQuery UI autocomplete extension - suggest labels may contain HTML tags
        // github.com/scottgonzalez/jquery-ui-extensions/blob/master/src/autocomplete/jquery.ui.autocomplete.html.js
        (function($){var proto=$.ui.autocomplete.prototype,initSource=proto._initSource;function filter(array,term){var matcher=new RegExp($.ui.autocomplete.escapeRegex(term),"i");return $.grep(array,function(value){return matcher.test($("<div>").html(value.label||value.value||value).text());});}$.extend(proto,{_initSource:function(){if(this.options.html&&$.isArray(this.options.source)){this.source=function(request,response){response(filter(this.options.source,request.term));};}else{initSource.call(this);}},_renderItem:function(ul,item){return $("<li></li>").data("item.autocomplete",item).append($("<a></a>")[this.options.html?"html":"text"](item.label)).appendTo(ul);}});})(jQuery);

        var cache = {};
        function googleSuggest(request, response) {
            var term = request.term;
            if (term in cache) { response(cache[term]); return; }
            $.ajax({
                url: 'https://query.yahooapis.com/v1/public/yql',
                dataType: 'JSONP',
                data: { format: 'json', q: 'select * from xml where url="http://google.com/complete/search?output=toolbar&q='+term+'"' },
                success: function(data) {
                    var suggestions = [];
                    try { var results = data.query.results.toplevel.CompleteSuggestion; } catch(e) { var results = []; }
                    $.each(results, function() {
                        try {
                            var s = this.suggestion.data.toLowerCase();
                            suggestions.push({label: s.replace(term, '<b>'+term+'</b>'), value: s});
                        } catch(e){}
                    });
                    cache[term] = suggestions;
                    response(suggestions);
                }
            });
        }

        $(function() {
            $('#hero-demo').tagEditor({
                placeholder: 'Enter tags ...',
                autocomplete: { source: googleSuggest, minLength: 3, delay: 250, html: true, position: { collision: 'flip' } }
            });
        });
    </script>
     <link rel="stylesheet" href="<?php get_domain("/js/")?>pure-min.css">

    <link rel="stylesheet" href="<?php get_domain("/ajax/teacher/")?>jquery.tag-editor.css">


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
      url: '<?php get_domain("/") ?>ajax/teacher/post_tutorial.php',
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
      if (data=='Failed to save the Tutorial') {
        alert(data);
      } else {
       window.location='<?php get_domain("?msg=Post Updated !") ?>'
      }
    })
    .fail(function() {
      alert("Network Error");
    });
    
  });
});
</script>


<?php exit(); } ?>















































































































<?php 
include '../extra/db.extra.php';
?>
<style>
	.second-toolbar #logo{
		display: none !important;
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
<div class="incoder">
	<label for="title">Title / Topic</label>
	<input name="title" placeholder="eg: বেগ ও বেগের পরিবর্তন" class="input" id="title" type="text">
</div>
<div class="incoder">
	<label for="class">Select A Class (optional)</label>
	<select name="class" class="input" onchange="get_subject(this.value)" id="class">
		<option value="">--Select--</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
	</select>
</div>
<div class="incoder">
	<label for="subject">Select A Subject (optional)</label>
	<select name="subject" class="input" id="subject">
<option value="">--Select--</option>
<option value="বাংলা প্রথম পত্র">বাংলা প্রথম পত্র</option>
<option value="বাংলা দ্বিতীয় পত্র">বাংলা দ্বিতীয় পত্র</option>
<option value="ইংরেজি প্রথম পত্র">ইংরেজি প্রথম পত্র</option>
<option value="ইংরেজি দ্বিতীয় পত্র">ইংরেজি দ্বিতীয় পত্র</option>
<option value="গনিত">গনিত</option>
<option value="সাধারণ বিজ্ঞান">সাধারণ বিজ্ঞান</option>
<option value="কৃষিশিক্ষা">কৃষিশিক্ষা</option>
<option value="বাংলাদেশ ও বিশ্ব পরিচয়">বাংলাদেশ ও বিশ্ব পরিচয়</option>
<option value="তথ্য ও যোগাযোগ প্রযুক্তি">তথ্য ও যোগাযোগ প্রযুক্তি</option>
<option value="ইসলাম ও নৈতিক শিক্ষা">ইসলাম ও নৈতিক শিক্ষা</option>
<option value="হিন্দু ধর্ম ও নৈতিক শিক্ষা">হিন্দু ধর্ম ও নৈতিক শিক্ষা</option>
<option value="খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা">খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা</option>
<option value="বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা">বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা</option>
<option value="চারু ও কারু কলা">চারু ও কারু কলা</option>
<option value="কর্ম ও জীবনমুখী শিক্ষা">কর্ম ও জীবনমুখী শিক্ষা</option>
<option value="শারীরিক শিক্ষা">শারীরিক শিক্ষা</option>
</select>
</div>
<div class="incoder">
  <label for="chapter">Select A Chapter (optional)</label>
  <select name="chapter" class="input" id="chapter">
<option value="">--Select--</option>
<option value="1st">1st</option>
<option value="2nd">2nd</option>
</select>
</div>
<script>
	function get_subject(val)
	{
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/teacher/subject.php',
			type: 'GET',
			data: {class: val},
		})
		.done(function(data) {
			$("#subject").html(data);
		})
		.fail(function() {
			$("#subject").html('<option value="">--Select--</option> <option value="বাংলা প্রথম পত্র">বাংলা প্রথম পত্র</option> <option value="বাংলা দ্বিতীয় পত্র">বাংলা দ্বিতীয় পত্র</option> <option value="ইংরেজি প্রথম পত্র">ইংরেজি প্রথম পত্র</option> <option value="ইংরেজি দ্বিতীয় পত্র">ইংরেজি দ্বিতীয় পত্র</option> <option value="গনিত">গনিত</option> <option value="সাধারণ বিজ্ঞান">সাধারণ বিজ্ঞান</option> <option value="কৃষিশিক্ষা">কৃষিশিক্ষা</option> <option value="বাংলাদেশ ও বিশ্ব পরিচয়">বাংলাদেশ ও বিশ্ব পরিচয়</option> <option value="তথ্য ও যোগাযোগ প্রযুক্তি">তথ্য ও যোগাযোগ প্রযুক্তি</option> <option value="ইসলাম ও নৈতিক শিক্ষা">ইসলাম ও নৈতিক শিক্ষা</option> <option value="হিন্দু ধর্ম ও নৈতিক শিক্ষা">হিন্দু ধর্ম ও নৈতিক শিক্ষা</option> <option value="খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা">খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা</option> <option value="বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা">বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা</option> <option value="চারু ও কারু কলা">চারু ও কারু কলা</option> <option value="কর্ম ও জীবনমুখী শিক্ষা">কর্ম ও জীবনমুখী শিক্ষা</option> <option value="শারীরিক শিক্ষা">শারীরিক শিক্ষা</option>'); }); } </script>
<div class="incoder">
	<label for="youtube_link">Youtube Video Link (optional)</label>
	<input name="youtube_link" placeholder="eg: http://youtube.com/watch?=efo264t0c4" class="input" id="youtube_link" type="text">
</div>

<div id="editor">
<label for="edit">Tutorial Contents</label>
    <div id='edit' style="margin-top: 30px;"></div>
</div>
<div class="incoder"><br><br>
  <label for="upload_main">Full Content Upload</label>
  <input type="file" name="file" class="input" id="upload_main">
</div>
<div class="incoder"><br><br>
	<label for="hero-demo">Tags</label>
	<textarea id="hero-demo" style="padding: 10px" name="hero-demo">My tags, Group Tags</textarea>
</div>
<div class="incoder"><br>
	<label for="ts25">Is the tutorial free or Paid? If paid, you will earn 80% of every sell.</label>
	<select name="ts25" id="ts25" onchange="change_incoder(this.value);" class="input">
		<option value="paid">paid</option>
		<option value="free">free</option>
	</select>
</div>
<script>
function change_incoder(val)
{
if (val=='free') {
	$(".price_range").hide("slow");
} else {
	$(".price_range").show("slow");
}
}
</script>
<div class="incoder price_range"><br>
	<label for="price">Make a right price for a good sell.</label>
	<input type="number" name="price" id="price" class="input">
</div>
<div class="incoder price_range"><br>
  <label for="vprice">Price with video</label>
  <input type="number" name="vprice" id="vprice" class="input">
</div>
<div class="overflow">
<input id="cd_button" type="submit" class="button right" style="margin: 10px" value="Create POST">
</div>

</form>


<script src="<?php get_domain("/js/") ?>jquery-1.11.1.min.js"></script>
<script src="<?php get_domain("/js/") ?>jquery-ui.min.js"></script>

<script src="<?php get_domain("/ajax/teacher/")?>jquery.caret.min.js"></script>
<script src="<?php get_domain("/ajax/teacher/")?>jquery.tag-editor.js"></script>
<script>
        // jQuery UI autocomplete extension - suggest labels may contain HTML tags
        // github.com/scottgonzalez/jquery-ui-extensions/blob/master/src/autocomplete/jquery.ui.autocomplete.html.js
        (function($){var proto=$.ui.autocomplete.prototype,initSource=proto._initSource;function filter(array,term){var matcher=new RegExp($.ui.autocomplete.escapeRegex(term),"i");return $.grep(array,function(value){return matcher.test($("<div>").html(value.label||value.value||value).text());});}$.extend(proto,{_initSource:function(){if(this.options.html&&$.isArray(this.options.source)){this.source=function(request,response){response(filter(this.options.source,request.term));};}else{initSource.call(this);}},_renderItem:function(ul,item){return $("<li></li>").data("item.autocomplete",item).append($("<a></a>")[this.options.html?"html":"text"](item.label)).appendTo(ul);}});})(jQuery);

        var cache = {};
        function googleSuggest(request, response) {
            var term = request.term;
            if (term in cache) { response(cache[term]); return; }
            $.ajax({
                url: 'https://query.yahooapis.com/v1/public/yql',
                dataType: 'JSONP',
                data: { format: 'json', q: 'select * from xml where url="http://google.com/complete/search?output=toolbar&q='+term+'"' },
                success: function(data) {
                    var suggestions = [];
                    try { var results = data.query.results.toplevel.CompleteSuggestion; } catch(e) { var results = []; }
                    $.each(results, function() {
                        try {
                            var s = this.suggestion.data.toLowerCase();
                            suggestions.push({label: s.replace(term, '<b>'+term+'</b>'), value: s});
                        } catch(e){}
                    });
                    cache[term] = suggestions;
                    response(suggestions);
                }
            });
        }

        $(function() {
            $('#hero-demo').tagEditor({
                placeholder: 'Enter tags ...',
                autocomplete: { source: googleSuggest, minLength: 3, delay: 250, html: true, position: { collision: 'flip' } }
            });
        });
    </script>
    <link rel="stylesheet" href="<?php get_domain("/js/")?>pure-min.css">

    <link rel="stylesheet" href="<?php get_domain("/ajax/teacher/")?>jquery.tag-editor.css">


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
			url: '<?php get_domain("/") ?>ajax/teacher/post_tutorial.php',
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
      if (data=='Failed to save the Tutorial') {
        alert(data);
      } else {
       $(".menu_item_home").click();
      }
		})
		.fail(function() {
			alert("Network Error");
		});
		
	});
});
</script>
