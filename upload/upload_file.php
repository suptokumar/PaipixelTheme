
<?php
    // Allowed extentions.
    $allowedExts = array("txt", "pdf", "doc");

    // Get filename.
    $temp = explode(".", $_FILES["file"]["name"]);

    // Get extension.
    $extension = end($temp);

    // Validate uploaded files.
    // Do not use $_FILES["file"]["type"] as it can be easily forged.
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

        // Generate new random name.
        $name = sha1(microtime()) . "." . $extension;

        // Save file in the uploads folder.
       if(move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . "/" . $name)){
   include '../functions.php';
$db = mysqli_connect("localhost","paipixel_supto","Sk571960","paipixel_real") OR die("no connectiong available.");
$url = return_domain("/upload/").$name;
        $question = $_POST['question'];
        $sql = "UPDATE noti_provide_ans SET full=1, answer='$url' WHERE question='$question'";
mysqli_query($db,$sql);   
$sql = "SELECT * FROM noti_provide_ans WHERE question='$question'";
$m = mysqli_query($db,$sql);
$f = mysqli_fetch_array($m);
$user = $f['owner'];
$users = $f['provider'];
$sql = "SELECT question FROM ask_teacher WHERE id='$question'";
$m = mysqli_query($db,$sql);
$rv = mysqli_fetch_array($m);
$qs = $rv[0];
$content = "Your Question's Answer is ready. <a href='".return_domain("/profile/".$users)."'><b>$users</b></a> has uploaded the answer file for <a href='".return_domain("/full_question.php?id=".$question)."'><b>".$qs."</b></a>. From the above menu click <b>Asked Question</b> to download and rate the answer.";
send_notification($user,"",$content);  
       }

    
?>