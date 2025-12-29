<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/DetailFakturKembali.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $detailfakturkembali = new DetailFakturKembali($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $detailfakturkembali->nokembali = $data->nokembali;
  
  // Delete post
  if($detailfakturkembali->updatesp()) {
    $response=array(
      'status' => 200,
      'message' =>'Update Status Header Faktur Kembali Success!'
    );
  } else {
    $response=array(
      'status' => 400,
      'message' =>'Update Status Faktur Kembali Failed!'
    );
  }
  header('Content-Type: application/json');
  echo json_encode($response);