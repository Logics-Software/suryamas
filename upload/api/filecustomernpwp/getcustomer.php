<?php

include_once '../../config/Database.php';
include_once '../../models/FileCustomerNpwp.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$filecustomernpwp = new FileCustomerNpwp($db);

// Get customer(s)
$kodecustomer = isset($_GET['kodecustomer']) ? $_GET['kodecustomer'] : null;
$response = $filecustomernpwp->getcustomer($kodecustomer);

// Output JSON response
echo json_encode($response);