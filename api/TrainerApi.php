<?php
	
		header('Access-Control-Allow-Origin: *');
  		header('Content-Type: application/json');

		include_once '../config/Database.php';
		include_once '../model/Trainer.php';

		$database = new Database();
		$db = $database->connection();

		$trainer = new Trainer($db);

		$result = $trainer->getTrainer();

		$num = $result->rowCount();

		if($num>0){
			$post_arr = array();
			$post_arr['data'] = array();

			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				extract($row);

				$trainer_item = array(
					'id'=>$trainer_id,
					'username'=>$trainer_name,
					'email'=>$trainer_email,
					'address'=>$trainer_address,
					'availability'=>true,
					'students'=>250,
					'phonenumber'=>$mobile_no,
					'price'=>$price,
					'urlAvatar'=>$trainer_img
					
					
				);
				array_push($post_arr['data'], $trainer_item);
			}
			
			echo json_encode($post_arr['data']);
		}else{
			echo json_encode(
      			array('message' => 'No Posts Found')
    		);
		}
	