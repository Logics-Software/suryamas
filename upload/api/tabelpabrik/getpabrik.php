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

// Get customer(s)
$response = $tabelpabrik->getpabrik();

// Output JSON response
echo json_encode($response);