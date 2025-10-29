<?php

include_once '../../config/Database.php';
include_once '../../models/DetailTerimadistribusi.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate FileCustomer object
$detailterimadistribusi = new DetailTerimaDistribusi($db);

$nopenerimaan = isset($_GET['nopenerimaan']) ? $_GET['nopenerimaan'] : null;

// Get customer(s)
$response = $detailterimadistribusi->getdetaildetaildistribusi($nopenerimaan);

// Output JSON response
echo json_encode($response);