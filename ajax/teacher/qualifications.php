<?php 
include '../extra/db.extra.php';
?>
<script>
function qualify_me()
{
$(".quali_fy<?php echo $r = sha1(rand()) ?>").dialog({
    open: true,
    modal: true,
    title: "Qualifications",
    buttons:{
        "ok":function(){
$("#loader").fadeIn(10);
$("#loader .text").html("Prepareing Your Exam");
 $(this).dialog("close");
setTimeout(function(){
    var cls = $("#class<?php echo $r ?>").val();
    var sbj = $("#sbj<?php echo $r ?>").val();
get_qualify_page(cls,sbj);
},1000);
        },
        "close":function(){
            $(this).dialog("close");
        }
    }
});
}
function open_loader(data)
{
    $("#loader").fadeIn(10);
$("#loader .text").html(data);
}
function get_qualify_page(lass,sub)
{
    $.ajax({
        url: '<?php get_domain("/ajax/teacher/my_exam.php") ?>',
        type: 'GET',
        data: {class: lass, subject: sub},
    })
    .done(function(data) {
        $(".exam_time").html(data);
$("#loader").fadeOut(100);
    });
    
    $(".my_qualification").hide();
}
</script>

<div class="container">
    <div class="area_box" style="max-width: 800px; margin: 1% auto;">
        <div class="exam_time"></div>
       <div class="my_qualification">
<?php 
session_start();
$user = user_detail("user_name");
$aa = user_detail("rating");
echo "<h3>Avarage Accuracy (AA): ".color(arial($aa)."%","#20b99d")."</h3>";
?>
<?php 
$sql = "SELECT * FROM teachers_qualifications WHERE user='$user' AND qualify=1 ORDER BY score DESC";
$m = mysqli_query($db,$sql);

?>
<h3>Qualified Subjects: <?php echo color(arial(mysqli_num_rows($m)),"#20b99d") ?></h3>
<?php
if (mysqli_num_rows($m)==0) {
    echo "<p style='color: blue'>".$user." hasn't been qualified yet.</p>";
}

$sql = "SELECT * FROM teachers_qualifications WHERE user='$user' GROUP BY class,subject ORDER BY score DESC";
$m = mysqli_query($db,$sql);
?>
<br><br>

<table class="func_table" style="width: 100%; border: 1px solid green">
    <tr>
        <th>Class</th>
        <th>Subject</th>
        <th>Score</th>
        <th>Accuracy</th>
        <th>Qualification Status</th>
        <th>Options</th>
    </tr>
<?php

while ($row = mysqli_fetch_array($m)) {
$classt= $row['class'];
$subjectt= $row['subject'];
$sql = "SELECT * FROM teachers_qualifications WHERE user='$user' AND class='$classt' AND subject='$subjectt' ORDER BY ((score*100)/total) DESC";
$p = mysqli_query($db,$sql);
$row = mysqli_fetch_array($p);
?>
<tr>
    <td><?php if($row['class']==9){echo "9-10";}else if($row['class']==11){echo "11-12";} else { echo $row['class'];} ?></td>
    <td><?php echo $row['subject'] ?></td>
    <td style="font-family: arial;"><?php echo color(number_format($row['score'],2),"#20b99d"); ?> out of <?php echo $row['total'] ?></td>
    <td style="font-family: arial;"><?php echo color(number_format((($row['score'])*100)/($row['total']),2)."%","#20b99d") ?></td>
    <td>
        <?php 
if ($row['qualify']==1) {
    echo color("Qualified","green");
} else {
    echo color("Disqualified","red");
}
        ?>
    </td>
    <td>
<a class="cd_button" href="javascript:void(0)" onclick="qualify_me(); select_subject('<?php echo $classt ?>','<?php echo $subjectt ?>');" style="padding: 10px; text-decoration: none; background: #00CF05; color: black !important;box-shadow:2px 2px 2px #ccc; border-radius: 10px">Test Again</a>
    </td>
</tr>
<?php
}
if (mysqli_num_rows($m)!=0) {
?>
</table>
<?php } ?>
<br>
<br>
<script>
function select_subject(cl,sb) {
$("#class<?php echo $r ?>").val(cl);
get_subject('sbj<?php echo $r ?>',cl);
setTimeout(function(){
$("#sbj<?php echo $r ?>").val(sb);
},10);
}
</script>
<a href="javascript:void(0)" class="cd_button" onclick="qualify_me();" style="text-decoration: none; padding: 10px; display: inline-block;">Add Qualification</a>

<div class="quali_fy<?php echo $r ?>" style="display: none;">
<div class="my_for">
    <script>
function get_subject(id,clas)
{
    $.ajax({
        url: '<?php get_domain("/ajax/teacher/subject.php") ?>',
        type: 'GET',
        data: {class: clas},
    })
    .done(function(data) {
        $("#sbj<?php echo $r ?>").html(data);
    });
}
</script>
<p style="color: green;">For participating in the exam of the same subject, the maximum accuracy will be considered.</p><br>
<label for="class">Select Class</label>
<select name="class" id="class<?php echo $r ?>" onchange="get_subject('sbj<?php echo $r ?>',this.value)" style="padding: 10px 6px; width: 95%">
<option value="">--Select--</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9-10</option>
<option value="11">11-12</option>
</select>
<label for="sbj">Select Subject</label>
<select name="sbj" id="sbj<?php echo $r ?>" style="padding: 10px 6px; width: 95%">
    <option value="">--Select Class First--</option>
</select>
</div>
</div>
       </div>
    </div>
</div>
