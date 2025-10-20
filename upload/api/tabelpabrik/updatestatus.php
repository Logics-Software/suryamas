<?php

include_once '../../config/Database.php';
include_once '../../models/TabelPabrik.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$tabelpabrik = new TabelPabrik($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$tabelpabrik->kodepabrik = $data->kodepabrik;
  
// Delete post
if($tabelpabrik->updatestatus($kodepabrik)) {
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