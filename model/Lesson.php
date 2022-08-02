<?php 
	
	class Lesson{
		private $conn;
		private $table = "lesson";

		public function __construct($connection){
			$this->conn = $connection;
		}

		public function getLesson(){
			$query  = "SELECT * FROM $this->table";
			$stmt 	= $this->conn->prepare($query);
       		$stmt->execute();
			return $stmt;
		}
	}