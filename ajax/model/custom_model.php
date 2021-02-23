<div class="question_algo" style="font-family: tahoma; background: white; border: 1px solid #20b99d; max-width: 1000px; margin: 1% auto; padding: 1%;">
<?php 
session_start();
include '../extra/db.extra.php';
$my_class = user_detail("class");
if ($my_class=="Nothing") {
	echo "Please Login and Try again.";
	exit();
}
?>
<script>
	$(document).ready(function() {
		get_subject("subject","<?php echo $my_class ?>");
		get_chapter("chapter","<?php echo $my_class ?>","বাংলা প্রথম পত্র");
	});
</script>
<script src="<?php get_domain("/practise/magic/") ?>magicsuggest.js"></script>
<link rel="stylesheet" href="<?php get_domain("/practise/magic/") ?>magicsuggest-min.css">
<script type="text/javascript">
      $(function() {

        var ms1 = $('#topic').magicSuggest({
          data: '<?php get_domain("/") ?>ajax/model/search_topic.php',
          maxSelection: 5,
  dataUrlParams: { id: 34 }
        });

      });
</script>
<style>
	.ms-sel-ctn input {
		font-size: 20px;
	}
	.ms-sel-item {
    font-size: 17px !important;
    padding: 4px !important;
    color: #111 !important;
}
.ms-res-item {
    font-size: 20px;
}
.ms-res-ctn {
    width: 100%;
    margin-left: -12px;
}
.ms-helper {
	color: red;
}
</style>
<div class="more_question">
<form action="" id="thia_att">

		<div class="part">
		<label for="subject">Select Subject</label>
		<select name="subject" id="subject" required class="input" onchange="get_chapter('chapter','<?php echo $my_class ?>',this.value);"></select>
		</div>
		<div class="part">
		<label for="chapter" style="vertical-align: top">Select chapter <span style="color: orangered; font-size: 11px;">* You can select multiple chapters</span></label>
		<div class="onion"></div>
		<select name="chapter" onchange="gert_onen('chapter')" multiple required id="chapter" class="input">
			<option value="">--Select The subject first--</option>
		</select>
		</div>
		<div class="part">
		<label for="topic" style="vertical-align: top">Topic <span style="color: orangered; font-size: 11px;">* If you don't have any topic, leave it empty</span></label><br>
		<input type="text" name="topic" id="topic" style="border: 1px solid #ccc;" autocomplete="off" class="input">

		</div>
		<div class="part">
		<label for="limit">Limit</label>
		<select name="limit" required id="limit" class="input">
			<option value="5">5</option>
			<option value="10">10</option>
			<option value="15">15</option>
			<option value="20">20</option>
			<option value="25">25</option>
			<option value="30">30</option>
		</select>

		</div>
		<div class="apply_question" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 1000px; text-align: center;">
	<input class="button ad_button adfawedfg0sd" style="display: block; width: 89%" type="submit" name="submit" value="Start Exam"></a>
</div>
		<div class="part">
		</div>
	</form>
</div>
	
</div>
<style>
.close_div {
    float: right;
    color: white;
    display: block;
    background: red;
    padding: 2px 20px;
    margin: -11px;
    font-family: arial;
    cursor: pointer;
    text-decoration: none;
    font-size: 32px;
}
.onion div {
    border: 1px solid #ccc;
    background: #ececeb;
    color: black;
    border-radius: 10px;
    display: inline-block;
    padding: 4px;
    margin: 1px;
}
.onion div span.close {
    color: #ff3434;
    font: 18px arial;
    padding: 10px;
    vertical-align: top;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    transition: .4s;
}
</style>
<script>
function gert_onen(chapter)
{
var dt = "";
		$("#chapter :selected").map(function(i, el) {
    dt+=' <div>'+$(el).val()+'<span class="close" onclick="donesg(\''+$(el).val()+'\')">x</span></div>';
}).get();
		$(".onion").html("You've selected: "+ dt);
}
</script>
<script>
	function donesg(v){
		// $("#chapter").attr('selectedIndex', '-1').find("option:selected").removeAttr("selected");
		$("#chapter").find("option[value='"+v+"']").removeAttr("selected");
		gert_onen('chapter');
	};
</script>
<div class="sonot"></div>
<script>

$(document).ready(function() {
	$("#thia_att").submit(function(event) {
		event.preventDefault();
$("#loader").show(0);
$("#loader .text").html("Preparing your Exam");


var ms1 = $('#topic').magicSuggest({
          data: '<?php get_domain("/") ?>ajax/model/search_topic.php',
          maxSelection: 5,
  dataUrlParams: { id: 34 }
        });
var arr = JSON.stringify(ms1.getValue());




		var val = $(this).serialize();
		var dt = "";
		$("#chapter :selected").map(function(i, el) {
    dt+='```'+$(el).val();
}).get();
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/model/custom_model_question.php',
			type: 'GET',
			data: val+"&&short="+arr+"&&mul="+dt,
		})
		.done(function(data) {
			setTimeout(function(){
			$("#loader").fadeOut(400);
			},2000);
			$(".more_question").html(data);
		});
		
	});
});

function get_topic(v)
{
if ($.trim(v)!='') {
$.ajax({
	url: '<?php get_domain("/") ?>ajax/model/search_topic.php',
	type: 'POST',
	data: "v="+v,
})
.done(function(data) {
	$(".top_v").html(data);
});

} else {
$(".top_v").html('');
}
}
</script>