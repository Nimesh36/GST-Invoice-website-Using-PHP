<?php
$servername = "localhost";
$dbname = "3159572_darkcode";
$username = "root";
$password = "";
$connect = mysqli_connect($servername, $username, $password, $dbname);
if ($connect->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $query = ' SELECT id, unit_count, reading_time FROM sensor ORDER BY reading_time DESC ';
$query = '
SELECT sensors_unit_data,
UNIX_TIMESTAMP(CONCAT_WS(" ", sensors_data_date, sensors_data_time)) AS datetime
FROM tbl_sensors_data
where sensors_data_date = \'2017-08-09\'
ORDER BY sensors_data_date DESC, sensors_data_time DESC
';
$result = mysqli_query($connect, $query);
$rows = array();
$table = array();

$table['cols'] = array(
 array(
  'label' => 'Date Time',
  'type' => 'datetime'
 ),
 array(
  'label' => 'Unit',
  'type' => 'number'
 )
);

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $datetime = explode(".", $row["datetime"]);
 $sub_array[] =  array(
      "v" => 'Date(' . $datetime[0] . '000)'
     );
 $sub_array[] =  array(
      "v" => $row["sensors_unit_data"]
     );
 $rows[] =  array(
     "c" => $sub_array
    );
}
$table['rows'] = $rows;
$jsonTable = json_encode($table);

?>

<html>
 <head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart()
   {
    var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);

    var options = {
     title:'Sensors Data',
     legend:{position:'bottom'},
     chartArea:{width:'95%', height:'65%'}
    };

    var chart = new google.visualization.LineChart(document.getElementById('line_chart'));

    chart.draw(data, options);
   }
  </script>
  <style>
  .page-wrapper
  {
   width:1000px;
   margin:0 auto;
  }
  </style>
 </head>
 <body>
  <div class="page-wrapper">
   <div id="line_chart" style="width: 100%; height: 500px"></div>
  </div>
 </body>
</html>
