<?php
	class Trainer{
		private $conn;
		private $table = "trainer";

		public function __construct($connection){
			$this->conn = $connection;
		}

		public function getTrainer(){
			$query  = "SELECT * FROM $this->table";
			$stmt 	= $this->conn->prepare($query);
       		$stmt->execute();
			return $stmt;
		}
	}