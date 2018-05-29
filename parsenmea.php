<?php
class NMEAParser{
	
	private $nmea;
	
	function __construct(){
		$this -> nmea = array();
		
	}
	public function parseLine($line) {
		
		$this -> nmeaType = $this -> SetNmeaType($line);
		switch($this -> type) {
			case "PSCMS": 
			return $this -> scanmar($line);
			break;
			default: return;
		}
		
	}
	
	private function SetNmeaType($line) {
		$this -> type = trim(strtoupper(substr($line,1,5)));
		return $this -> type;
	}
	
	private function scanmar($datastr) {
		$chunks = explode(",", $datastr);
		$this -> nmea['time'] = $chunks[1];
		$this -> nmea['av'] = $chunks[2];
		$this -> nmea['sensor'] = $chunks[3];
		$this -> nmea['sensorName'] = $this-> sensorName($chunks[3]);
		$this -> nmea['sensorid'] = $chunks[4];
		$this -> nmea['measureid'] = $chunks[5];
		$this -> nmea['measurementValue'] = $chunks[6];
		$this -> nmea['quality'] = $chunks[7];
		
		
		return $this -> nmea;
	}
	
	
	private function sensorName($code) {
		switch($code) {
			case 'DST': $val = 'Distance'; return $val;break;
			case 'TNS': $val = 'Tenisometer';return $val; break;
			case 'TEY': $val = 'Tawl Eye'; return $val;break;
			case 'TS': $val = 'Trawl Sounder'; return $val;break;
			case 'HT': $val = 'Height'; return $val;break;
			case 'TSP': $val = 'Trawl Speed'; return $val;break;
			
		}
	}
}