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
  </head>
  <body>
  <?php if (!empty($_GET['submit'])) { ?>
  <div id="chart_div" style="width: 900px; height: 500px;"></div>  
  <?php } else { ?>
  <form action="" method="get">
  <strong>Station ID:</strong> <input name="Station ID:" type="text" value="8443970">
  <input name="submit" type="submit" value="Submit">
  </form>
  <?php } ?>
  </body>
</html>