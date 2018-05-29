<?php 

function chartme( $yparam, $title, $dataurl, $interval, $min=0, $max=100, $canvas, $w,$h, $col, $dur) {
	echo '<h3>'.$title.'</h3>';
	#calculate the miliseconds per pixel to cover the target duration (expressed in minutes)
	$mpp = ($dur*60000)/$w;
	echo '<canvas id="'.$canvas.'" width="'.$w.'" height="'.$h.'"></canvas>';
	echo '<script>';
	echo 'var '.$yparam.'= new SmoothieChart({millisPerPixel:'.$mpp.', minValue:'.$min.', maxValue:'.$max.'});';
	echo $yparam.'.streamTo(document.getElementById("'.$canvas.'"),1000);';
	echo 'var ds'.$yparam.'= new TimeSeries;';
	echo 'setInterval(function(){';
	echo '$.getJSON("'.$dataurl.'", function(data){';
	echo 'var now = new Date().getTime();';
	echo 'ds'.$yparam.'.append(now,data[1])';
	echo '});';
	echo '},'.$interval.');';
	echo $yparam.'.addTimeSeries(ds'.$yparam.', {lineWidth:2,strokeStyle:"'.$col.'"})';
	echo '</script>';	
	
}


?>