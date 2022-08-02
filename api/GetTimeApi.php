<?php
	
		header('Access-Control-Allow-Origin: *');
  		header('Content-Type: application/json');

		include_once '../config/Database.php';
		include_once '../model/GetTime.php';

		$database = new Database();
		$db = $database->connection();

		$time = new GetTime($db);

		$time->id = isset($_GET['id']) ? $_GET['id'] : die();
		
		$time->date = isset($_GET['date']) ? $_GET['date'] : die();

		$time->day = isset($_GET['day']) ? $_GET['day'] : die();

		$time->time_slot = isset($_GET['slot']) ? $_GET['slot'] : die();

		$result = $time->getTime();

		$num = $result->rowCount();


		$time_arr = array();
		if($num>0){
			$result = $time->checkTime();
			$num = $result->rowCount();

			if($num>0){
				$i = 0;
				while($row = $result->fetch(PDO::FETCH_ASSOC)){
					$time_arr[$i] = $row['time'];
					$i++;	
				}

				$time_items = array('items'=>$time_arr);
				echo json_encode($time_items);
				
			}else{
				echo json_encode(
      				array('message' => 'No Time Available')
    			);

			}

			
		}else{
			$result = $time->noPTime();
			$num = $result->rowCount();

			if($num>0){
				$i = 0;
				while($row = $result->fetch(PDO::FETCH_ASSOC)){
					$time_arr[$i] = $row['time'];
					$i++;	
				}
				$time_items = array('items'=>$time_arr);
				echo json_encode($time_items);
				
			}else{
				echo json_encode(
      				array('message' => 'No Time Available')
    			);

			}
			
		}
