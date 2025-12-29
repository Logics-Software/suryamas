<?php

include_once '../../config/Database.php';
include_once '../../models/HeaderFakturKembali.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$headerfakturkembali = new HeaderFakturKembali($db);

// Get customer(s)
$response = $headerfakturkembali->getheaderfakturkembali();

// Output JSON response
echo json_encode($response);