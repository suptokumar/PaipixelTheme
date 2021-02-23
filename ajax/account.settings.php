<?php include 'db.php'; ?>
<?php  $user = $_POST['user']; 
	$sql = "SELECT * FROM user WHERE user_name = '$user'";
	$q = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($q);
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$phone_number = $row['phone_number'];
	$email = $row['email'];
	$role = $row['role'];
	$class = $row['class'];
	$id = $row['id'];
	$school = $row['school'];
	$Address = $row['Address'];
	$google_location = $row['google_location'];
	$interested = $row['interested'];
	$bio = $row['bio'];
	$rating = $row['rating'];
	$image = $row['image'];
	$depertment = $row['depertment'];
	$friend = $row['friend'];
	$balance = $row['balance'];
	$active = $row['active'];
	$background = $row['background'];
	$phone_confirm = $row['phone_confirm'];
	$email_confirm = $row['email_confirm'];
?>
<style>
.admit_form {
  text-align: left;
  margin: 20px 0px;
  color: black;
  overflow: hidden;
}
.admit_form label {
  display: block;
  margin-top: 4px;
}
.admit_form input , .admit_form select, .admit_form textarea {
  width: 98%;
  padding-top: 10px;
  padding-bottom: 4px;
  font-size: 17px;
  color: #777;
  background: white;
  border: none;
  border-bottom: 1px solid #ccc;
  display: block;
  margin-top: -10px;
  margin-left: 2px;
}
.admit_form #login_button {
  width: auto;
  float: right;
  border: 1px solid;
  padding: 10px 20px;
  margin-bottom: 0;
  cursor: pointer;
  color: #d53f04;
  transition: .2s ease-in-out;
  margin-top: 0px;
}
.hoverable_button:hover {
  background: #d53f04;
  color: white !important;
}
.func_table tr td{
	border: none;
}
</style>
<script>
	$(document).ready(function() {
		$("#p1").submit(function(event) {
			event.preventDefault();
			var data = $(this).serialize();
			$.ajax({
				url: '<?php get_domain("/ajax/set.personal_info.php") ?>',
				type: 'POST',
				data: data,
			})
			.done(function(data) {
				alert(data);
				$(".menu_section.top_menu_section a:first-child").click();
			// window.location='<?php get_domain("/account") ?>';
				
			})
			.fail(function() {
				alert("NetWork Error !");
			});
			
		});
	});
</script>
<br><br>
<div class="mes"></div>
<div style="max-width: 1300px; margin: 1px auto;">
<div class="text_part">
	
<div class="header_title" data-opens="p1" style="text-align: center;">Personal Informations</div>
<div class="header_title" enctype='multipart/form-data' data-opens="p0"  style="text-align: center;">Profile Picture</div>
<div class="header_title" data-opens="p3"  style="text-align: center;">Needed Informations</div>
<div class="header_title" data-opens="p4"  style="text-align: center;">Password Reset</div>
<div class="header_title" data-opens="p5"  style="text-align: center;">Account Deactivation</div>
</div>
<div class="form_part">
<form id="p1" class="admit_form" style="padding: 0% 5%">
	<table class="func_table" style="border-top: 1px solid #ccc">
		<tr>
			<td>First Name</td>
			<td><input type="text" name="first_name" value="<?php echo $first_name ?>" required id="first_name"></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="last_name" value="<?php echo $last_name ?>" required id="last_name"></td>
		</tr>
		<tr>
			<td>Department</td>
			<td><input type="text" name="depertment" value="<?php echo $depertment ?>" id="depertment"></td>
		</tr>
		<tr>
			<td>Your District</td>
			<td>
				<select name="address" value="<?php echo $Address ?>" id="address" >
			<?php $dist = ["Bagerhat","Bandarban","Barguna","Barishal","Bhola","Bogura","Brahmanbaria","Chandpur","Chapainawabganj","Chattogram","Chuadanga","Comilla","Cox's Bazar","Dhaka","Dinajpur","Faridpur","Feni","Gaibandha","Gazipur","Gopalganj","Habiganj","Jamalpur","Jashore","Jhalokati","Jhenaidah","Joypurhat","Khagrachhari","Khulna","Kishoreganj","Kurigram","Kushtia","Lakshmipur","Lalmonirhat","Madaripur","Magura","Manikganj","Meherpur","Moulvibazar","Munshiganj","Mymensingh","Naogaon","Narail","Narayanganj","Narsingdi","Natore","Netrokona","Nilphamari","Noakhali","Pabna","Panchagarh","Patuakhali","Pirojpur","Rajbari","Rajshahi","Rangamati","Rangpur","Satkhira","Shariatpur","Sherpur","Sirajganj","Sunamganj","Sylhet","Tangail","Thakurgaon"];


for ($i=0; $i < count($dist); $i++) { 

	?>
<option value="<?php echo $dist[$i] ?>" <?php if ($dist[$i]==$Address): ?>
	<?php echo "selected" ?>
<?php endif ?>><?php echo $dist[$i] ?></option>
	<?php
}
			 ?>
</select>
			</td>
		</tr>
		<tr>
			<td>Email Address</td>
			<td><input type="email" name="email" value="<?php echo $email ?>" id="email"></td>
		</tr>
		<tr>
			<!-- <td>Google Location</td> -->
			<td><input type="hidden" name="google_location" value="<?php echo $google_location ?>" id="google_location"></td>
		</tr>
		<tr>
			<td>Bio</td>
			<td><textarea style="border: 1px solid #ccc" rows="4" id="bio" name="bio"><?php echo $bio ?></textarea></td>
		</tr>
		<tr>
			<td><input type="hidden" name="user" value="<?php echo $user; ?>"></td>
			<td><input type="submit" id="login_button" class="hoverable_button" name="submit_147" value="Save"></td>
		</tr>
	</table>
</form>

<script>
function reset_picture() {
	$("#prof_view").attr('src', '<?php echo $image ?>');
	$("#cv_view").attr('src', '<?php echo $background ?>');
	<?php 
if ($image=='') {
	?>
	$("#prof_view").addClass('free_come');
	<?php
}
if ($background=='') {
	?>
	$("#cv_view").addClass('free_come');
	<?php
}
	?>
}
</script>
<script> 
$(document).ready(function (e) {
    $('#p0').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: '<?php get_domain("/ajax/set.image_prof.php") ?>',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                if (parseInt(data)=='1') {
                alert("No change Needed !");
                } else {
                alert(data);
                $(".menu_section.top_menu_section a:first-child").click();
                }
            },
            error: function(data){
                alert("Failed to connect to the server.");
            }
        });
    }));
});
</script>
<script>
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#prof_view').attr('src', e.target.result);
      $("#prof_view").removeClass('free_come');
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}
function readURLs(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#cv_view').attr('src', e.target.result);
      $("#cv_view").removeClass('free_come');
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#profile").change(function() {
  readURL(this);
});
$("#cover").change(function() {
  readURLs(this);
});
</script>
<form id="p0" class="admit_form" style="padding: 0% 5%">
	<table class="func_table" style="border-top: 1px solid #ccc">
<?php 
$ascls=''; $asclsd='';
if ($background=='') {
	$asclsd = 'free_come';
}
if ($image=='') {
	$ascls = 'free_come';
}

?>
<tr>
	<td>Profile Picture</td>
	<td><input type="file" name="profile" id="profile"> <label for="profile">
		<div class="sset"><img id="prof_view" src="<?php get_domain("/"); echo $image ?>" alt="<?php echo $user ?>" style="width: 100px; height: 100px; padding: 10px; cursor: pointer; border: 2px solid #ccc;" class="set_up_image <?php echo $ascls ?>"></div>
	</label></td>
</tr>
<tr style="display: none;">
	<td>Cover Photo</td>
	<td><input type="file" name="cover" id="cover"> <label for="cover">
		<div class="sset"><img id="cv_view" src="<?php get_domain("/"); echo $background ?>" alt="<?php echo $user ?>" style="width: 100px; height: 100px; padding: 10px; cursor: pointer; border: 2px solid #ccc;" class="set_up_image <?php echo $asclsd ?>"></div>
	</label></td>
</tr>

		<tr>
			<td><input type="hidden" name="user" value="<?php echo $user ?>"></td>
			<td><input type="button" onclick="reset_picture()" id="login_button" class="hoverable_button" name="reset" value="Reset"><input type="submit" id="login_button" class="hoverable_button" name="submit_149" value="Update"></td>
		</tr>
	</table>
</form>
<script>
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>
<script>
	$(document).ready(function() {
		$("#p3").submit(function(event) {
			event.preventDefault();
			var data = $(this).serialize();
			$.ajax({
				url: '<?php echo get_domain("/ajax/") ?>account.request.php',
				type: 'POST',
				data: data,
			})
			.done(function(data) {
				alert(data);
				$("#class").val("");
				$("#school").val("");
				$("#cause").val("");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});
	});
</script>
<form id="p3" class="admit_form" style="padding: 0% 5%">
	<table class="func_table" style="border-top: 1px solid #ccc">
<?php if ($role==1) {
			?>
<tr>
	<td>Class</td>
	<td><input type="text" name="class" value="<?php echo $class ?>" id="class"></td>
</tr>
<tr>
	<td>Institution</td>
	<td><input type="text" name="school" value="<?php echo $school ?>" id="school"></td>
</tr>

			<?php
		} else {?>
<tr>
	<td>Educational Qualifications</td>
	<td><input type="tel" name="class" value="<?php echo $class ?>" id="class"></td>
</tr>
<tr>
	<td>Current Workplace / Office Name</td>
	<td><input type="text" name="school" value="<?php echo $school ?>" id="school"></td>
</tr>

	<?php } ?>
<tr>
	<td>Reason</td>
	<td><textarea name="cause" id="cause" cols="4" rows="3" placeholder="Please describe the reason for chaning your Class or Institution."></textarea></td>
</tr>
		<tr>
			<td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
			<td><input type="submit" id="login_button" class="hoverable_button" name="submit_149" value="Send Change Request"></td>
		</tr>
	</table>
</form>
<script>
	$(document).ready(function() {
		$("#p4").submit(function(event) {
			event.preventDefault();
			var datas = $(this).serialize();
			var c = $("#new_password").val();
			var d = $("#c_password").val();
			if(d==''){
				alert("Password Can't be empty !")

			}if(c!=d){
				alert("Both Password Didn't Matched !")

			} else {
				$.ajax({
					url: '<?php get_domain("/ajax/set.pass.php") ?>',
					type: 'POST',
					data: datas,
				})
				.done(function(data) {
					if (parseInt(data)==1) {
						alert("Successfuly Updated Your Password");
						$("#p4 input[type=password]").val('');
					} else{
						alert("Old Password is not valid OR failed to change password.");
					}
				})
				.fail(function() {
					alert("Network Error !");
				});
				
			}
		});
	});
</script>

<form id="p4" class="admit_form" style="padding: 0% 5%">
	<table class="func_table" style="border-top: 1px solid #ccc">

<tr>
	<td>Old Password</td>
	<td><input type="password" name="old_password" id="old_password"></td>
</tr>
<tr>
	<td>New Password</td>
	<td><input type="password" name="new_password" id="new_password"></td>
</tr>
<tr>
	<td>Confirm New Password</td>
	<td><input type="password" name="c_password" id="c_password"></td>
</tr>

		<tr>
			<td><input type="hidden" name="user" value="<?php echo $user ?>"></td>
			<td><input type="submit" id="login_button" class="hoverable_button" name="submit_149" value="Reset"></td>
		</tr>
	</table>
</form>



<form id="p5" class="admit_form" style="padding: 0% 5%">
	<table class="func_table" style="border-top: 1px solid #ccc">

<tr>
	<td>I am Deactivating My account : </td>
	<td>
<select name="deactive" id="deactive" required="">
	<option value="">-- Please Choose a Cause --</option>
	<option value="1">I have another account</option>
	<option value="2">I want to create my new profile</option>
	<option value="3">I want to leave Paipixel</option>
	<option value="4">Other</option>
</select>
	</td>
</tr>
<tr>
	<td>Password</td>
	<td><input type="password" required="" name="old_password" id="old_password"></td>
</tr>

		<tr>
			<td></td>
			<td><input type="submit" id="login_button" class="hoverable_button" name="submit_149" value="Confirm and Deactive"></td>
		</tr>
	</table>
</form>
</div>
</div>
<style>

.text_part {
  float: left;
  margin-top: 20px;
  background: #eee;
}
.text_part div {
  text-align: left !important;
}
.form_part{
  float: left;
  width: 56%;
}
@media (max-width:620px){
  .text_part {
    width: 35%;
    padding: 0px;
  }
  .text_part div{
    font-size: 12px;
    padding: 10px 2px;
    border-bottom: 1px solid #ccc;
  }
  .form_part{
    width: 64%;
    height: 450px;
  }
  .form_part form td{
    padding: 10px 2px;
    font-size: 10px
  }
  .form_part form td input{
    font-size: 12px;
  }
}
.header_title {
  cursor: pointer;
  padding: 10px
}
.header_title:hover {
  color: skyblue;
}
.admit_form:not(:first-of-type){
 	display: none;
}
.set_up_image {
  transition: .4s;
  color: transparent;
}
.free_come {
  background:url(../image/image.gif) 0 0 / 100%;
}
.free_come:hover {
  filter:brightness(1200%);
  background: url(../image/image.gif) 0 0 / 100% orangered;
}
.set_up_image:hover {
  filter:brightness(110%);
}
.admit_form input[type=file]{
  visibility: hidden;
}
#p0 tr {
  height: 150px;
  position: relative;
}
.sset {
  display: block;
  height: 130px;
  width: 130px;
  position: absolute;
  margin-top: -60px;
  overflow: hidden;
  right: 10vw;
}
.sset:before {
  transition: .4s;
}
.sset:hover:before {
  content: 'Edit';
  background: rgba(255,0,10,.8);
  width: 95%;
  position: absolute;
  z-index: 100;
  height: 95%;
  color: blue;
  font: 20px arial;
  line-height: 130px;
  text-shadow: 1px 1px 1px white;
  cursor: pointer;
}
</style>
<script>
$(document).ready(function() {
	$(".header_title").click(function() {
		var ids = $(this).attr("data-opens");
		$(".admit_form").slideUp(500);
		$("#"+ids).slideDown('slow');
	});
});
</script>