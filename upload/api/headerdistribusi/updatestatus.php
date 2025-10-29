<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/HeaderDistribusi.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $headerdistribusi = new HeaderDistribusi($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $headerdistribusi->nodistribusi = $data->nodistribusi;
  
  // Delete post
  if($headerdistribusi->updatestatus()) {
    $response=array(
      'status' => 200,
      'message' =>'Update Status Header distribusi Success!'
    );
  } else {
    $response=array(
      'status' => 400,
      'message' =>'Update Status Header distribusi Failed!'
    );
  }
  header('Content-Type: application/json');
  echo json_encode($response);