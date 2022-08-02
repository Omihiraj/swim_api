<?php
	
		header('Access-Control-Allow-Origin: *');
  		header('Content-Type: application/json');

		include_once '../config/Database.php';
		include_once '../model/Lesson.php';

		$database = new Database();
		$db = $database->connection();

		$lesson = new Lesson($db);

		$result = $lesson->getLesson();

		$num = $result->rowCount();

		if($num>0){
			$post_arr = array();
			$post_arr['data'] = array();

			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				extract($row);

				$lesson_item = array(
					'id'=>$lesson_id,
					'lessonname'=>$lesson_name,
					
				);
				array_push($post_arr['data'], $lesson_item);
			}
			
			echo json_encode($post_arr['data']);
		}else{
			echo json_encode(
      			array('message' => 'No Posts Lessons')
    		);
		}
	