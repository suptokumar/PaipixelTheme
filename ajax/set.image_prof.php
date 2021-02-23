<?php include 'db.php'; 
$user = $_POST['user'];
$profile='';
$cover='';
$sql = "SELECT * FROM user WHERE user_name='$user'";
$mysqli_query = mysqli_query($db,$sql);
$row = mysqli_fetch_array($mysqli_query);
$image_photo= $row['image'];
$cover_photo= $row['background'];
if (isset($_FILES["profile"]) && !empty($_FILES["profile"]["name"])) {
	
$target_dir = "../content/";
$target_file = $target_dir . rand() . basename($_FILES["profile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["profile"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, Image already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["profile"]["size"] > 2500000) {
  echo "Sorry, your Profile Image is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
    $profile = $target_file;
  } else {
    echo "Sorry, there was an error uploading Profile Image.";
    $profile = 'image/user.PNG';
    array_map( "unlink", glob($image_photo ) );

  }
}

} else{
	$profile = '1';
}




// Upload The Cover Photo
if (isset($_FILES["cover"]) && !empty($_FILES["cover"]["name"])) {
$target_dir = "../content/";

$target_file = $target_dir . rand() . basename($_FILES["cover"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["cover"]["tmp_name"]);
  if($check !== false) {
    echo "Cover Photo is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "Cover Photo is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, Image already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["cover"]["size"] > 2500000) {
  echo "Sorry, Your Cover Photo is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed (Cover Photo).";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
    $cover = $target_file;
    array_map( "unlink", glob($cover_photo ) );
  } else {
    echo "Sorry, there was an error uploading Cover Photo.";
    $cover = '';
  }
}
} else {
	$cover=1;
}










if ($cover==1 && $profile==1) {
	echo "1";
} else {
echo "
Change Saved";
if ($cover!=1) {
$sql = "UPDATE user SET background='$cover' WHERE user_name='$user'";
if (mysqli_query($db,$sql)) {
	echo ".";
}

}
if ($profile!=1) {
$sql = "UPDATE user SET image='$profile' WHERE user_name='$user'";
if (mysqli_query($db,$sql)) {
	echo "!";
}
}
}



?>

