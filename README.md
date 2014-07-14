# README #

This is a PHP script which utilizes the NOAA API and Google Charts to get the tides for the designated station chosen.

### What is this repository for? ###

* Get the tides from NOAA.
* Nice graph using Google Charts.

### How do I get set up? ###

* Get your station by visiting here and getting their unique ID: http://tidesandcurrents.noaa.gov/tide_predictions.html
* By default you can get today's tide.  You can also customize it to to do a date range.  Just change the paramaters in the URL for $tidedata.  The API documentation is located here: http://co-ops.nos.noaa.gov/api/
* Drop the file on your web server and visit the URL.