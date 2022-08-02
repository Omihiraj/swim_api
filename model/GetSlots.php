<?php 
	
	class GetSlots{
		private $conn;
		private $table = "trainer_time";

		public $id;
		public $day;

		public function __construct($connection){
			$this->conn = $connection;
		}

		public function getTimeSlots(){
			$query  = "SELECT DISTINCT time_slot FROM $this->table WHERE trainer_id = '$this->id' AND day = '$this->day'";
			$stmt 	= $this->conn->prepare($query);
       		$stmt->execute();
			return $stmt;
		}

		public function getAllTimeSlots($dayName){
			$query  = "SELECT DISTINCT time_slot,duration FROM $this->table WHERE trainer_id = '$this->id' AND day = '$dayName'";
			$stmt 	= $this->conn->prepare($query);
       		$stmt->execute();
			return $stmt;
		}
	}