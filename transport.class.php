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
		
		public function getTransport($route = null, $type = "trol", $active = false, $bortnum = null){
			if(empty($this->$type)) return "Error: type '$type' passed is empty";
			$data = json_decode($this->removeBOM($this->$type));
			if(($route != null) || ($active) || ($bortnum != null))
			{
				foreach ($data->positions as $line){
					if(!empty($route) && $route == $line->number) print_r($line);
				}
			}
				else
					var_dump($data);
		}
	}