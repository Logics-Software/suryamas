<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/StokBarang.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $stokbarang = new StokBarang($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $stokbarang->kodebarang = $data->kodebarang;
  
  // Delete post
  if($stokbarang->resetstok()) {
    $response=array(
      'status' => 200,
      'message' =>'Reset Stok Barang Success!'
    );
  } else {
    $response=array(
      'status' => 400,
      'message' =>'Reset Stok Barang Failed!'
    );
  }
  header('Content-Type: application/json');
  echo json_encode($response);