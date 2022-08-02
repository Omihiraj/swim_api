<?php
	
		header('Access-Control-Allow-Origin: *');
  		header('Content-Type: application/json');

		include_once '../config/Database.php';
		include_once '../model/GetSlots.php';

		$database = new Database();
		$db = $database->connection();

		$slot = new GetSlots($db);

		$slot->id = isset($_GET['id']) ? $_GET['id'] : die();
		
		$slot->day = isset($_GET['day']) ? $_GET['day'] : die();

		$result = $slot->getTimeSlots();

		$num = $result->rowCount();


		

		if($num>0){
			$slot_arr = array();
			$post_arr['data'] = array();
			$i = 0;
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				
				$slot_arr[$i]=$row['time_slot'];
				$i++;
			}

			$slot_item = array(
				'timeslots'=>$slot_arr	
			);
			//array_push($post_arr['data'], $slot_item);
			echo json_encode($slot_item);
		}else{
			echo json_encode(
      			array('message' => 'No Posts Found')
    		);
		}
	