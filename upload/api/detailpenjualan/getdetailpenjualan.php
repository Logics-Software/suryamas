<?php

include_once '../../config/Database.php';
include_once '../../models/DetailPenjualan.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$detailpenjualan = new DetailPenjualan($db);

$nopenjualan = isset($_GET['nopenjualan']) ? $_GET['nopenjualan'] : null;

// Get customer(s)
$response = $detailpenjualan->getdetailpenjualan($nopenjualan);

// Output JSON response
echo json_encode($response);