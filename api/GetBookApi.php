<?php
	
		header('Access-Control-Allow-Origin: *');
  		header('Content-Type: application/json');

		include_once '../config/Database.php';
		include_once '../model/Booking.php';

		$database = new Database();
		$db = $database->connection();

		$book = new Booking($db);

		$book->trainerId = isset($_GET['id']) ? $_GET['id'] : die();
		
		$result = $book->getBook();

		$num = $result->rowCount();

		if($num>0){
			$post_arr = array();
			$post_arr['data'] = array();

			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				extract($row);

				$book_item = array(
					'booking_id'=>$booking_id,
					'trainer_id'=>$trainer_id,
					'trainee_name'=>$trainee_name,
					'trainee_address'=>$trainee_address,
					'trainee_img'=>$trainee_img,
					'trainee_mobile'=>$mobile_no,
					'pool_name'=>$pool_name,
					'own_pool'=>$own_pool,
					'lesson_name'=>$lesson_name,
					'date'=>$date,
					'time'=>$time,
					'status'=>$status
				);
				array_push($post_arr['data'], $book_item);
			}
			
			echo json_encode($post_arr['data']);
		}else{
			echo json_encode(
      			array('message' => 'No Booking Found')
    		);
		}
	