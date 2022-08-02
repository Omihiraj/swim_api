<?php 
	class Booking{

		private $conn;
		private $table = "booking";
		private $table2 = "lesson";
		private $table3 = "pool";
		private $table4 = "trainee";

		public $trainerId;
		public $traineeId;
		public $poolId;
		public $ownPool;
		public $lessonId;
		public $date;
		public $timeSlot;
		public $time;


		public function __construct($db) {
      		$this->conn = $db;
    	}


    	public function sendBook() {
    		// Create query
          	$query = 'INSERT INTO ' . $this->table . ' SET trainer_id = :trainer_id, trainee_id = :trainee_id, pool_id = :pool_id, own_pool = :own_pool, lesson_id = :lesson_id, date = :date, time_slot = :time_slot,time = :time';

          	// Prepare statement
          	$stmt = $this->conn->prepare($query);

          	// Clean data
          	$this->trainerId = htmlspecialchars(strip_tags($this->trainerId));
          	$this->traineeId = htmlspecialchars(strip_tags($this->traineeId));
          	$this->poolId = htmlspecialchars(strip_tags($this->poolId));
          	$this->ownPool = htmlspecialchars(strip_tags($this->ownPool));
          	$this->lessonId = htmlspecialchars(strip_tags($this->lessonId));
          	$this->date = htmlspecialchars(strip_tags($this->date));
          	$this->timeSlot = htmlspecialchars(strip_tags($this->timeSlot));
          	$this->time = htmlspecialchars(strip_tags($this->time));


          	// Bind data
          	$stmt->bindParam(':trainer_id', $this->trainerId);
          	$stmt->bindParam(':trainee_id', $this->traineeId);
          	$stmt->bindParam(':pool_id', $this->poolId);
          	$stmt->bindParam(':own_pool', $this->ownPool);
          	$stmt->bindParam(':lesson_id', $this->lessonId);
          	$stmt->bindParam(':date', $this->date);
          	$stmt->bindParam(':time_slot', $this->timeSlot);
          	$stmt->bindParam(':time', $this->time);

          	// Execute query
          	if($stmt->execute()) {
            	return true;
      		}
      	}

      	public function getBook(){
			$query  = "SELECT   
								$this->table.booking_id,
								$this->table.trainer_id,
								$this->table.own_pool,
								$this->table.date,
								$this->table.time,
								$this->table.status,
								$this->table2.lesson_name,
								$this->table3.pool_name,
								$this->table4.trainee_name,
								$this->table4.trainee_address,
								$this->table4.trainee_img,
								$this->table4.mobile_no
						FROM $this->table
						JOIN $this->table2 ON $this->table.lesson_id = $this->table2.lesson_id
						JOIN $this->table3 ON $this->table.pool_id = $this->table3.pool_id
						JOIN $this->table4 ON $this->table.trainee_id = $this->table4.trainee_id 
						WHERE $this->table.trainer_id = '$traineeId'";
			$stmt 	= $this->conn->prepare($query);
       		$stmt->execute();
			return $stmt;
		}
	}