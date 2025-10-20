<?php

include_once '../../config/Database.php';
include_once '../../models/FileSalesman.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$filesalesman = new FileSalesman($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$filesalesman->kodesalesman = $data->kodesalesman;
  
// Delete post
if($filesalesman->updatestatus($kodesalesman)) {
    echo json_encode(
    array('status' => '200',
          'message' => 'Status Salesman updated!')
    );
} else {
    echo json_encode(
    array('status' => '207',
          'message' => 'Update Salesman failed!')
    );
}