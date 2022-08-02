<?php
	include_once '../config/Database.php';
	class Pool{
		private $conn;
		private $table1 = "pool";
		private $table2 = "pool_image";


		public function __construct($connection){
			$this->conn = $connection;
		}


		public function getPool(){
			
			$query  = "SELECT * FROM $this->table1";
			$stmt 	= $this->conn->prepare($query);
       		$stmt->execute();
			$num = $stmt->rowCount();
			$pools_data = array();
			$pools_images = array();
			$num1;
			if($num>0){
				$j = 0;
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$pool_id = $row['pool_id'];
					$query1  = "SELECT pool_image FROM $this->table2 WHERE pool_id = '$pool_id'";
					$stmt1 	= $this->conn->prepare($query1);
       				$stmt1->execute();
       				$num1 = $stmt1->rowCount();

       				if($num1>0){
						$i = 0;
						while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
							$pools_images[$i] = $row1['pool_image'];
							$i++;
						}

					}
					$pools_data[$j] = array($row,$pools_images);

					$j++;
				}
			}
			return $pools_data;
			
		}
		
	}