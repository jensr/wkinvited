<?php
include('db.php');
include('parsenmea.php');

$db = new DataBase();


if(isset($_GET['param'])&&isset($_GET['sid'])) {

$senor = $_GET['param'];	
$sensorid = $_GET['sid'];

	
$db -> query("SELECT TOP 1 parameter06 AS 'Mval' FROM device_parameters_generic WHERE parameter03=:sensorname AND parameter04=:pid ORDER BY 'db creation time' DESC");
$db -> bind(":sensorname", $sensor);
$db -> bind(":pid", $sensorid);
$db -> execute();

$nmea = $db -> single();

echo $nmea['Mval'];



} else {
	echo '<p>No parameter selected</p>';
}