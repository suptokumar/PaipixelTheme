<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 370px;
  max-width: 100%;
  font-family: cursive;

}
g[aria-labelledby="id-66-title"]{
	display: none;
}

</style>
<br>
<h2 style="text-align: center; font-family: cursive;">Ratings Chart</h2>
<br>
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

// Add data
chart.data = [
<?php 
include 'ajax/db_back.php';
include 'functions.php';
session_start();
$user = $_GET["user"];
$sql = "SELECT * FROM rating_board WHERE user='$user'";
$q = mysqli_query($db,$sql);
while ($row=mysqli_fetch_array($q)) {
  ?>
{
"date": "<?php echo $row['date'] ?>",
"value": <?php echo $row['now_rating'] ?>,
"pre": "<?php echo $row['pre_rating'] ?>",
"develop": <?php echo ($row['now_rating'])-(int_rate($row['pre_rating'])) ?>
},

<?php
}
?>


];

// Set input format for the dates
chart.dateFormatter.inputDateFormat = "hh:mm:ss a, d MMMM";
// dateAxis.tooltipDateFormat = "HH:mm, d MMMM";
// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
var series = chart.series.push(new am4charts.LineSeries());
series.dataFields.valueY = "value";
series.dataFields.dateX = "date";
series.tooltipText = "{value}"
series.strokeWidth = 2;
series.minBulletDistance = 15;

// Drop-shaped tooltips
series.tooltipHTML = `<center style='color: white'><strong>{date}</strong></center>
<hr />
<table style="color: snow">
<tr>
  <th align="left">Rating</th>
  <td style='padding: 5px'>{value}</td>
</tr>
<tr>
  <th align="left">Pre Rating</th>
  <td style='padding: 5px'>{pre}</td>
</tr>
<tr>
  <th align="left">Rating Change</th>
  <td style='padding: 5px'>{develop}</td>
</tr>
</table>
<hr />`;

// Make bullets grow on hover
var bullet = series.bullets.push(new am4charts.CircleBullet());
bullet.circle.strokeWidth = 2;
bullet.circle.radius = 4;
bullet.circle.fill = am4core.color("#fff");

var bullethover = bullet.states.create("hover");
bullethover.properties.scale = 1.3;

// Make a panning cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "panXY";
chart.cursor.xAxis = dateAxis;
chart.cursor.snapToSeries = series;

// Create vertical scrollbar and place it before the value axis
chart.scrollbarY = new am4core.Scrollbar();
chart.scrollbarY.parent = chart.leftAxesContainer;
chart.scrollbarY.toBack();

// Create a horizontal scrollbar with previe and place it underneath the date axis
chart.scrollbarX = new am4charts.XYChartScrollbar();
chart.scrollbarX.series.push(series);
chart.scrollbarX.parent = chart.bottomAxesContainer;

dateAxis.start = 0;
dateAxis.keepSelection = true;


}); // end am4core.ready()
</script>

<!-- HTML -->
<div id="chartdiv"></div>