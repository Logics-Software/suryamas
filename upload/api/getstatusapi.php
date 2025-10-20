<?php
include_once '../config/Database.php';
include_once '../models/StatusApi.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$statusapi = new StatusApi($db);
$response = $statusapi->getstatusapi($statusapi);

// Output JSON response
echo json_encode($response);