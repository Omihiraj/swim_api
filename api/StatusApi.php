<?php
	
		header('Access-Control-Allow-Origin: *');
  		header('Content-Type: application/json');

		include_once '../config/Database.php';
		include_once '../model/Status.php';

		$database = new Database();
		$db = $database->connection();

		$state = new Status($db);

		$state->id = isset($_GET['id']) ? $_GET['id'] : die();
		
		$state->status = isset($_GET['status']) ? $_GET['status'] : die();

		
		$result = $state->updateStatus();

		if($result){
			echo json_encode(
      			array('message' => 'Success')
    		);

		}else{
			echo json_encode(
      			array('message' => 'No Success')
    		);

		}

		