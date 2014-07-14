<html>
  <head>
  <?php
  if (!empty($_GET['station_id'])) {
	  $station_id = $_GET['station_id'];
  } else {
	  $station_id = 8443970; //BOSTON
  }
  $tidedata = "http://tidesandcurrents.noaa.gov/api/datagetter?date=today&station=".$station_id."&product=water_level&datum=mllw&units=english&time_zone=lst&application=web_services&format=xml";
  $xmlinfo = simplexml_load_file($tidedata);
  ?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time', 'Tide'],
			<?php
		    foreach ($xmlinfo as $items) {
  			foreach ($items as $item) {
			//print_r($item); 
			$tidequery = "['".$item['t']."', ".$item['v']."],"; 
			echo $tidequery;
  			}
 			}
			?>
          
        ]);

        var options = {
          title: 'Current Tides'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  <title>NOAA Tide Graph PHP</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="description" content="A NOAA Tide Graph using the Google Charts and PHP.  Written by George Whitcher.">
  <meta name="keywords" content="NOAA, tide graph, php, open source, google charts, george whitcher">
  <style type="text/css">
  body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 14px;
	}
  h1 {
	  width: 900px;
	  text-align: center;
  }
  #chart_div {
	  width: 900px;
	  height: 500px;
  }
  #form_div {
	  width: 900px;
	  text-align: center;
  }
  </style>
  </head>  
<body>
  <h1>NOAA Tide Graph PHP</h1>
  <?php if (!empty($_GET['submit'])) { ?>
  <div id="chart_div"></div>  
  <?php } else { ?>
  <div id="form_div">
<form action="" method="get">
  <strong>Station ID:</strong> <input name="Station ID:" type="text" value="8443970">
  <input name="submit" type="submit" value="Submit">
  <br><br>
  <small>Don't know the Station ID?  Find it <a href="http://tidesandcurrents.noaa.gov/tide_predictions.html" target="_blank">here</a>.</small>
</form>
</div>
  <?php } ?>
  </body>
</html>