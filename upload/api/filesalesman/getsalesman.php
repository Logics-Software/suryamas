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

// Get customer(s)
$response = $filesalesman->getsalesman();

// Output JSON response
echo json_encode($response);