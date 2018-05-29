<?php
include('header.php');



#Retrieve single line from DB


#Convert NMEA string


#Add to plots

if(isset($_GET['cruise']) &&isset($_GET['haul'])){
	$cruise = $_GET['cruise'];
	$haul = $_GET['haul'];
	
	
	echo '<h2>Now logging '.$cruise.' Haul: '.$haul.'</h2>';
	
	echo '<div style="float:left; padding:0px;">';
	
	chartme('warp','Warp out ','http://localhost/wkinvited/livedata.php', 3000,0,150,'warps',400,100, "#154696", 15);
	echo '</div>';
	
	echo '<div style="float:right; padding:0px;">';
	
	chartme('Doors','Door Spread','http://localhost/wkinvited/livedata.php', 3000,0,150,'doors',400,100, "#baff3a", 15);
	echo '</div>';
	
	
	
	?>
	
	
	<div>
	<form action="index.php" method = "GET">
	<input type="hidden" name="cruise" value="<?php echo $cruise;?>">
	<input type="hidden" name="haul" value="<?php echo $haul;?>">
	<input type="hidden" name="event" value="event">
	<input type="text" name="note">
	
	<input type="submit" value="Mark Event">
	
	</form>
	</div>
	
	<div>
	<form action="index.php" method = "GET">
	
	<input type="hidden" name="event" value="stop">
	<input type="submit" value="Stop">
	
	</form>
	</div>
	
<?php 


} else {
	
	echo '<div style="float:left; padding:0px;">';
	
	chartme('warp','Warp out ','http://localhost/wkinvited/livedata.php', 1000,0,150,'warps',400,100, "#154696");
	echo '</div>';
	
	echo '<div style="float:right; padding:0px;">';
	
	chartme('Doors','Door Spread','http://localhost/wkinvited/livedata.php', 3000,0,150,'doors',400,100, "#baff3a");
	echo '</div>';
	
	
	
	?>
	<div>
	<form action="index.php" method = "GET">
	<input type="hidden" name="event" value="start">
	<input type="text" name="cruise">
	<input type="text" name="haul">
	<input type="submit" value="start">
	
	</form>
	</div>
<?php 	
}

$mydata = new NMEAParser();
$output = $mydata -> parseLine('$PSCMSM2,091626.00,A,DST,1,,4.69,15*');
print_r($output);


?>
