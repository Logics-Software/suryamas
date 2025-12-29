<?php

include_once '../../config/Database.php';
include_once '../../models/DetailFakturKembali.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$detailfakturkembali = new DetailFakturKembali($db);

$nokembali = isset($_GET['nokembali']) ? $_GET['nokembali'] : null;

// Get customer(s)
$response = $detailfakturkembali->getdetailfakturkembali($nokembali);

// Output JSON response
echo json_encode($response);