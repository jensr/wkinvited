<?php
include('db.php');
include('parsenmea.php');

$db = new DataBase();


if(isset($_GET['param'])) {

$senor = $_GET['param'];	
	
$db -> query("SELECT TOP 1 FROM tblNMEA WHERE fldnmea::text ~* ");
$db -> bind(":sensor", $sensor);
$db -> execute();

$nmea = $db -> single();
$parser = new NMEAParser();
$newline = $parser -> parseLine($nmea);
echo json_encode($newline);



} else {
	echo '<p>No parameter selected</p>';
}