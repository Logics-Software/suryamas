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
    $tabelpabrik->kodepabrik = isset($data->kodepabrik) ? urldecode($data->kodepabrik) : null;
    $tabelpabrik->delete();

    //insert data
    $tabelpabrik->kodepabrik = isset($data->kodepabrik) ? urldecode($data->kodepabrik) : null;
    $tabelpabrik->namapabrik = isset($data->namapabrik) ? urldecode($data->namapabrik) : null;
    $tabelpabrik->inisialkodebarang = isset($data->inisialkodebarang) ? urldecode($data->inisialkodebarang) : null;
    $tabelpabrik->status = isset($data->status) ? urldecode($data->status) : null;
    $tabelpabrik->kodeif = isset($data->kodeif) ? urldecode($data->kodeif) : null;
    if ($tabelpabrik->create()) {
        $success++;
    } else {
        $fail++;
    }
} else {
    foreach ($data as $item) {
        //delete data
        $tabelpabrik->kodepabrik = isset($item->kodepabrik) ? urldecode($item->kodepabrik) : null;
        $tabelpabrik->delete();

        //insert data
        $tabelpabrik->kodepabrik = isset($item->kodepabrik) ? urldecode($item->kodepabrik) : null;
        $tabelpabrik->namapabrik = isset($item->namapabrik) ? urldecode($item->namapabrik) : null;
        $tabelpabrik->inisialkodebarang = isset($item->inisialkodebarang) ? urldecode($item->inisialkodebarang) : null;
        $tabelpabrik->status = isset($item->status) ? urldecode($item->status) : null;
        $tabelpabrik->kodeif = isset($item->kodeif) ? urldecode($item->kodeif) : null;
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