<html>
  <head>
  <?php
  $tidedata = "http://tidesandcurrents.noaa.gov/api/datagetter?date=today&station=8443970&product=water_level&datum=mllw&units=english&time_zone=lst&application=web_services&format=xml";
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
          title: 'Boston Current Tides'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>