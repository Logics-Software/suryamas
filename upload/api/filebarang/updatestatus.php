<?php

include_once '../../config/Database.php';
include_once '../../models/FileBarang.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$filebarang = new FileBarang($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$filebarang->kodebarang = $data->kodebarang;
  
// Delete post
if($filebarang->updatestatus($kodebarang)) {
    echo json_encode(
    array('status' => '200',
          'message' => 'Status Barang updated!')
    );
} else {
    echo json_encode(
    array('status' => '207',
          'message' => 'Update Status Barang failed!')
    );
}