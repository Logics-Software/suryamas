<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/TabelPabrik.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $tabelpabrik = new TabelPabrik($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $tabelpabrik->kodepabrik = $data->kodepabrik;
  
  // Delete post
  if($tabelpabrik->delete()) {
    $response = [
        'status' => 200,
        'inserted' => "$success"
    ];
    echo json_encode($response);
  } else {
    $response = [
        'status' => 400,
        'inserted' => "$success"
    ];
    echo json_encode($response);
  }