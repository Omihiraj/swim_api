<?php 
	
	class GetTime{
		private $conn;
		private $table1 = "booking";
		private $table2 = "trainer_time";

		public $id;
		public $date;
		public $time_slot;
		public $day;

		public function __construct($connection){
			$this->conn = $connection;
		}

		public function getTime(){
			$query  = "SELECT time FROM $this->table1 WHERE trainer_id = '$this->id' AND date = '$this->date' AND time_slot = '$this->time_slot' AND status = '1'";
			$stmt 	= $this->conn->prepare($query);
       		$stmt->execute();
			return $stmt;
		}

		public function noPTime(){
			$query  = "SELECT time FROM $this->table2 WHERE trainer_id = '$this->id' AND day = '$this->day' AND time_slot = '$this->time_slot'";
			$stmt 	= $this->conn->prepare($query);
       		$stmt->execute();
			return $stmt;
		}

		public function checkTime(){

			$query  = "SELECT time FROM $this->table2 WHERE trainer_id = '$this->id' AND day = '$this->day' AND time_slot = '$this->time_slot' AND NOT time IN (SELECT time FROM $this->table1 WHERE trainer_id = '$this->id' AND date = '$this->date' AND time_slot = '$this->time_slot' AND status = '1')";

			$stmt 	= $this->conn->prepare($query);
       		$stmt->execute();
			return $stmt;

		}
	}