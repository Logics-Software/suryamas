<?php

include_once '../../config/Database.php';
include_once '../../models/HeaderPenjualan.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$headerpenjualan = new HeaderPenjualan($db);

// Get customer(s)
$response = $headerpenjualan->getheaderpenjualan();

// Output JSON response
echo json_encode($response);