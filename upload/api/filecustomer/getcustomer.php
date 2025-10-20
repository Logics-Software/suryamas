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

// Get customer(s)
$response = $filecustomer->getcustomer();

// Output JSON response
echo json_encode($response);