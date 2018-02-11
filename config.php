<?php

/*
using cron tab I am calling on the url every 10 mintues for instance: http://localhost:8888/property-brands/index.php?city=neworleans
* /10 * * * * http://localhost:8888/property-brands/index.php?city=knoxville
for the purpose of this exercise this could also be done with a sleep command, but I didn't want the code to always be running
*/

if($city == 'knoxville'){
  $city = "4634946";
}elseif($city =='nome'){
  $city = "5870133";
}elseif($city == 'losangeles'){
  $city = "5368381";
}elseif($city == 'neworleans'){
  $city = "4335045";
}elseif($city == 'buffalo'){
  $city = "5019588";
}else{
  echo "weather data is not currently available for this area";
  exit;
}

$mysql_host = "127.0.0.1";
$mysql_login = "root";
$mysql_password = "";
$database_name = "weather";
$app_id = " "; //removed since it's on a github public repo

?>
