<?php

include_once '../../config/Database.php';
include_once '../../models/DetailDistribusi.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$detaildistribusi = new DetailDistribusi($db);

$nodistribusi = isset($_GET['nodistribusi']) ? $_GET['nodistribusi'] : null;

// Get customer(s)
$response = $detaildistribusi->getdetaildistribusi($nodistribusi);

// Output JSON response
echo json_encode($response);