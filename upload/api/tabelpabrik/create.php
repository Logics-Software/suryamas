<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/TabelPabrik.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$tabelpabrik = new TabelPabrik($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$success = 0;
$fail = 0;
if (!is_array($data)) {
    //delete data
    $tabelpabrik->kodepabrik = $data->kodepabrik;
    $tabelpabrik->delete();

    //insert data
    $tabelpabrik->kodepabrik = $data->kodepabrik;
    $tabelpabrik->namapabrik = $data->namapabrik;
    $tabelpabrik->inisialkodebarang = $data->inisialkodebarang;
    $tabelpabrik->status = $data->status;
    $tabelpabrik->kodeif = $data->kodeif;
    if ($tabelpabrik->create()) {
        $success++;
    } else {
        $fail++;
    }
} else {
    foreach ($data as $item) {
        //delete data
        $tabelpabrik->kodepabrik = $item->kodepabrik;
        $tabelpabrik->delete();

        //insert data
        $tabelpabrik->kodepabrik = $item->kodepabrik;
        $tabelpabrik->namapabrik = $item->namapabrik;
        $tabelpabrik->inisialkodebarang = $item->inisialkodebarang;
        $tabelpabrik->status = $item->status;
        $tabelpabrik->kodeif = $item->kodeif;
        if ($tabelpabrik->create()) {
            $success++;
        } else {
            $fail++;
        }
    }
}
$response = [
    'status' => $fail === 0 ? 200 : 207,
    'inserted' => "$success",
    'failed' => "$fail",
    'message' => "Inserted: $success, Failed: $fail"
];
echo json_encode($response);