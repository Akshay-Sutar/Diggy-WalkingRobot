<?php
	
	class Robot{
	
		public $x,$y;
		public $direction;
		public $compass;
		
		function __construct( $x, $y, $direction){
			$this->x=$x;
			$this->y=$y;
			$this->direction=strtoupper($direction);
			$this->compass= new Compass();
		}//end of constructor
		
		public function getPosition(){
			return $this->x." ".$this->y." ".$this->direction;
		}
		
		public function Walk( int $steps){
			switch($this->direction){
				
				case "NORTH":
					$this->y +=$steps; 
				break;
				
				case "SOUTH":
					$this->y -=$steps; 
				break;
				
				case "EAST":
					$this->x +=$steps; 
				break;
					
				case "WEST":
					$this->x -=$steps; 
				break;
			}
		}// end of Walk()
		
		public function Rotate($dir){
				$val=null;
				if( strtoupper($dir) === "R" ){ // rotate right
					// get current direction index
					$val = $this->compass->keys[$this->direction]; // eg : 0 for NORTH
					$val = ($val + 1) % 4; // get the index of new direction. eg 1 for EAST
					$this->direction =$this->compass->values[$val]; // set current direction
				} else{ // rotate left
					// same as above , but with condition checkdate
					$val = $this->compass->keys[$this->direction];
					$val = ($val - 1);
					$this->direction = $this->compass->values[ ($val > 0)? $val : 0 ]; // if val<0, set direction to NORTH
				}
			}// end of Rotate
		
		public function Print_location(){
			echo $x." ".$y." ".$direction;
		}// end of Print_locationrint_l
	}// end of Robot
	
	class Compass{
		public $keys,$values;
		
		function __construct(){
			$this->keys = array("NORTH"=>"0","EAST"=>"1","SOUTH"=>"2","WEST"=>"3");
			$this->values =  array("0"=>"NORTH","1"=>"EAST","2"=>"SOUTH","3"=>"WEST");
		}
	
	}// end of Compass
	
	function parseInput($input){
	$result = array();

	for( $i=0 ; $i < strlen($input); ++$i){
			if(strtoupper($input[$i]) === "R" || strtoupper($input[$i]) ==="L" ){
				$result[] = strtoupper($input[$i]);
			}else if(strtoupper($input[$i]) === "W"){
				$result[] = (int)$input[++$i];
			}else
				die("Invalid Input");
		
		}
	return $result;		
	}
	
	$Diggy = new Robot($argv[1],$argv[2],$argv[3]);
	$input = parseInput((string)$argv[4]);

	foreach($input as $ip){
		if($ip ==="R" || $ip ==="L"){
			$Diggy->Rotate($ip);
		}else{
			$Diggy->Walk($ip);
		}
	}
	echo $Diggy->getPosition();
	
?>