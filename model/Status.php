<?php 
 class Status{

 	private $conn;
	private $table = "booking";
	

	public $id;
	public $status;
		

	public function __construct($connection){
		$this->conn = $connection;
	}

	public function updateStatus(){
		$query  = "UPDATE $this->table SET status = '$this->status' WHERE booking_id = '$this->id'";
		$stmt 	= $this->conn->prepare($query);
       	$stmt->execute();
		return $stmt;
	}
 }