<?php
$mysql_host = "127.0.0.1";
$mysql_login = "root";
$mysql_password = "";
$database_name = "weather";

// Create the database connection
$conn = new mysqli($mysql_host, $mysql_login, $mysql_password, $database_name);
// Check that database connection
if ($conn->connect_error) {
    die("The database connection has failed: " . $conn->connect_error);
}

// really an old school way to do this, but honestly I really enjoyed it :)

$sql = "CREATE TABLE WeatherData (
  id INT(10) AUTO_INCREMENT PRIMARY KEY,
  API_Response INT(10) NOT NULL,
  City_ID INT(10) NOT NULL,
  City_Name VARCHAR(40),
  Country_Name VARCHAR(30),
  General_Conditions VARCHAR(40),
  Atmospheric_Pressure INT(10),
  Temp_Farenheit INT(10),
  Wind_Speed INT(10),
  Wind_Direction VARCHAR(10),
  Humidity INT(10),
  UTC VARCHAR(60)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table WeatherData created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
