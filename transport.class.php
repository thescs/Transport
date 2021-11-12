<?php
	
	class Transport
	{
		private $troll_uri	= "http://194.28.84.113/troll/trol.json";
		private $tram_uri	= "http://194.28.84.113/tram/tram.json";
		private $tram;
		private $trol;
		
		public function __construct(){
			$this->tram = file_get_contents($this->tram_uri);
			$this->trol = file_get_contents($this->troll_uri);
		}
		
		private function removeBOM($data) {
			if (0 === strpos(bin2hex($data), 'efbbbf')) {
			return substr($data, 3);
			}
			return $data;
		}
		
		public function getTrol($object = false){
			return json_decode($this->removeBOM($this->trol), $object);
		}
		
		public function getTram($object = false){
			return json_decode($this->removeBOM($this->tram), $object);
		}
		
		// https://stackoverflow.com/questions/27928/calculate-distance-between-two-latitude-longitude-points-haversine-formula?page=1&tab=votes#tab-top
		private	function distance($lat1, $lon1, $lat2, $lon2) {
			$pi80 = M_PI / 180;
			$lat1 *= $pi80;
			$lon1 *= $pi80;
			$lat2 *= $pi80;
			$lon2 *= $pi80;
		
			$r = 6372.797; // mean radius of Earth in km
			$dlat = $lat2 - $lat1;
			$dlon = $lon2 - $lon1;
			$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
			$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
			$km = $r * $c;
			
			return $km;
		}
		
		public function getTransport($route = null, $coordinates = null, $type = "trol", $active = false, $bortnum = null){
			if(empty($this->$type)) return "Error: type '$type' passed is empty";
			$data = json_decode($this->removeBOM($this->$type));
			if(($route != null) || ($active) || ($bortnum != null))
			{
				$output = [];
				foreach ($data->positions as $line){
					//if(!empty($route) && $route == $line->number) print_r($line);
					if(!empty($route) && $route == $line->number)
					{
						if(!empty($coordinates))
						{
							$diff = $this->distance($coordinates['lat'], $coordinates['lon'], $line->lat, $line->lng);
							//var_dump($diff);
							$line->difference = $diff;
						}
						array_push($output, $line);
					}
				}
				return (object)$output;
			}
			else
			{		
				if (!empty($coordinates))
				{
					$output = [];
					foreach ($data->positions as $record)
					{
							$diff = $this->distance($coordinates['lat'], $coordinates['lon'], $record->lat, $record->lng);
							$record->difference = $diff;
							array_push($output, $record);
					}
					return (object)$output;
				}
				else
				return $data;
		}
	}
}