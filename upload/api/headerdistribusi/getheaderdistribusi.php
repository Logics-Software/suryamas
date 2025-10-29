<?php

include_once '../../config/Database.php';
include_once '../../models/HeaderDistribusi.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$headerdistribusi = new HeaderDistribusi($db);

$kodeterima = isset($_GET['kodeterima']) ? $_GET['kodeterima'] : null;

// Get customer(s)
$response = $headerdistribusi->getheaderdistribusi($kodeterima);

// Output JSON response
echo json_encode($response);