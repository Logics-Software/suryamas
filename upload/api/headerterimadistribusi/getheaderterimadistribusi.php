<?php

include_once '../../config/Database.php';
include_once '../../models/HeaderTerimaDistribusi.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$headerterimadistribusi = new HeaderTerimaDistribusi($db);

$kodekirim = isset($_GET['kodekirim']) ? $_GET['kodekirim'] : null;

// Get customer(s)
$response = $headerterimadistribusi->getheaderterimadistribusi($kodekirim);

// Output JSON response
echo json_encode($response);