<?php 
function get_footer()
{
  include 'ajax/db_back.php';
  $role = 0;
  if (isset($_SESSION['login_data_paipixel24'])) {
  $user = $_SESSION['login_data_paipixel24'];
  $sql = "SELECT * FROM user WHERE user_name = '$user'";
  $q = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($q);
  $role = $row['role'];
}
?>


<?php
  if ($role==2) {
?>
<style class="distyr-style">
  
.msnger_fax {
  display: none;
}

</style>
<?php
  }
?>

<style>
#m25 {
    border-radius: 39%;
    width: 73px;
}
.ns_msnger_vsl {
  position: fixed;
  bottom: 97px;
  right: 50px;
  height: 500px;
  width: 350px;
  background: white;
  z-index: 1000;
  box-shadow: 1px 1px 4px 2px #ccc;
}
/*.ns_msnger_vsl:after {
  content: "";
  position: absolute;
  bottom: -50px;
  right: 5%;
  border-top: 15px solid #ddd;
  border-bottom: 15px solid transparent;
  border-right: 15px solid transparent;
  border-left: 15px solid transparent;
  
}*/
@media(max-width: 500px){
  .ns_msnger_vsl {
    height: 500px;
    width: 87%;
    right: 5%;
    bottom: 95px;
  }
}
.msnger_fax {
  position: fixed;
  right: 5%;
  bottom: 0%;
  cursor: pointer;
}
.msnger_fax:hover {
  filter: brightness(80%);
}
.log {
  position: relative;
  text-align: center;
  justify-content: center;
  display: flex;
  padding-top: 50%;
  font-size: 25px;
}



</style>

<?php
  if ($role!=2) {
?>
<script>
	$(document).ready(function() {
			$.ajax({
				url: '<?php get_domain("/msnger.php") ?>',
				type: 'POST',
				data: 'handshake',
				beforeSend:function(){
					$(".ns_msnger_vsl").html("<div class='log'>Loading...</div>");
				}
			})
			.done(function(data) {
				$(".ns_msnger_vsl").html(data);
			});
	});
</script>
<script>
function open_msg(){
	
	if (document.getElementById('vs_sw').data == 'block') {
		// document.getElementById('vs_sw').style.display = 'none';
		$("#vs_sw").hide("slow");
		document.getElementById('vs_sw').data = 'none';
	} else {
		// document.getElementById('vs_sw').style.display = 'block';
		$("#vs_sw").show("slow");
		document.getElementById('vs_sw').data = 'block';
	}
}	
</script>

<script>
function open_msg_only(){
    $("#vs_sw").show("slow");
    document.getElementById('vs_sw').data = 'block';
} 
</script>
<div class="ns_msnger_vsl" id="vs_sw" data="none" style="display: none;">
	
</div>
<style>
  .donadd {
  text-align: center;
  background: red;
  color: white;
  padding: 10px;
  right: -90px;
  position: relative;
  top: -50px;
  border-radius: 100px;
  font-family: arial;
}
</style>
  <script>
    setInterval(function(){
    var me = '<?php echo user_detail("id"); ?>';
      $.ajax({
        url: "<?php get_domain("/msnger") ?>/msnger.total.php",
        type: "POST",
        data: "me="+me,
        success:function(data){
          if ($.trim(data)==0) {
            $(".donadd").hide(0);
          }else {
            $(".donadd").show(0);
          $(".donadd").html($.trim(data));
          }
        }
      });
  },100);
  </script>
<div class="msnger_fax" id="msg_btn" onclick="open_msg()">
  <span class="donadd" style="display: none;"></span>
	<img src="<?php get_domain("/image/add_msg.png") ?>" alt="" id="m25">
</div>

<?php
  }
?>
</body>
</html>













































<?php
}
?>