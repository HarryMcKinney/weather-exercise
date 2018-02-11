<?php

$city = $_GET['city'];
//echo $city;

include('config.php');

$api = file_get_contents("http://api.openweathermap.org/data/2.5/forecast?id=" . $city . "&APPID=" . $app_id);
$data = json_decode($api, true);

//lets make sure the api is returning data
//print_r($data);

//next lets check the response code from the api:
echo 'Api response: ' . $data['cod'] . '<br>';

echo '<div style="height:40px;"></div>';

//The actual data I need for this project is:

//ZIP Code, I'll get that by accessing this:
echo 'The City ID: ' . $data['city']['id'] . '<br>';
//but for my own reference I want to add:
echo 'City: ' . $data['city']['name'] . '<br>';
//and of course:
echo 'County: ' . $data['city']['country'] . '<br>';

echo '<div style="height:40px;"></div>';

//get the general weather conditions
echo 'General weather conditions: ' . $data['list'][0]['weather'][0]['main'] . '<br>';

//get atmospheric pressure
echo 'Atmospheric Pressure is: ' . $data['list'][0]['main']['pressure'] . '<br>';

//get temp in Farenheit   //make this farenheit //the api is returning Kelvin!
$kelvin = $data['list'][0]['main']['temp'];
$f = ((($kelvin - 273.15) * 1.8) + 32);
echo 'The Current Temp in Farenheit is: ' . $f . '<br>';

//get wind, direction and the speed
echo 'The wind speed is: ' . $data['list'][0]['wind']['speed'] . '<br>';

//wind direction using cardinal directions
$deg = $data['list'][0]['wind']['deg'];

$cardinal = array(
  'N' => array(337.5, 22.5),
  'NE' => array(22.5, 67.5),
  'E' => array(67.5, 112.5),
  'SE' => array(112.5, 157.5),
  'S' => array(157.5, 202.5),
  'SW' => array(202.5, 247.5),
  'W' => array(247.5, 292.5),
  'NW' => array(292.5, 337.5)
);

foreach ($cardinal as $dir => $angles) {
  if ($deg >= $angles[0] && $bearing < $angles[1]) {
    $direction = $dir;
    break;
  }
}

echo 'The wind directions is: ' . $direction . '<br>';

//get humidity
echo 'The humidity is: ' . $data['list'][0]['main']['humidity'] . '<br>';

//timestamp in UTC
$time = time();
$check = $time+date("Z",$time);
$utc = strftime("%B %d, %Y @ %H:%M:%S UTC", $check);
echo $utc;
//End data needed for this project



// Create database connection
$conn = new mysqli($mysql_host, $mysql_login, $mysql_password, $database_name);
// Check the database connection
if ($conn->connect_error) {
    die("Yikes! The database connection has failed: " . $conn->connect_error);
}


$sql = "INSERT INTO
            WeatherData (
                  API_Response,
                  City_ID,
                  City_Name,
                  Country_Name,
                  General_Conditions,
                  Atmospheric_Pressure,
                  Temp_Farenheit,
                  Wind_Speed,
                  Wind_Direction,
                  Humidity,
                  UTC
                )
                VALUES (
                '".$data['cod']."',
                '".$data['city']['id']."',
                '".$data['city']['name']."',
                '".$data['city']['country']."',
                '".$data['list'][0]['weather'][0]['main']."',
                '".$data['list'][0]['main']['pressure']."',
                '".$f."',
                '".$data['list'][0]['wind']['speed']."',
                '".$direction."',
                '".$data['list'][0]['main']['humidity']."',
                '".$utc."'
                )";


if ($conn->query($sql) === TRUE) {
    echo "<p>New record created successfully</p>";
} else {
    echo "<p>Yikes! There has been an error: </p>" . $sql . "<br>" . $conn->error;
}
$conn->close();


?>
