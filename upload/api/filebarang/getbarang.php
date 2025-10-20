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

// Get customer(s)
$response = $filebarang->getbarang();

// Output JSON response
echo json_encode($response);