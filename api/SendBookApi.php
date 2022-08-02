<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/Database.php';
    include_once '../model/Booking.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connection();

  // Instantiate blog post object
  $post = new Booking($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $post->trainerId = $data->trainer_id;
  $post->traineeId = $data->trainee_id;
  $post->poolId = $data->pool_id;
  $post->ownPool = $data->own_pool;
  $post->lessonId = $data->lesson_id;
  $post->date = $data->date;
  $post->timeSlot = $data->time_slot;
  $post->time = $data->time;

  // Create post
  if($post->sendBook()) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }
