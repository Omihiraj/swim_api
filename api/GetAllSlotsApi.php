<?php
	
		header('Access-Control-Allow-Origin: *');
  		header('Content-Type: application/json');

		include_once '../config/Database.php';
		include_once '../model/GetSlots.php';

		$database = new Database();
		$db = $database->connection();

		$slot = new GetSlots($db);

		$slot->id = isset($_GET['id']) ? $_GET['id'] : die();
		
		$dayName = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
		
		$post_arr = array();
		$post_arr['data'] = array();

		for($k=0; $k<7;$k++){
			$result = $slot->getAllTimeSlots($dayName[$k]);

			$num = $result->rowCount();

			if($num>0){
				
				$time_slots = array();
				$duration = array();

				$i = 0;
			
				while($row = $result->fetch(PDO::FETCH_ASSOC)){
					$duration[$i] = $row['duration'];
					$time_slots[$i] = $row['time_slot'];
					$i++;
				
				}

				$slot_item = array(
					'day'=>$dayName[$k],
					'time_slot'=>$time_slots,
					'duration'=>$duration
				);

				array_push($post_arr['data'], $slot_item);

			}
		}
		
		echo json_encode($post_arr['data']);
			
	

			
			
			

		
	