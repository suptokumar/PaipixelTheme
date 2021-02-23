<?php 
if (isset($_POST['handshake'])) {
	include 'ajax/db_back.php';
	include 'functions.php';
	session_start();
} else {
	include 'ajax/db_back.php';
}
if (!isset($_SESSION['login_data_paipixel24'])) {
	echo "<div class='log'>You Are not Logged In</div>";
	exit();
}
?>
<link rel="stylesheet" href="<?php get_domain("/") ?>css/msnger.css?ver=100">
<?php 
if (isset($_GET['msg'])) {
	?>
<script>
	$(document).ready(function() {
		$(".Message").dialog({
			open: true,
			modal: true,
			title: "Message",
			buttons: {
				"ok":function(){
					$(this).dialog("close");
				}
			}
		});
	});
</script>
<div class="Message">
	
	<?php
	echo $_GET['msg'];
?>
</div>
	<?php
}
?>
<style>
	.fst_em{
		cursor: default;
	}
</style>
<div class="headser_osd">
	<div class="fst_em" onclick="click_eff();">Create Message</div>
</div>
<script>
	function click_eff(){
		$("#vs_sw").slideUp("slow");
		document.getElementById('vs_sw').data = 'none';
	}
</script>
<div class="red_alert"></div>
<script>
function sendbackmsnger(){
	$(".msnger_tab.msnger_shortcut").fadeIn("slow"); 
	$(".headser_osd").html('<div class="fst_em" onclick="click_eff();">Create Message</div>');
				$(".data_users").removeClass('added_user');
}
</script>
<script>
	function adjustHeight(o){
    o.style.height = "1px";
  if (o.scrollHeight>200) {
  o.style.height = "200px";
  o.style.overflow = "auto";
  } else {
  o.style.overflow = "hidden";
  o.style.height = (o.scrollHeight-4)+"px";
  }
}
</script>
<div class="colspant">
	<script>
		function create_msnger_user(v){
			$.ajax({
				url: "<?php get_domain("/") ?>msnger/msnger.user.list.php",
				data: "user="+v,
				type: "POST",
				beforeSend:function(){
					$(".pre_loader").html('<img src"" alt="loading..."/>');
				},
				success:function(data){
					$(".load_users").html(data);
				}
			});
		}
	</script>
	<script>
		$(document).ready(function() {
			create_msnger_user("");
		});
	</script>
	<script>
		function check_if_inter(event){
			var key = event.which;
			if (key==13) {
			if (event.shiftKey) {
				alert("ok");
			} else {
				submit_msg();
			}
			}
		}
	</script>
	<script>
		function add_user_to_msg(user)
		{
			$(".data_users").removeClass('added_user');
			$(".data_"+user).addClass('added_user');
			set_added_user(user);
		}
	</script>
		<script>
		  $( function() {
    $( document ).tooltip();
  } );
	</script>
	<script>
		function set_added_user(user){
			$.ajax({
				url: "<?php get_domain("/msnger/") ?>msnger_added_user_detail.php",
				type: "POST",
				data: "user="+user,
				success:function(data){
					$(".msnger_tab.msnger_shortcut").slideUp("slow");
					$(".msnger_user_detail").css("background","white");
					$(".msnger_user_detail").html(data);
					$.ajax({
						url: '<?php get_domain("/msnger/username.php") ?>',
						type: 'POST',
						data: {user: user},
					})
					.done(function(data) {
					$(".headser_osd").html('<button class="back_button" onclick="sendbackmsnger();"><span class="material-icons">arrow_back </span> Back</button> <span class="name_shit">'+data+'</span>');
					});
					

				load_all_msg();
				}
			});
		}
		function randomate(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
	</script>
	<?php 
$me = $_SESSION['login_data_paipixel24'];
include 'ajax/db_back.php';
$sql = "SELECT * FROM user WHERE user_name='$me'";
$mysql = mysqli_query($db,$sql);
$row = mysqli_fetch_array($mysql);
$user_images = $row['image'];
$user_fst_names = $row['first_name'];
	?>
	<script>
		function submit_msg(){
			var sendto = $(".added_user").attr("user");
			var msg = $(".msg_box_perfomer").val();
			var from = '<?php echo $_SESSION['login_data_paipixel24']; ?>';
			var code = randomate(40000,80000000);
			$.ajax({
				url: "<?php get_domain("/msnger/") ?>msnger.sent.type.1.php",
				type: "POST",
				data: "from="+from+"&to="+sendto+"&code=as"+ code +"&msg="+msg,
				beforeSend:function(){
					$(".msg_box_perfomer").val("");
					$(".msger_port").append('<div class="msnger_own_port" id="'+code+'"><img src="<?php echo $user_images; ?>" alt="<?php echo $user_fst_names ?>" /><span class="text">'+msg+'</span></div>');
					scroll_to_bottom();
				},
				success:function(data){
					// alert(data);
				}
			});
		}
	</script>
	<script>
		setInterval(function(){
		var me = '<?php echo $_SESSION['login_data_paipixel24']; ?>';
			var profile = $(".added_user").attr('user');
			$.ajax({
				url: "<?php get_domain("/msnger") ?>/msnger.load_new_msg.php",
				type: "POST",
				data: "me="+me+"&profile="+profile,
				success:function(data){
					$(".msger_port").append(data);
					if ($.trim(data)!='') {
					scroll_to_bottom();
					}

				}
			});
	},100);
	</script>
	<script>
		function scroll_to_bottom(){
			var height = $(".msger_port")[0].scrollHeight;
			$(".msger_port").animate({scrollTop:height}, 100)
		}
	</script>
	<script>
		function load_all_msg()
		{
			var me = '<?php echo $_SESSION['login_data_paipixel24']; ?>';
			var profile = $(".added_user").attr("user");
			$.ajax({
				url: "<?php get_domain("/msnger/") ?>msnger.load_all_msg.php",
				type: "POST",
				data: "me="+me+"&profile="+profile+"&page="+1,
				success:function(data){
					$(".msger_port").html(data);
					scroll_to_bottom();
				}
			});
		}
		function prev_load(page,profile,me,id)
		{
var me = '<?php echo $_SESSION['login_data_paipixel24']; ?>';
			var profile = $(".added_user").attr("user");
			$.ajax({
				url: "<?php get_domain("/msnger/") ?>msnger.load_all_msg.php",
				type: "POST",
				data: "me="+me+"&profile="+profile+"&page="+page,
				success:function(data){
					$(".msger_port").prepend(data);
					$("#rand"+id).remove();
				}
			});
		}
	</script>
	<script>
		function relax_user(){
			var me = '<?php echo $_SESSION['login_data_paipixel24']; ?>';
			$.ajax({
				url: "<?php get_domain("/msnger/") ?>msnger.get_last_user.php",
				type: "POST",
				data: "me="+me,
				success:function(data){
				add_user_to_msg(data);
			}
			});
		}
	</script>
	<script>
		$(document).ready(function() {
			// relax_user();
		});
	</script>
	<div class="msnger_coloni">
		<div class="msnger_tab msnger_shortcut">
			<ul class="load_users">
				<li><a href="#"><img src="img/add_msg.png" alt=""><span>New Message</span></a></li>
				<center class="pre_loader"></center>
			</ul>
		</div>
		<div class="msnger_tab msnger_controll">
			<div class="msger_port">
				
			</div>
			<div class="msnger_input">
				<div class="msnger_input_fixer">
					
				<div class="msnger_send">
				<textarea class="msnger_box msg_box_perfomer msnger_toggle_left" placeholder="Type Message" resizeable="none" onkeyup="adjustHeight(this);check_if_inter(event)"></textarea>
				<button onclick="submit_msg();" class="msnger_button msnger_toggle_left">Send</button>
				</div>
<!-- 				<div class="text_shortcuts">
					<ul class="stct_s">
						<li><a href="javascript:void(0)"><img src="img/img.png" title="Add Image" onclick="add_image_msnger();" alt=""></a></li>
						<li><a title="Add Product" onclick="add_pd_msnger();" href="javascript:void(0)"><img src="img/pd.png" alt=""></a></li>
						<li><a title="I am satisfied" href="javascript:void(0)"  onclick="add_smile_msnger();"><img src="img/smile.png" alt=""></a></li>
					</ul>
				</div> -->
			</div>
			</div>
		</div>
		<div class="msnger_tab msnger_user_detail">

		</div>
	</div>
</div>
