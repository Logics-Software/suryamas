<?php

include_once '../../config/Database.php';
include_once '../../models/FileCustomerApoteker.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$filecustomerapoteker = new FileCustomerApoteker($db);

// Get customer(s)
$kodecustomer = isset($_GET['kodecustomer']) ? $_GET['kodecustomer'] : null;
$response = $filecustomerapoteker->getcustomer($kodecustomer);

// Output JSON response
echo json_encode($response);