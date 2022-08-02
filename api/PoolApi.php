<?php
	
		// header('Access-Control-Allow-Origin: *');
  // 		header('Content-Type: application/json');

		include_once '../config/Database.php';
		include_once '../model/Pool.php';

		$database = new Database();
		$db = $database->connection();

		$pool = new Pool($db);

		$result = $pool->getPool();

		$post_arr = array();

		$post_arr['data'] = array();

		//echo $result;
		//echo '<pre>'; print_r($result); echo '</pre>';
		//print_r ($result[0][1]);
		
		if($result != null){

			for($i = 0; $i < count($result); $i++){
				$pool_item = array(
					'id'=>$result[$i][0]['pool_id'],
					'poolname'=>$result[$i][0]['pool_name'],
					'mainimage'=>$result[$i][0]['main_image'],
					'pooldetails'=>$result[$i][0]['pool_details'],
					'pooladdress'=>$result[$i][0]['address'],
					'gallary'=>$result[$i][1],
				);
				array_push($post_arr['data'], $pool_item);
			}

			echo json_encode($post_arr['data']);
		}else{

			echo json_encode(
      			array('message' => 'No Posts Found')
    		);

		}
		

		