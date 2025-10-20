<?php

include_once '../../config/Database.php';
include_once '../../models/FileCustomer.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$filecustomer = new FileCustomer($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$filecustomer->kodecustomer = $data->kodecustomer;
  
// Delete post
if($filecustomer->updatestatus($kodecustomer)) {
    echo json_encode(
    array('status' => '200',
          'message' => 'Status Customer updated!')
    );
} else {
    echo json_encode(
    array('status' => '207',
          'message' => 'Update Customer failed!')
    );
}