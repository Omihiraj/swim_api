<?php
	class Database{
		private $host   = "localhost";
		private $dbname = "swim_app";
		private $user   = "root";
		private $pass   = "";

		public function connection(){
			$this->conn = null;
			try{
				$this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->pass);
				//$this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e){
				echo "Connection failed: " . $e->getMessage();
			}

			return $this->conn;
		}
	}