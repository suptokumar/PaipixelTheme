
<?php 

if (isset($_GET['pre_exams'])) {
?>	



<?php include 'header.php'; ?>
<?php get_header("Previous Exam | PaiPixel Online Exam") ?>
<?php get_top_menu("") ?>


<script>
	$(document).ready(function() {
		$(".top_menu_section.menu_section a").click(function(event) {
			window.location=$(this).attr("href");
		});
	});
</script>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/nav_menu.css?d">
<script>
	$(document).ready(function() {
		$(".open_nav").click(function() {
			$(".nav_responsive").fadeIn(100);
			$(".nav_responsive_fix").fadeIn(100);
		});
		$(".nav_responsive_fix").click(function() {
			$(".nav_responsive").fadeOut(100);
			$(".nav_responsive_fix").fadeOut(100);
		});
		$(".close_nav").click(function() {
			$(".nav_responsive").fadeOut(100);
			$(".nav_responsive_fix").fadeOut(100);
		});

		$(window).resize(function() {
			if ($(window).innerWidth() > 716 && $(".nav_responsive").css("display","none")) {
				$(".nav_responsive").css("display","inline-block");
			} else {
				$(".nav_responsive").css("display","none");
			}
		});
	});
</script>
<script>
	$(document).ready(function() {
		$(window).scroll(function() {
			var height = $(window).scrollTop();
			if(height>306){
				$(".nav_menu").addClass('fixed_menu');
				$(".container").css('margin-top', '50px');
			} else {
				$(".nav_menu").removeClass('fixed_menu');
				$(".container").css('margin-top', '0px');
			}
		});

		$(".nav_menu .cf a.<?php echo $active ?>").addClass('active');
	});
</script>

<div class="nav_menu">
	
<nav class="cf">
		<a href="<?php get_domain("/") ?>" class="menu_item_home">Home</a>
		<?php 
if (user_detail("power")==1 || user_detail("role")==2) {
	?>
<a href="<?php get_domain("/") ?>exam.php?add_question" class="menu_item_results">Add Questions</a>
	<?php
}

	?>
	<a href="javascript:void(0)" class="open_nav nav_button"><span class="material-icons">menu</span></a>
<div class="nav_responsive_fix"></div>
		
		<div class="nav_responsive">
			<a href="javascript:void(0)" class="close_nav nav_button"><span class="material-icons">close</span></a>
			<!-- <a href="<?php get_domain("/") ?>tutorial" class="menu_item_tutorial">Tutorial</a> -->
			<a href="<?php get_domain("/") ?>exams" class="menu_item_exams active">Individual Exam</a>
			<a href="<?php get_domain("/") ?>team_exam" class="menu_item_team_exam">Team Exam</a>
			<!-- <a href="<?php get_domain("/exam.php") ?>" class="menu_item_exam_list active">Exam List</a> -->
			<a href="<?php get_domain("/") ?>ratings" class="menu_item_rating">Rating</a>
			<a href="<?php get_domain("/") ?>score.php" class="menu_item_score">Score Leaderboard</a>
			<a href="<?php get_domain("/") ?>week.php" class="menu_item_weakly">Weekly Top Scorers</a>
<?php if (user_detail("role")==1) {
?>
<a href="<?php get_domain("/") ?>model.php" class="menu_item_model">Start Exam Now</a>

<?php
} ?>
			<a href="<?php get_domain("/") ?>buy.php" class="menu_item_buy">Buy Exam</a>
			<a href="<?php get_domain("/") ?>ask_teacher" class="menu_item_ask_teacher"><?php echo x("Ask") ?> Question</a>
			<!-- <a href="<?php get_domain("/") ?>hire_teacher" class="menu_item_hire_teacher">Hire Teacher</a> -->
			<a href="<?php get_domain("/") ?>FAQ" class="menu_item_faq">FAQ</a>
		</div>

		</div>
		
	</nav>
</div>
<div class="pup_up" style="display: none;"></div>
<div class="ajax_data" style="display: none;"></div>
<div class="area_content" style="margin: 10px auto; background: white; width: 95%; box-shadow: 0px 0px 4px 2px #ccc; padding: 2%; ">
	<link rel="stylesheet" href="<?php get_domain("/") ?>css/table.css?s5">
	<?php if (isset($_GET['exam_id'])) {
		$exam=$_GET['exam_id'];
		?>
		<script>
	$(document).ready(function() {
		setInterval(function(){
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/exam/live_result.php',
			type: 'POST',
			data: {exam: '<?php echo $_GET['exam_id']; ?>'},
		})
		.done(function(data) {
			$(".exam_list").html(data);
		});
		},2000);
			});
		</script>
<div class="button_group">
	<a href="<?php get_domain("/") ?>exam.php?exam_details=<?php echo $exam ?>" class="transtrification_button" title="Exam Details">Exam Details</a>
	<a href="<?php get_domain("/") ?>exam.php?exam_questions=<?php echo $exam ?>" class="transtrification_button" title="Questions">Questions</a>
	<a href="<?php get_domain("/") ?>exam.php?pre_exams&exam_id=<?php echo $exam ?>" class="transtrification_button active" title="Score Board">Score Board</a>
	<a href="<?php get_domain("/") ?>exam.php?exam_ratings=<?php echo $exam ?>" class="transtrification_button" title="Ratings">Ratings</a>
</div>
	<div class="exam_list"> <h2 style="text-align: center;">Loading...</h2></div>
	<?php
	} else {
		?>


<?php 

$sql = "SELECT * FROM question WHERE exam_starting_date < CURRENT_TIME AND pending=1 GROUP BY exam_id ORDER BY id DESC LIMIT 20";
$q = mysqli_query($db,$sql);
?>


<div class="asot55">
<h2 class="heading_title">Past exams</h2><br>
<table class="data_table func_table table_hoverable">
<tr>
	<th>Exam Name</th>
	<th class="to_min500">Question Setter</th>
	<th>Class</th>
	<th class="to_min500">Number of Questions</th>
	<th>Duration</th>
	<th>Result Time</th>
	<th>View Result</th>
</tr>
<?php
while ($row = mysqli_fetch_array($q)) {
	?>
<tr style="font-family: cursive;">
	<td><a href="javascript:void(0)" onclick="exam_details('<?php echo $row['exam_id']; ?>')"><?php echo $row['Exam_name'] ?></a></td>
	<td class="to_min500"><?php echo $row['setter'] ?></td>
	<td><?php echo $row['class'] ?></td>
	<td class="to_min500"><?php 
$ex = $row['exam_id'];
	$e = "SELECT * FROM question WHERE exam_id = '$ex' AND pending=1";
	$s = mysqli_query($db,$e);	date_default_timezone_set("Asia/Dhaka");

	echo mysqli_num_rows($s); ?></td>
<?php 
$user05 = user_detail("user_name"); 
$rs = "SELECT * FROM `exam_reg` WHERE exam = '$ex' AND user='$user05'";
$d = mysqli_query($db,$rs);
$nu = mysqli_num_rows($d);
	?>
	<td><?php echo $row['exam_duration'] ?> Min</td>
	<td><?php echo date("d M Y, h:i a", (strtotime($row['exam_starting_date'])+($row['exam_duration']*60))); ?></td>
	

	<td style="padding: 10px">
<div id="e<?php echo $ex ?>">

		<button href="javascript:void(0)" onclick="view_result('<?php echo $ex ?>',this);" class="button button_standard more_button">View Result</button>
</div>

	</td>
	
</tr>

	<?php
}
if (mysqli_num_rows($q)==0) {
	?>
<tr>
	<td colspan="7" style="text-align: center;">No exams found</td>
</tr>
	<?php
}
?>
</table>
</div>
<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/ajax/exam/passed_exam.php") ?>',
		type: 'POST',
		data: 'date=<?php echo $row['exam_starting_date']; ?>'+'&exam=<?php echo $row['exam_id']; ?>'
	})
	.done(function(data) {
		$(".asot55").html(data);
	});
	
},1000);
</script>
		<?php
	} ?>

<?php get_footer(); ?>



















<?php
} else if (isset($_GET['add_question'])) {
?>	



<?php include 'header.php'; ?>
<?php get_header("Add Questions | PaiPixel Online Exam") ?>
<?php
if (!isset($_SESSION['login_data_paipixel24'])) {
	?>
<script>
function apply_changes()
{
	window.location= 'exam.php';
}
</script>
	<?php
	exit();
}

$user = $_SESSION['login_data_paipixel24'];
$sql = "SELECT * FROM user WHERE user_name='$user'";


 ?>
<?php get_top_menu("") ?>


<script>
	$(document).ready(function() {
		$(".top_menu_section.menu_section a").click(function(event) {
			window.location=$(this).attr("href");
		});
	});
</script>
<link rel="stylesheet" type="text/css" href="<?php get_domain("/"); ?>css/jquery.datetimepicker.css"/>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/nav_menu.css?d">
<script>
	$(document).ready(function() {
		$(".open_nav").click(function() {
			$(".nav_responsive").fadeIn(100);
			$(".nav_responsive_fix").fadeIn(100);
		});
		$(".nav_responsive_fix").click(function() {
			$(".nav_responsive").fadeOut(100);
			$(".nav_responsive_fix").fadeOut(100);
		});
		$(".close_nav").click(function() {
			$(".nav_responsive").fadeOut(100);
			$(".nav_responsive_fix").fadeOut(100);
		});

		$(window).resize(function() {
			if ($(window).innerWidth() > 716 && $(".nav_responsive").css("display","none")) {
				$(".nav_responsive").css("display","inline-block");
			} else {
				$(".nav_responsive").css("display","none");
			}
		});
	});
</script>
<script>
	$(document).ready(function() {
		$(window).scroll(function() {
			var height = $(window).scrollTop();
			if(height>306){
				$(".nav_menu").addClass('fixed_menu');
				$(".container").css('margin-top', '50px');
			} else {
				$(".nav_menu").removeClass('fixed_menu');
				$(".container").css('margin-top', '0px');
			}
		});

		$(".nav_menu .cf a.<?php echo $active ?>").addClass('active');
	});
</script>

<div class="nav_menu">
	
<nav class="cf">
		<a href="<?php get_domain("/") ?>" class="menu_item_home">Home</a>
		<?php 
if (user_detail("power")==1 || user_detail("role")==2) {
	?>
<a href="<?php get_domain("/") ?>exam.php?add_question" class="menu_item_results active">Add Questions</a>
	<?php
}
	?>
	<a href="javascript:void(0)" class="open_nav nav_button"><span class="material-icons">menu</span></a>
<div class="nav_responsive_fix"></div>
		
		<div class="nav_responsive">
			<a href="javascript:void(0)" class="close_nav nav_button"><span class="material-icons">close</span></a>
			<!-- <a href="<?php get_domain("/") ?>tutorial" class="menu_item_tutorial">Tutorial</a> -->
			<a href="<?php get_domain("/") ?>exams" class="menu_item_exams">Individual Exam</a>
			<a href="<?php get_domain("/") ?>team_exam" class="menu_item_team_exam">Team Exam</a>
			<!-- <a href="<?php get_domain("/exam.php") ?>" class="menu_item_exam_list">Exam List</a> -->
			<a href="<?php get_domain("/") ?>ratings" class="menu_item_rating">Rating</a>
			<a href="<?php get_domain("/") ?>score.php" class="menu_item_score">Score Leaderboard</a>
			<a href="<?php get_domain("/") ?>week.php" class="menu_item_weakly">Weekly Top Scorers</a>
<?php if (user_detail("role")==1) {
?>
<a href="<?php get_domain("/") ?>model.php" class="menu_item_model">Start Exam Now</a>

<?php
} ?>
			<a href="<?php get_domain("/") ?>buy.php" class="menu_item_buy">Buy Exam</a>
			<a href="<?php get_domain("/") ?>ask_teacher" class="menu_item_ask_teacher"><?php echo x("Ask") ?> Question</a>
			<!-- <a href="<?php get_domain("/") ?>hire_teacher" class="menu_item_hire_teacher">Hire Teacher</a> -->
			<a href="<?php get_domain("/") ?>FAQ" class="menu_item_faq">FAQ</a>
		</div>

		</div>
		
	</nav>
</div>
<style>


	.mid_in {
		padding: 4px
	}
	.question_set {
		border-bottom: 1px dashed #ccc;
		padding: 2%;
	}
@media(max-width: 500px)
{
	form {
	 width: 98% !important;
	}
	.tt {
		display: block !important;
	}
}

</style>
<div class="pup_up" style="display: none;"></div>
<div class="ajax_data" style="display: none;"></div>
<?php 
if (isset($_GET['equality'])) {
	$ex = $_GET['equality'];
	?>

<div class="main_corner">
<link rel="stylesheet" href="<?php get_domain("/css/table.css?s5") ?>">
<div class="area_content" style="margin: 10px auto; background: white; width: 95%; box-shadow: 0px 0px 4px 2px #ccc; padding: 2%; ">



<script>
function pressit(event, main)
{
event.preventDefault();
var data = $("#orm_ftf").serialize();
$.ajax({
	url: '<?php get_domain("/ajax/team_exam/team_support_eno.php") ?>',
	type: 'POST',
	data: data,
	beforeSend:function()
	{
		$("#cd_button").val("Please Wait...");
	}
})
.done(function(data) {
	alert(data);
	window.location='exam.php?add_question&equality=<?php echo $ex; ?>';
});

}
</script>
<?php 
function get_option_maker($a,$b)
{
if ($a==$b) {
	echo "selected";
}
}

?>
<?php 
$user = user_detail("user_name");
$sql = "SELECT * FROM `team_chal_qtn` WHERE ids='$ex' AND user='$user'";
$m = mysqli_query($db,$sql);
$d = mysqli_num_rows($m);
$v = (5-($d));

?>
<script>
function edit_02d4(a)
{
$("#aat"+a).slideToggle("slow");
}
</script>
<script>
function remake(event,t)
{
event.preventDefault();
var data = $("#aat"+t).serialize();
$.ajax({
	url: '<?php get_domain("/ajax/team_exam/edit_qt_05.php") ?>',
	type: 'POST',
	data: data,
})
.done(function(data) {
	alert(data);
	window.location='exam.php?add_question&equality=<?php echo $ex; ?>';
});

}
</script>
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
<style>
@media (max-width: 500px) {
	.fr-btn-grp.fr-float-right {
		display: none !important;
	}
}
</style>

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

<div class="ast24" style="width: 60%; padding: 2%; border: 1px solid #ccc; margin: 0 auto;">
	<?php 
	$i=1;
	while ($row=mysqli_fetch_array($m)) {
	 	?>
<div class="question"><h2><?php echo $i.". ". $row['question'] ?> <a href="javascript:void(0)" onclick="edit_02d4('<?php echo $row['id'] ?>')">Edit</a></h2></div>
<form  class="a4f" id="aat<?php echo $row['id'] ?>" onsubmit="remake(event,'<?php echo $row['id'] ?>')" style="background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).'12' ?>; padding: 1%; display: none;">
		<table>
			<tr>
				<td>
					<h2>Question</h2>
				</td>
				<td>
					 <textarea  style="display:none" name="q" id="q<?php echo $i+1 ?>" placeholder="option 1" class="mid_in"><?php echo $row['question'] ?></textarea>
		<div id="question<?php echo $i+1 ?>" style="max-width: 450px"><?php echo $row['question'] ?></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 1.</h2>
				</td>
				<td>
					 <textarea  style="display:none" name="opt1" id="opt<?php echo $i+1 ?>1" placeholder="option 1" class="mid_in"><?php echo $row['ans1'] ?></textarea>
		<div id="at<?php echo $i+1 ?>1" style="max-width: 450px"><?php echo $row['ans1'] ?></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 2.</h2>
				</td>
				<td>
					<textarea  style="display:none" name="opt2" id="opt<?php echo $i+1 ?>2" placeholder="option 2" class="mid_in"><?php echo $row['ans2'] ?></textarea>
		<div id="at<?php echo $i+1 ?>2" style="max-width: 450px"><?php echo $row['ans2'] ?></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 3.</h2>
				</td>
				<td>
					 <textarea  style="display:none" name="opt3" id="opt<?php echo $i+1 ?>3" placeholder="option 3" class="mid_in"><?php echo $row['ans3'] ?></textarea>
		<div id="at<?php echo $i+1 ?>3" style="max-width: 450px"><?php echo $row['ans3'] ?></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 4.</h2>
				</td>
				<td>
					<textarea type="text" style="display:none"  name="opt4" id="opt<?php echo $i+1 ?>4" placeholder="option 4" class="mid_in"><?php echo $row['ans4'] ?></textarea>
		<div id="at<?php echo $i+1 ?>4" style="max-width: 450px"><?php echo $row['ans4'] ?></div>
				</td>
			</tr>
		</table>

			<br>
		<table>
		<tr>
			<td>Currect </td>
			<td>
		<select  name="currect" id="" class="mid_in">
			<option value="1" <?php get_option_maker(1,$row['ct']); ?>>option 1</option>
			<option value="2" <?php get_option_maker(2,$row['ct']); ?>>option 2</option>
			<option value="3" <?php get_option_maker(3,$row['ct']); ?>>option 3</option>
			<option value="4" <?php get_option_maker(4,$row['ct']); ?>>option 4</option>
		</select>
	</td>
		</tr>

		</table>
		<input type="hidden" value="<?php echo $row['id'] ?>" name="id">
		<input type="submit" value="Edit" name="submit" class="button">
</form>
<style>
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
      .fr-fic {
	max-width: 100% !important;
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
            document.getElementById('q<?php echo $i+1 ?>').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('q<?php echo $i+1 ?>').innerHTML = editor.html.get()
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
	 	<?php
	 $i++;} ?>
</div>
<?php 
if ($v==0) {
	exit();
}
 ?>
<form id="orm_ftf" onsubmit="pressit(event,this)" style="width: 60%; padding: 2%; border: 1px solid #ccc; margin: 0 auto;">
<h2>Add Questions For Team challenge: <b><?php echo $ex ?></b></h2>
<input type="hidden" value="<?php echo $ex; ?>" name="asdf0">
<input type="hidden" value="<?php echo $v; ?>" name="count">
	<script>
		function get_q_box(v)
		{
			$.ajax({
				url: '<?php get_domain("/") ?>ajax/exam/cnt.php',
				type: 'GET',
				data: {r: v},
			})
			.done(function(data) {
			$(".q_boxq").html(data);
			});
			
		}
	</script>
		<?php 
$team = user_detail("team");
$member = user_detail("id");
$st = "SELECT * FROM team_chal WHERE id='$ex'  ORDER BY id DESC";
$m = mysqli_query($db,$st);
$sod = 0;
while($w = mysqli_fetch_array($m)){
 $us = substr($w['member'],1); $us = explode(",", $us); for ($i=0; $i < count($us); $i++) {
if($us[$i]==$member){
	
	?>
<script>
$(document).ready(function() {
	get_q_box(<?php echo $v ?>);
});
</script>
	<?php
	$sod+=1;
}

 }
}
if ($sod==0) {
	echo "You are not permited for this page.";
}
		?>
		
<div class="q_boxq">

</div>




</form>

















</div>
</div>
	<?php
	exit();
}
?>























<!-- Add question Theme -->







<div class="main_corner">
<link rel="stylesheet" href="<?php get_domain("/css/table.css?s5") ?>">
<div class="area_content" style="margin: 10px auto; background: white; width: 95%; box-shadow: 0px 0px 4px 2px #ccc; padding: 2%; ">


<?php 
if (isset($_GET['ref'])) {
	$id = $_GET['ref'];
	$sql="SELECT * FROM `question_condi` WHERE id='$id'";
	$m = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($m);
	$class= $row['class'];
	$subject= $row['subject'];
	$chapter= $row['chapter'];
	$max= $row['max'];
	$total= $row['total'];
	$type = $row['type'];
	if ($row['assign']!='' && $row['assign']!=user_detail("user_name")) {
		?>
<h2>Sorry !</h2> We assigned a teacher for this live question. Please go to <a href="<?php get_domain("/exam.php?add_question") ?>">Add Question</a> and select a new offer.

		<?php
		exit();
	}
	if (mysqli_num_rows($m)==0 OR ($max-$total)<1) {
		?>
<h2>Sorry !</h2>This page  is not available now. Please go to <a href="<?php get_domain("/exam.php?add_question") ?>">Add Question</a> and select a new offer.
		<?php
		exit();
	}
	?>
	<?php 
	$sql = "SELECT * FROM `proposal` WHERE user='".user_detail("user_name")."' AND ref='".$id."'";
	$mw = mysqli_query($db,$sql);
$r0 = mysqli_num_rows($mw);
$r5 = mysqli_fetch_array($mw);
if ($r0!=0 && $r5["accept"]!=1) {
?>
<div style="text-align: center;">
	
<h2>Welcome Back !</h2> You have already submited a proposal.
</div>
<?php 
exit();
}
	 ?>
<script>

$(document).ready(function (e) {
    $('#orm_ftf').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: '<?php get_domain("/ajax/exam/update_q.php") ?>',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function()
	{
		$("#cd_button").html("Uploading...");
	},
            success:function(data){
               $(".de5").html(data);
               $("#id01").css("display","block");
	// $(".fr-element.fr-view").html("");
            },
            error: function(data){
                $("#sono").html("Failed to connect to the server.");
               $("#id01").css("display","block");
               
            }
        });
    }));
});
</script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <div id="id01" style="display: none;" class="w3-modal">
    <div class="w3-modal-content w3-animate-top de5 w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright w3-xlarge">&times;</span>
        <h2>Message</h2>
      </header>
      <div class="w3-container" id="sono">
        <p>Some text..</p>
        <p>Some text..</p>
      </div>
    </div>
  </div>
<form id="orm_ftf" onsubmit="asdf521s0af(event,this)" style="width: 60%; padding: 2%; border: 1px solid #ccc; margin: 0 auto;">
	<div class="border_box">
		<label for="class"><h3>Prepare Questions</h3>
			<select min="1" id="qu_type" class="input" disabled onchange="q_type(this.value)">
				<option value="1" <?php if($type==1){echo "selected";} ?>>For Question Bank</option>
				<option value="2" <?php if($type==2){echo "selected";} ?>>For Individual Exam</option>
			</select>
		</label>
		<input type="hidden" name="qu_type" value="<?php if($type==1){echo "1";} else {echo "2";} ?>">
		<input type="hidden" name="qno" value="<?php echo $id ?>">
	</div>
<script>
	function q_type(v)
	{
		if (v==0) {
			$(".indi_extra").slideDown(1000);
		} else {
			$(".indi_extra").slideUp(1000);
		}
	}
</script>

	<div class="indi_extra">
	<?php 

	if ($type==2 AND $row['assign']=='') {
	?>

	<div class="border_box">
<label for="duration"><h3>Your Proposal To PaiPixel</h3>
<textarea name="message" class="input" placeholder="Details of your proposal" id="message" cols="30" rows="10"></textarea>
</label>
	</div>
	<div class="border_box"></div>

	</div>

	<?php
} 

 ?>


	<div class="border_box">
		<label for="class"><h3>Class</h3>
			<select min="1" id="class" class="input" disabled onchange="get_subject('subject',this.value);get_chapter('chapter',this.value,'বাংলা প্রথম পত্র');">
				<option value="<?php echo $class ?>"><?php echo $class ?></option>
			</select>
			<input type="hidden" name="class" value="<?php echo $class ?>">
		</label>
	</div>

	<div class="border_box">
		<label for="subject"><h3>Subject</h3>
			<select class="input" disabled  id="subject" onchange="get_chapter('chapter',document.getElementById('class').value,this.value);">
				<option value="<?php echo $subject ?>"><?php echo $subject ?></option>
			</select>
			<input type="hidden" name="subject" value="<?php echo $subject ?>">
		</label>
	</div>
	<div class="border_box">
		<label for="chapter"><h3>Chapter</h3>
			<select class="input" disabled  id="chapter">
				<option value="<?php echo $chapter ?>"><?php echo $chapter ?></option>
				
			</select>
			<input type="hidden" name="chapter" value="<?php echo $chapter ?>">

		</label>
	</div>


<div class="border_box">
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
<style>
@media (max-width: 500px) {
	.fr-btn-grp.fr-float-right {
		display: none !important;
	}
}
</style>

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

<?php
$r = 1;
if ($type==2 AND $row['assign']=='') {
	$r=5;
} else if($row['assign']!='') {
	$sql = "SELECT * FROM question WHERE exam_id='".user_detail("id").$id."' AND pending=1";
	$w = mysqli_query($db,$sql);
	$g = mysqli_num_rows($w);
	echo "Total Added: ".  $g;

	if ($g==$max) {
		echo "<br>You've finished adding all questions for Individual Exam. Please wait for approval.";
		exit();
	}
}
for ($i=0; $i < $r; $i++) { 
	$a = rand(0,9);
	$b = rand(0,9);
	$c = rand(0,9);
	?>
	<div class="question_set" style="background:#<?php echo $a.$b.$c.$a.$b.$c.'15'; ?>">
<input type="hidden" name="ref" value="<?php echo $id; ?>">
<input type="hidden" name="numb" value="<?php echo $r; ?>">
		<h2>Question <?php echo $i+1 ?>:</h2>
		<span style="color: orangered; font-size: 13px">* if you can't make questions with the following tools & options, then please prepare questions in microsoft word or other editors, make a screenshot, crop the question and upload here.</span>
		<textarea  style="display:none" class="input" name="q<?php echo $i ?>" id="main_q<?php echo $i+1 ?>" placeholder="eg: in which date, we got independence?"></textarea>
		<div id="question<?php echo $i+1 ?>"></div>
		<table>
			<tr>
				<td>
					<h2>Option 1.</h2>
				</td>
				<td>
					 <textarea  style="display:none" name="opt<?php echo $i ?>1" id="opt<?php echo $i+1 ?>1" placeholder="option 1" class="mid_in"></textarea>
		<div id="at<?php echo $i+1 ?>1" style="max-width: 450px"></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 2.</h2>
				</td>
				<td>
					<textarea  style="display:none" name="opt<?php echo $i ?>2" id="opt<?php echo $i+1 ?>2" placeholder="option 2" class="mid_in"></textarea>
		<div id="at<?php echo $i+1 ?>2" style="max-width: 450px"></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 3.</h2>
				</td>
				<td>
					 <textarea  style="display:none" name="opt<?php echo $i ?>3" id="opt<?php echo $i+1 ?>3" placeholder="option 3" class="mid_in"></textarea>
		<div id="at<?php echo $i+1 ?>3" style="max-width: 450px"></div>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Option 4.</h2>
				</td>
				<td>
					<textarea type="text" style="display:none"  name="opt<?php echo $i ?>4" id="opt<?php echo $i+1 ?>4" placeholder="option 4" class="mid_in"></textarea>
		<div id="at<?php echo $i+1 ?>4" style="max-width: 450px"></div>
				</td>
			</tr>
		</table>

			<br>
		<table style="width: 100%;">
		<tr>
			<td>Currect </td>
			<td>
		<select  name="currect<?php echo $i ?>" id="" class="mid_in">
			<option value="1">option 1</option>
			<option value="2">option 2</option>
			<option value="3">option 3</option>
			<option value="4">option 4</option>
		</select>
	</td>
		</tr>
		<tr>
			<td>Lesson </td>
			<td><input type="text" name="topic<?php echo $i ?>" id="topic<?php echo $i+1 ?>" cols="30" rows="2" class="input" placeholder="শুধুমাত্র পাঠ/মূল-টপিকের নামটি লিখুন"></td>
		</tr>
		<tr style="display: none;">
			<td>Hints: </td>
			<td><textarea  name="tips<?php echo $i ?>" id="tips<?php echo $i+1 ?>" cols="30" rows="2" class="mid_in"></textarea></td>
		</tr>
		<tr>
			<td>Explain: </td>
			<td><textarea style="display: none"  name="explain<?php echo $i ?>" id="explain<?php echo $i+1 ?>" cols="30" rows="2" class="mid_in"></textarea><div id="edit<?php echo $i+1 ?>"></div>
      </td>
		</tr>
    <tr>
      <td>Audio Explaination: </td>
      <td>
<input type="file" name="audio<?php echo $i+1 ?>" id="audio">
      </td>
    </tr>
		</table>
		<style>
			@media(max-width:923px){

.input#topic1 {
    width: 80% !important;
}
}

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
        pastePlain: true,
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
<div class="part_question" style="font-family: tahoma; background: white; border: 1px solid #20b99d; padding: 1%; margin: 1% auto; max-width: 400px;text-align: left;">
	<h5 style="width: 100%; text-align: right;color: #20b99d; font-weight: lighter;">Question Preview</h5>
	<style>
		.fr-fic {
	max-width: 100% !important;
}
	</style>
	<div style="overflow: hidden;"><span style="float:left"><?php echo 1 ?>.</span> <h3 id="qs<?php echo $i+1 ?>">Which is the correct option?</h3></div>
	<div id="squestion1<?php echo ($i+1) ?>">
			<table>
				<tr>
					<td>A.</td>
					<td><label id="question1<?php echo ($i+1) ?>">Option 1</label></td>
				</tr>
			</table>
			
		</div>
		<div id="squestion2<?php echo ($i+1) ?>">

		<table>
			<tr>
				<td>B.</td>
				<td><label id="question2<?php echo ($i+1) ?>">Option 2</label></td>
			</tr>
		</table>
			
		</div>
		<div id="squestion3<?php echo ($i+1) ?>">
		<table>
			<tr>
				<td>C.</td>
				<td><label id="question3<?php echo ($i+1) ?>">Option 3</label></td>
			</tr>
		</table>

		</div>
		<div id="squestion4<?php echo ($i+1) ?>">
			<table>
			<tr>
				<td>D.</td>
				<td><label id="question4<?php echo ($i+1) ?>">Option 4</label></td>
			</tr>
		</table>
			
		</div>
 </div>
 <script>
   (function () {
      const editorInstance = new FroalaEditor('#question<?php echo $i+1 ?>', {
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
        'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR',<?php if (user_detail("user_name")=='TravellerAlim') {echo "'html'";} ?>]
      },
    },
        enter: FroalaEditor.ENTER_BR,
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('main_q<?php echo $i+1 ?>').innerHTML = editor.html.get()
            document.getElementById('qs<?php echo $i+1 ?>').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('qs<?php echo $i+1 ?>').innerHTML = editor.html.get()
            document.getElementById('main_q<?php echo $i+1 ?>').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>
  <script>
   (function () {
      const editorInstance = new FroalaEditor('#at<?php echo $i+1 ?>1', {
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
        enter: FroalaEditor.ENTER_BR,
        imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        pastePlain: true,
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('question1<?php echo $i+1 ?>').innerHTML = editor.html.get()
            document.getElementById('opt<?php echo $i+1 ?>1').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('question1<?php echo $i+1 ?>').innerHTML = editor.html.get()
            document.getElementById('opt<?php echo $i+1 ?>1').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>
  <script>
   (function () {
      const editorInstance = new FroalaEditor('#at<?php echo $i+1 ?>2', {
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
        enter: FroalaEditor.ENTER_BR,
        imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
        pastePlain: true,
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('question2<?php echo $i+1 ?>').innerHTML = editor.html.get()
            document.getElementById('opt<?php echo $i+1 ?>2').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('question2<?php echo $i+1 ?>').innerHTML = editor.html.get()
            document.getElementById('opt<?php echo $i+1 ?>2').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>  <script>
   (function () {
      const editorInstance = new FroalaEditor('#at<?php echo $i+1 ?>3', {
      	imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
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
        enter: FroalaEditor.ENTER_BR,
        pastePlain: true,
        events: {
          initialized: function () {
            const editor = this
            document.getElementById('question3<?php echo $i+1 ?>').innerHTML = editor.html.get()
            document.getElementById('opt<?php echo $i+1 ?>3').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('question3<?php echo $i+1 ?>').innerHTML = editor.html.get()
            document.getElementById('opt<?php echo $i+1 ?>3').innerHTML = editor.html.get()
          }
        }
      })
    })()
  </script>  <script>
   (function () {
      const editorInstance = new FroalaEditor('#at<?php echo $i+1 ?>4', {
      	imageUploadURL: '<?php get_domain("/") ?>upload/upload_image.php',
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
        enter: FroalaEditor.ENTER_BR,
        pastePlain: true,

        events: {
          initialized: function () {
            const editor = this
            document.getElementById('question4<?php echo $i+1 ?>').innerHTML = editor.html.get()
            document.getElementById('opt<?php echo $i+1 ?>4').innerHTML = editor.html.get()
          },
          contentChanged: function () {
            const editor = this
            document.getElementById('question4<?php echo $i+1 ?>').innerHTML = editor.html.get()
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
<br>
	<?php
}

 ?>
	</div>

 <input type="submit" value="Create Question" id="cd_button" class="button" name="create_q">

	</div>
	<script>
		function get_q_box(v)
		{
			$.ajax({
				url: '<?php get_domain("/") ?>ajax/exam/cnt.php',
				type: 'GET',
				data: {r: v},
			})
			.done(function(data) {
				alert(data);
			$(".q_boxq").html(data);
			});
			
		}
	</script>
<div class="q_boxq">
	

</div>




</form>
</div>
</div>
<script src="<?php get_domain("/"); ?>js/jquery.js"></script>
<script src="<?php get_domain("/"); ?>js/jquery.datetimepicker.full.js"></script>

<script>
    /*jslint browser:true*/
    /*global jQuery, document*/

    jQuery(document).ready(function () {
        'use strict';

        jQuery('.datetime').datetimepicker({
        	format:'Y-m-d H:i:00'
        });
    });
</script>
	<?php
} else{
$sql = "SELECT * FROM `question_condi` ORDER BY (max-total) DESC";
$m = mysqli_query($db,$sql);
while ($row= mysqli_fetch_array($m)) {
?>
<div class="ask336969" style="max-width: 600px; padding: 1%; margin: 1% auto; border: 1px solid #ccc; animation: son .4s;">
	<h3><?php echo $row['title'] ?></h3><br>
	<p><?php echo $row['description'] ?></p><br>
	<table style="width: 100%">
		<tr>
			<td><strong style="font-weight: bold;">Class:</strong></td>
			<td><b><?php echo $row['class'] ?></b></td>
		</tr>
		<tr>
			<td><strong style="font-weight: bold;">Subject:</strong></td>
			<td><b><?php echo $row['subject'] ?></b></td>
		</tr>
		<tr>
			<td><strong style="font-weight: bold;">Chapter:</strong></td>
			<td><b><?php echo $row['chapter'] ?></b></td>
		</tr>
		<tr>
			<td><strong style="font-weight: bold;">Question Type:</strong></td>
			<td style="color: #FF12A9"> <b> <?php if($row['type']==1){ echo "Question Bank";}else {echo "Live Exam";} ?></b></td>
		</tr>
		<tr>
			<td><strong style="font-weight: bold;">Added Question:</strong></td>
			<td><b style="font-weight: bold; color: #FF9600"> <?php $total = $row['total']; echo arial($total); ?>   <span style="color: #FF12A9">/</span>  <?php echo arial($max = $row['max']) ?></b></td>
		</tr>
		<tr>
			<td></td>
			<td><br><a href="<?php get_domain("/exam.php?add_question&ref=") ?><?php echo $row['id'] ?>" class="cd_button btn">Add Question</a></td>
		</tr>
	</table>
</div>
<?php
}
}
?>
<style>
	@keyframes son {
		0%{
			border-radius: 100px;
		}
	}
</style>
<script>
	$(document).ready(function() {
		$(".ask336969").effect("zoom");
	});
</script>
</body>
</html>




































































<?php
} else { ?>



<?php include 'header.php'; ?>
<?php get_header("Exam | PaiPixel Online Exam") ?>
<?php get_top_menu("") ?>


<script>
	$(document).ready(function() {
		$(".top_menu_section.menu_section a").click(function(event) {
			window.location=$(this).attr("href");
		});
	});
</script>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/nav_menu.css?d">
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/table.css?s5">
<script>
	$(document).ready(function() {
		$(".open_nav").click(function() {
			$(".nav_responsive").fadeIn(100);
			$(".nav_responsive_fix").fadeIn(100);
		});
		$(".nav_responsive_fix").click(function() {
			$(".nav_responsive").fadeOut(100);
			$(".nav_responsive_fix").fadeOut(100);
		});
		$(".close_nav").click(function() {
			$(".nav_responsive").fadeOut(100);
			$(".nav_responsive_fix").fadeOut(100);
		});

		$(window).resize(function() {
			if ($(window).innerWidth() > 716 && $(".nav_responsive").css("display","none")) {
				$(".nav_responsive").css("display","inline-block");
			} else {
				$(".nav_responsive").css("display","none");
			}
		});
	});
</script>
<script>
	$(document).ready(function() {
		$(window).scroll(function() {
			var height = $(window).scrollTop();
			if(height>306){
				$(".nav_menu").addClass('fixed_menu');
				$(".container").css('margin-top', '50px');
			} else {
				$(".nav_menu").removeClass('fixed_menu');
				$(".container").css('margin-top', '0px');
			}
		});

		$(".nav_menu .cf a.<?php echo $active ?>").addClass('active');
	});
</script>

<div class="nav_menu">
	
<nav class="cf">
		<a href="<?php get_domain("/") ?>" class="menu_item_home">Home</a>
		<?php 
if (user_detail("power")==1 || user_detail("role")==2) {
	?>
<a href="<?php get_domain("/") ?>exam.php?add_question" class="menu_item_results">Add Questions</a>
	<?php
}

	?>
	<a href="javascript:void(0)" class="open_nav nav_button"><span class="material-icons">menu</span></a>
<div class="nav_responsive_fix"></div>
		
		<div class="nav_responsive">
			<a href="javascript:void(0)" class="close_nav nav_button"><span class="material-icons">close</span></a>
			<!-- <a href="<?php get_domain("/") ?>tutorial" class="menu_item_tutorial">Tutorial</a> -->
			<a href="<?php get_domain("/") ?>exams" class="menu_item_exams active">Individual Exam</a>
			<a href="<?php get_domain("/") ?>team_exam" class="menu_item_team_exam">Team Exam</a>
			<!-- <a href="<?php get_domain("/exam.php") ?>" class="menu_item_exam_list active">Exam List</a> -->
			<a href="<?php get_domain("/") ?>ratings" class="menu_item_rating">Rating</a>
			<a href="<?php get_domain("/") ?>score.php" class="menu_item_score">Score Leaderboard</a>
			<a href="<?php get_domain("/") ?>week.php" class="menu_item_weakly">Weekly Top Scorers</a>
<?php if (user_detail("role")==1) {
?>
<a href="<?php get_domain("/") ?>model.php" class="menu_item_model">Start Exam Now</a>

<?php
} ?>
			<a href="<?php get_domain("/") ?>buy.php" class="menu_item_buy">Buy Exam</a>
			<a href="<?php get_domain("/") ?>ask_teacher" class="menu_item_ask_teacher"><?php echo x("Ask") ?> Question</a>
			<!-- <a href="<?php get_domain("/") ?>hire_teacher" class="menu_item_hire_teacher">Hire Teacher</a> -->
			<a href="<?php get_domain("/") ?>FAQ" class="menu_item_faq">FAQ</a>
		</div>

		</div>
		
	</nav>
</div>
<div class="pup_up" style="display: none;"></div>
<div class="ajax_data" style="display: none;"></div>
<div class="main_corner">
<div class="area_content" style="margin: 10px auto; background: white; width: 95%; box-shadow: 0px 0px 4px 2px #ccc; padding: 2%; ">


















<?php 
if (isset($_GET['exam'])) {
$exam = $_GET['exam'];
if (isset($_GET['team'])) {
$sql= "SELECT * FROM team_chal WHERE id='$exam' ORDER BY id DESC";
$m = mysqli_query($db,$sql);
$row = mysqli_fetch_array($m);

if($row['accept_id']==0){
?>
<h2>The exam page is , yet not ready.</h2>
<?php 
exit();
}
if($row['parent']!=0){
$real_id = $row['parent'];
$sql = "SELECT * FROM team_chal WHERE id='$real_id'";
$g = mysqli_query($db,$sql);
$rot = mysqli_fetch_array($g);


$sql = "SELECT * FROM team_chal WHERE id='$real_id'";
$s = mysqli_query($db,$sql);
$ot = mysqli_fetch_array($s);



} else {
$real_id = $row['id'];

$sql = "SELECT * FROM team_chal WHERE id='$real_id'";
$g = mysqli_query($db,$sql);
$rot = mysqli_fetch_array($g);


$sql = "SELECT * FROM team_chal WHERE parent='$real_id'";
$s = mysqli_query($db,$sql);
$ot = mysqli_fetch_array($s);


}


$member = $row['member'];
$check_if_member = substr($member,1);
$check_if_member = explode(',',$member);

$my_team = 0;
for ($i=0; $i < count($check_if_member); $i++) { 
	if ($check_if_member[$i]==user_detail("id")) {
		$my_team = 1;
	}
}
if ($my_team!=1) {
	echo "Team Member Selecting Problem.";
	exit();
}





date_default_timezone_set("Asia/Dhaka");
$exam_starting_date = strtotime($rot['date']);
$exam_ending_date = $exam_starting_date + 86400;
$cur_time = time();
if ($exam_starting_date>time()) {
?>
<h2>Please wait. The exam is starting in : <div class="time"></div></h2>

<?php 
exit();
}
if ($exam_ending_date<time()) {
?>
<h2>Sorry The exam Time is out. <a href="" class="button button_standard">View Result</a></h2>
<?php 
exit();
}


$my_member = explode(",", substr($row['member'],1));
$ot_member = explode(",", substr($ot['member'],1));
for ($i=0; $i < count($my_member); $i++) { 
	if(member_by_id($my_member[$i])==user_detail("user_name")){
		$position = $i;
	}
}


$cm_data = user_detail("id").$exam;
$sql  = "SELECT * FROM team_exam_data WHERE data='$cm_data'";
$p = mysqli_query($db,$sql);
$date = date("Y-m-d H:i:s");
if (mysqli_num_rows($p)==0) {
	$sql = "INSERT INTO `team_exam_data` (`data`, `time`, `value`) VALUES ('$cm_data', '$date', 'started') ";
	mysqli_query($db,$sql);
}
$sql  = "SELECT * FROM team_exam_data WHERE data='$cm_data'";
$pd = mysqli_query($db,$sql);
$f = mysqli_fetch_array($pd);
$dodl = strtotime($f['time'])+300;
$dodl = date("Y-m-d H:i:s",$dodl);
if ($f['value']!='started') {
?>
<div style="max-width: 500px; margin: 0px auto; text-align: center;">
<h2>Your exam is finished.</h2> The result will be published on: <?php echo date("h:i a, d M Y",$exam_ending_date) ?><br>
Your Score is: <strong> <?php $sql="SELECT score FROM `team_score` WHERE cm_id='$cm_data';"; $ios = mysqli_query($db,$sql);  $is = 0; while($fo = mysqli_fetch_array($ios)){ $is += $fo[0]; } echo number_format($is,2);?></strong>
</div>
<?php 
	exit();
}
?>
<h2 style="max-width: 500px; margin: 0px auto;font-size: 15px;"><b>Note:</b> If your opponent member doesn't add 5 questions, don't worry. You just press submit button and you will get the auto mark for the missing questions.</h2>
<h2 class="noify" style="color: red;max-width: 500px; margin: 0px auto;"></h2>
<?php 
$ma_user = member_by_id($ot_member[$position]);
$ids = $ot['id'];
$sql = "SELECT * FROM team_chal_qtn WHERE user='$ma_user' AND ids='$ids'";
$q = mysqli_query($db,$sql);
$page = rand();
?>
<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/extra/time_counter.php',
		type: 'GET',
		data: "time=<?php echo $dodl ?>",
	})
	.done(function(data) {
		$(".noify").html("Exam will end in: " + data);
		if (data=='Exam Has Finished') {
			$(".submit_thisone").click();
		}
	});
	
},1000);

</script>
<script>
function add_report(id)
{
if ($("#at4s"+id).html()!="Unreport") {
$(".report_cl").dialog({
	open: true,
	modal: true,
	buttons:{
		"Confirm & Report":function()
		{
			$("#at4s"+id).html("Unreport");
			$("#report"+id).val("1");
			$("#report_about"+id).val($.trim($("#dmd00").val()));
			$(this).dialog("close");
		},
		"Close":function(){
			$(this).dialog("close");
		}
	}
});
} else {
	$("#at4s"+id).html("Report");
	$("#report"+id).val("");
}
}
</script>
<div class="report_cl" title="Confirm Reporting" style="display: none;">
	<b>You can only report this question</b>
	<ul>
		<li>If the question setter doesn't add this question from the assigned chapter or topic</li>
		<li>If the correct answer doesn't exist in the available option</li>
		<li>For any other reason, please describe the specific reason in brief.</li>
	</ul>
	<b>Your reported question will be voted by <span style="color: green;">public users</span>. If your report is correct, you will get 1 extra point. But if your report is false, you will lose 2 points.</b>
	<b>Are you sure you want to report this Question?</b>
	<b>If yes, Please Let us know, Why You are reporting this question?</b>
	<textarea maxlength="150" name="" id="dmd00" cols="30" rows="10" class="input"></textarea>
</div>
<form id="a<?php echo $page ?>" medhod="GET" onsubmit="data_submit(event, this);" class="full_border" style="padding: 2%;">
<?php
$i = 1;
while ($row=mysqli_fetch_array($q)) {

?>
<div class="main_tance" style="background:white; padding: 10px; border: 1px solid #20b99d; max-width: 500px; margin: 0px auto;">
		<a href="javascript:void(0)" id="at4s<?php echo $i ?>" class="button button_standard" style="display: block; float: right;" onclick="add_report('<?php echo $i ?>')">Report</a>
<h2 class="question"><?php echo $i ?>. <?php echo $row['question']; ?></h2>
<div class="coverage" style="padding: 2%;">
		<label for="answer<?php echo $i ?>1">
		<input type="radio" value="1" name="answer<?php echo $i ?>" id="answer<?php echo $i ?>1">
		<?php echo $row['ans1']; ?>
		</label><br>
		<label for="answer<?php echo $i ?>2">
			<input type="radio" value="2" name="answer<?php echo $i ?>" id="answer<?php echo $i ?>2">
			<?php echo $row['ans2']; ?>
		</label><br>
		<label for="answer<?php echo $i ?>3">
			<input type="radio" value="3" name="answer<?php echo $i ?>" id="answer<?php echo $i ?>3">
			<?php echo $row['ans3']; ?>
		</label><br>
		<label for="answer<?php echo $i ?>4">
			<input type="radio" value="4" name="answer<?php echo $i ?>" id="answer<?php echo $i ?>4">
			<?php echo $row['ans4']; ?>
		</label><br>
		<input type="hidden" name="id<?php echo $i ?>" value="<?php echo $row['id'] ?>">
		<input type="hidden" name="report<?php echo $i ?>" id="report<?php echo $i ?>" value="">
		<input type="hidden" name="report_about<?php echo $i ?>" id="report_about<?php echo $i ?>" value="">

</div>
</div>
<?php
$i++;
}
?>
<div class="main_tance" style="background:white; padding: 10px; border: 1px solid #20b99d; max-width: 500px; margin: 0px auto;">
<input type="hidden" name="team_data" value="<?php echo $exam; ?>">
<div class="button_set" style="text-align: center;">
	<input type="submit" name="submit" class="button button_standard submit_thisone" style="width: 96%; padding: 10px 2%; background: #20b99d;" value="submit">
</div>
</div>
<div class="eo"></div>
</form>
<script>
function data_submit(event,t)
{
	event.preventDefault();
	var t = $('#a<?php echo $page ?>').serialize();
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/team_exam/submit_ans.php',
		type: 'POST',
		data: t+"&i=<?php echo $i; ?>&cm_data=<?php echo $cm_data ?>",
	})
	.done(function(data) {
		 location.reload(); 
	});
	
}
</script>
<?php 






	exit();
}
date_default_timezone_set("Asia/Dhaka");
$sql = "SELECT * FROM question WHERE exam_id = '$exam' AND pending=1";
$q = mysqli_query($db,$sql);
$m = mysqli_fetch_array($q);
$starting_date = $m["exam_starting_date"];
$main_time = strtotime($starting_date);
// $main_time = strtotime($m['exam_starting_date']);
$exam_time = ($main_time) + (($m['exam_duration'])*60);
$now_time = strtotime(date("Y-m-d H:i:s"));

if ($main_time <= $now_time && $now_time <= $exam_time) {
if (has_registry($exam)) {
	?>
<div class="full_border exam_board" style="text-align: center; padding: 1%">
	<h2>Hi <?php echo $user_name = user_detail("user_name") ?></h2>
	<h2>Your Exam (<?php echo exam_info("name", $exam) ?>) Has Started.</h2>
	<h2><a href="javascript:void(0)" onclick="question_view(1,'<?php echo $exam ?>')">View Question</a></h2>
</div>
<?php 
$mobile = "SELECT * FROM exam_page WHERE exam='$exam' AND user='$user_name' ORDER BY id DESC LIMIT 1";
$mob = mysqli_query($db,$mobile);
$mo  = mysqli_fetch_array($mob);
if($mo['page']!=''){
?>
<script>
	$(document).ready(function() {
		question_view('<?php echo ($mo['page'])+1 ?>','<?php echo $exam ?>')
	});
</script>
<?php
}
?>
<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/exam/view_page.php',
		type: 'POST',
		data: "exam=<?php echo $exam ?>",
	})
	.done(function(data) {
		$(".full_border").html(data);
	});
	
},1000);

</script>

	<?php
}
} else {
?>
<div class="full_border exam_board" style="text-align: center; padding: 1%">
	<h2>Loading...</h2>
</div>

<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/exam/view_page.php',
		type: 'POST',
		data: "exam=<?php echo $exam ?>",
	})
	.done(function(data) {
		$(".full_border").html(data);
	});
},1000);
</script>

<?php 
}
} else {
if (isset($_GET['exam_details'])) {
$exam = $_GET['exam_details'];
if (isset($_GET['team'])) {
?>
<div class="get_res"></div>
<div class="my_team" style="margin: 1% auto; max-width: 500px;">
	<h2><?php 
$sql = "SELECT * FROM team_chal WHERE id='$exam'";
$pp = mysqli_query($db,$sql);
$mo = mysqli_fetch_array($pp);
echo get_team($mo['team']);
?>
<span class="score" style="float: right;">Score: <?php $sql = "SELECT SUM(score) FROM `team_score` WHERE chal='$exam'";
	$q = mysqli_query($db,$sql); $rm = mysqli_fetch_array($q); echo arial(number_format($rm[0],3)) ?></span></h2>
<table class="data_table table_hoverable">
	<tr>
		<th>Position</th>
		<th>User Name</th>
		<th>Score</th>
	</tr>
<?php
	$sql = "SELECT * FROM `team_score` WHERE chal='$exam' GROUP BY cm_id ORDER BY score DESC";
	$q = mysqli_query($db,$sql);
	$i = 0;
	while($row=mysqli_fetch_array($q))
	{
		$cm_id = $row['cm_id'];
		$sql = "SELECT SUM(score) FROM  `team_score` WHERE cm_id='$cm_id'";
		$y = mysqli_query($db,$sql);
		$j = mysqli_fetch_array($y);
		$x = $j[0];
?>
<tr>
	
<td><?php echo ($i+1); ?></td>
<td><?php echo $row['user']; ?></td>
<td style="font-family: arial;"><?php echo number_format($x,3); ?></td>
		
</tr>
<?php
$i++;
}

$sql = "SELECT * FROM team_chal WHERE id='$exam'";
$m = mysqli_query($db,$sql);
$g = mysqli_fetch_array($m);
if ($g['parent']!=0) {
$next_team = $g['parent'];
} else {
$sql = "SELECT * FROM team_chal WHERE parent='$exam'";
$m = mysqli_query($db,$sql);
$g = mysqli_fetch_array($m);
$next_team = $g['id'];
}
?>
</table>
</div>

<br><br>	


<div class="my_team" style="margin: 1% auto; max-width: 500px;">
	<h2><?php 
$sql = "SELECT * FROM team_chal WHERE id='$next_team'";
$pp = mysqli_query($db,$sql);
$mo = mysqli_fetch_array($pp);
echo get_team($mo['team']);
	?> <span class="score" style="float: right;">Score: <?php $sql = "SELECT SUM(score) FROM `team_score` WHERE chal='$next_team'";
	$q = mysqli_query($db,$sql); $rg = mysqli_fetch_array($q); echo arial(number_format($rg[0],3)) ?></span></h2>
<table class="data_table table_hoverable">
	<tr>
		<th>Position</th>
		<th>User Name</th>
		<th>Score</th>
	</tr>
<?php
	$sql = "SELECT * FROM `team_score` WHERE chal='$next_team' GROUP BY cm_id ORDER BY score DESC";
	$q = mysqli_query($db,$sql);
	$i = 0;
	while($row=mysqli_fetch_array($q))
	{
		$cm_id = $row['cm_id'];
		$sql = "SELECT SUM(score) FROM  `team_score` WHERE cm_id='$cm_id'";
		$y = mysqli_query($db,$sql);
		$j = mysqli_fetch_array($y);
		$x = $j[0];
?>
<tr>
	
<td><?php echo ($i+1); ?></td>
<td><?php echo $row['user']; ?></td>
<td style="font-family: arial;"><?php echo number_format($x,3); ?></td>
		
</tr>
<?php
$i++;
	}
?>
</table>
<script>
$(document).ready(function() {
	
<?php 
if ($rm[0]>$rg[0]) {
	echo "xst($exam,$next_team)";
}else {
	echo "xst($next_team,$exam)";
}
?>
});
</script>
<script>
	function xst(first,second)
	{
		$.ajax({
			url: '<?php get_domain("/ajax/team_exam/rating_change.php") ?>',
			type: 'GET',
			data: {first: first,second:second},
		})
		.done(function(data) {
			$(".get_res").html(data);
		})
		.fail(function() {
			$(".get_res").html("failed loading...");
		});
		
	}
</script>
</div>
<?php
	exit();
}
?>
<script>
	$(document).ready(function() {
		$(".top_menu_section.menu_section a").click(function(event) {
			window.location=$(this).attr("href");
		});
	});
</script>
<div class="button_group">
	<a href="<?php get_domain("/") ?>exam.php?exam_details=<?php echo $exam ?>" class="transtrification_button active" title="Exam Details">Exam Details</a>
	<a href="<?php get_domain("/") ?>exam.php?exam_questions=<?php echo $exam ?>" class="transtrification_button" title="Questions">Questions</a>
	<a href="<?php get_domain("/") ?>exam.php?pre_exams&exam_id=<?php echo $exam ?>" class="transtrification_button" title="Score Board">Score Board</a>
	<a href="<?php get_domain("/") ?>exam.php?exam_ratings=<?php echo $exam ?>" class="transtrification_button" title="Ratings">Ratings</a>
</div>
<div class="full_border exam_board" style="text-align: center; padding: 1%">
	<h2>Loading...</h2>
</div>

<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/exam/exam_fund.php',
		type: 'POST',
		data: "exam=<?php echo $exam ?>",
	})
	.done(function(data) {
		$(".full_border").html(data);
	});
},1000);
</script>
<?php
	exit();
}






























if (isset($_GET['exam_ratings'])) {
$exam = $_GET['exam_ratings'];
?>
<style>

</style>
<div class="button_group">
	<a href="<?php get_domain("/") ?>exam.php?exam_details=<?php echo $exam ?>" class="transtrification_button" title="Exam Details">Exam Details</a>
	<a href="<?php get_domain("/") ?>exam.php?exam_questions=<?php echo $exam ?>" class="transtrification_button" title="Questions">Questions</a>
	<a href="<?php get_domain("/") ?>exam.php?pre_exams&exam_id=<?php echo $exam ?>" class="transtrification_button" title="Score Board">Score Board</a>
	<a href="<?php get_domain("/") ?>exam.php?exam_ratings=<?php echo $exam ?>" class="transtrification_button active" title="Ratings">Ratings</a>
</div>
<div class="full_border exam_board" style="text-align: center; padding: 1%">
	<h2>Loading...</h2>
</div>

<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/exam/exam_rating.php',
		type: 'POST',
		data: "exam=<?php echo $exam ?>",
	})
	.done(function(data) {
		$(".full_border").html(data);
	});
},1000);
</script>
<?php
	exit();
}








if (isset($_GET['exam_questions'])) {
$exam = $_GET['exam_questions'];
?>
<style>

</style>
<div class="button_group">
	<a href="<?php get_domain("/") ?>exam.php?exam_details=<?php echo $exam ?>" class="transtrification_button" title="Exam Details">Exam Details</a>
	<a href="<?php get_domain("/") ?>exam.php?exam_questions=<?php echo $exam ?>" class="transtrification_button active" title="Questions">Questions</a>
	<a href="<?php get_domain("/") ?>exam.php?pre_exams&exam_id=<?php echo $exam ?>" class="transtrification_button" title="Score Board">Score Board</a>
	<a href="<?php get_domain("/") ?>exam.php?exam_ratings=<?php echo $exam ?>" class="transtrification_button" title="Ratings">Ratings</a>
</div>
<div class="full_border exam_board" style="text-align: center; padding: 1%">
	<h2>Loading...</h2>
</div>

<script>
var myVar = setInterval(avg,1000);
function avg(){
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/exam/exam_questions.php',
		type: 'POST',
		data: "exam=<?php echo $exam ?>",
	})
	.done(function(data) {
		$(".full_border").html(data);
		if ($.trim(data)!='Question Paper Not published.') {
			clearInterval(myVar);
		}
	});
	
}
</script>
<?php
	exit();
}
?>
<div class="search_box">
	<form onsubmit="event.preventDefault()">
	<input type="text" id="soennddkhh" class="input" style="width: 50%" placeholder="search by exam id"><input type="submit" value="search" style="padding: 7.9px 1%;" onclick="searchinverter(document.getElementById('soennddkhh').value)" class="button button_standard">
	<input type="button" value="Reload" style="padding: 7.9px 1%;" onclick="searchinverter('')" class="button button_standard">
	</form>
</div>
<style>
@media(max-width: 700px)
{
	.data_table{
		font-size: 9px;
	}
	.rtr25 {
		display: none;
	}
}
</style>
<?php
echo "<div class='acctt'>";
	$sql = "SELECT * FROM question WHERE pending=1 GROUP BY exam_id LIMIT 200";
	$q = mysqli_query($db,$sql);
	?>
<script>
	$(document).ready(function() {
		$(".data_table").effect("slide");
	});
</script>
<table class="data_table">
	<tr>
		<th>Exam No.</th>
		<th>Exam Name</th>
		<th>Total Register</th>
		<th>Class/Chapter</th>
		<th class="rtr25">Duration</th>
		<th>Starting Time</th>
	</tr>
	<?php if (mysqli_num_rows($q)==0): ?>
		<tr>
			<td colspan="6">No Details Found</td>
		</tr>
	<?php endif ?>
	<?php
	while ($row = mysqli_fetch_array($q)) {
		
	?>

<tr class="exam_b<?php echo $row['exam_id'] ?>">
<td style="font-family: arial;"><?php echo count_exam_no($row['exam_id']) ?></td>
<td style="font-family: arial;"><a href="<?php get_domain("/exam.php?exam_details=".$row['exam_id']) ?>">
<?php echo $row['name'] ?></a></td>
<td style="font-family: arial;">
<?php
$sql = "SELECT * FROM exam_reg WHERE exam = '".$row['exam_id']."'";
$g = mysqli_query($db,$sql);
echo $s = mysqli_num_rows($g);  ?></td>
<td style="font-family: arial; text-align: left;"><?php echo $row['class'] ?> - <?php echo $row['chapter'] ?></td>
<td class="rtr25" style="font-family: arial;"><?php echo $row['exam_duration'] ?> Min</td>
<td style="font-family: arial;"><?php echo date("d M Y, h:i a",strtotime($row['exam_starting_date'])) ?></td>
</tr>

	<?php
}
}
?>
</table>

</div>
<script>
function searchinverter(search)
{
$.ajax({
	url: '<?php get_domain("/") ?>ajax/exam/search_exam.php',
	type: 'POST',
	data: {search: search},
})
.done(function(dta) {
	$(".acctt").html(dta);
});
}
</script>
</div>



<?php
} ?>