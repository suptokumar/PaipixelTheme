<?php 
if (isset($_GET['handshake'])) {
include '../ajax/db_back.php';
include '../functions.php';
			session_start();
} else {
	include 'ajax/db_back.php';
}
?>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<link rel="stylesheet" href="<?php get_domain("/css/table.css?v=1.0.0") ?>">
<div class="container" style="width: 96%; max-width: 1000px; margin: 10px auto">
<div class="body_content content_area">
<style>
.group .icon {
	font-size: 16px;
	padding: 10px
}
.group div {
	padding: 2%;
	border: 1px solid #eee;
	font-family: tahoma;
	display: none;
}
.group:hover {
	box-shadow: 0px 0px 4px 2px #ccc;
}
.group div ul{
	padding: 5%;
}
.group h3 {
	cursor: pointer;
	margin-top: 10px;
}
.group h3:hover {
	background: #9CFF00;
}
</style>
<script>
$(document).ready(function() {
	$(".group h3").click(function(event) {
		var id = $(this).attr('id');
		$("."+id).slideToggle("slow");
		$(this).find('.icon').html("check");
	});
});
</script>
<script>
function expand()
{
if ($("#dfadf1201").text()=='Expand All') {
	$(".group").find('div').slideDown("slow");
	$("#dfadf1201").text("Hide All");
} else {
	$(".group").find('div').slideUp("slow");
	$("#dfadf1201").text("Expand All");
}
}
</script>
<h2>General <a href="javascript:void(0)" id="dfadf1201" onclick="expand();" style="float: right; font-size: 16px">Expand All</a></h2><br>
<div id="accordion">
  <div class="group">
    <h3 id="a1" style="border: 1px solid #ccc;padding: 1%;"><span class="icon material-icons">play_arrow</span>PaiPixel কি?</h3>
    <div class="a1">
      <p>PaiPixel হলো বাংলাদেশের সর্ববৃহৎ Student-Teacher Interactive Educational Platform যেটি বেশি বেশি প্রতিযোগিতামূলক পরীক্ষার মাধ্যমে শিক্ষার্থীদের নিজ নিজ বিষয়ে দক্ষ করে তোলে। 
PaiPixel এর Features সমূহ হলোঃ</p>
<ul>
  <li>Individual Live Exam</li>
  <li>Team Exam</li>
  <li>Monthly Student&rsquo;s Report</li>
  <li>Course (Coming soon)</li>
  <li>Online Live Class (Coming soon)</li>
  <li>Exam of Model Questions.</li>
  <li>Participating in exams prepared by your own customized questions.</li>
  <li>Explanation of Questions (Written, Audio, and Video).</li>
  <li>Question and Answer Service.</li>
  <li>Teacher Hiring</li>
</ul>

    </div>
  </div>
  <div class="group">
    <h3 id="a2" style="border: 1px solid #ccc;padding: 1%;"><span class="icon material-icons">play_arrow</span>Rating কি?</h3>
    <div class="a2">
      <p>Rating হলো শিক্ষার্থীদের Skill Evaluation Scale. Rating এর মাধ্যমে PaiPixel Platform এ একজন শিক্ষার্থীর দক্ষতা মূল্যায়ন করা হয়। যার Rating যত বেশি সে তত বেশি দক্ষ বা Skilled.</p>
    </div>
  </div>
  <div class="group">
    <h3  id="a3" style="border: 1px solid #ccc;padding: 1%;"><span class="icon material-icons">play_arrow</span>Rating কিভাবে বাড়ে বা কমে?</h3>
    <div class="a3">
      <p>Rating হলো শিক্ষার্থীদের Skill Evaluation Scale যা কিনা একটি সূনিপুন Computer Algorithm এর মাধ্যমে নির্ধারণ করা হয়। প্রতিটি Individual Exam এর পরে একজন শিক্ষার্থীর Score এবং Previous Rating এর উপর নির্ভর করে বর্তমান Rating বাড়ে বা কমে।</p>
    </div>
  </div>
  <div class="group">
    <h3  id="a4" style="border: 1px solid #ccc;padding: 1%;"><span class="icon material-icons">play_arrow</span>Team Exam কি?</h3>
    <div class="a4">
      <p>Team Exam হলো Team vs Team পরীক্ষা। কতোগুলো শিক্ষার্থী মিলে একটা Team গঠন করতে পারবে। প্রতিটা Team এর Leader কিংবা Co-leader একটা Team Exam Arrange করতে পারবে, বা অন্য কোন Team এর Challenge Accept করতে পারবে। </p>
    </div>
  </div>
  <div class="group">
    <h3  id="a5" style="border: 1px solid #ccc;padding: 1%;"><span class="icon material-icons">play_arrow</span>Score Leaderboard কি?</h3>
    <div class="a5">
      <p>একজন শিক্ষার্থীর PaiPixel Platform এ Account খোলার পর থেকে এখন পর্যন্ত যতগুলো পরীক্ষা দিয়েছে সবগুলো পরীক্ষার Score এর যোগফল।  
</p>
    </div>
  </div>
</div>
 
</div>