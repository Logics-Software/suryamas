<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/HeaderDistribusi.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $headerdistribusi = new HeaderDistribusi($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $success = 0;
    $fail = 0;
    if (!is_array($data)) {
        //delete data
        $headerdistribusi->nodistribusi = isset($data->nodistribusi) ? urldecode($data->nodistribusi) : null;
        $headerdistribusi->delete();

        //insert data
        $headerdistribusi->nodistribusi = isset($data->nodistribusi) ? urldecode($data->nodistribusi) : null;
        $headerdistribusi->tanggaldistribusi = isset($data->tanggaldistribusi) ? urldecode($data->tanggaldistribusi) : null;
        $headerdistribusi->keterangan = isset($data->keterangan) ? urldecode($data->keterangan) : null;
        $headerdistribusi->kodegudang = isset($data->kodegudang) ? urldecode($data->kodegudang) : null;
        $headerdistribusi->kodeterima= isset($data->kodeterima) ? urldecode($data->kodeterima) : null;
        $headerdistribusi->nilaidistribusi = isset($data->nilaidistribusi) ? urldecode($data->nilaidistribusi) : null;
        $headerdistribusi->userid = isset($data->userid) ? urldecode($data->userid) : null;
        $headerdistribusi->status = isset($data->status) ? urldecode($data->status) : null;
        if ($headerdistribusi->create()) {
            $success++;
        } else {
            $fail++;
        }
    } else {
        foreach ($data as $item) {
            //delete data
            $headerdistribusi->nodistribusi = isset($item->nodistribusi) ? urldecode($item->nodistribusi) : null;
            $headerdistribusi->delete();

            //insert data
            $headerdistribusi->nodistribusi = isset($item->nodistribusi) ? urldecode($item->nodistribusi) : null;
            $headerdistribusi->tanggaldistribusi = isset($item->tanggaldistribusi) ? urldecode($item->tanggaldistribusi) : null;
            $headerdistribusi->keterangan = isset($item->keterangan) ? urldecode($item->keterangan) : null;
            $headerdistribusi->kodegudang = isset($item->kodegudang) ? urldecode($item->kodegudang) : null;
            $headerdistribusi->kodeterima= isset($item->kodeterima) ? urldecode($item->kodeterima) : null;
            $headerdistribusi->nilaidistribusi = isset($item->nilaidistribusi) ? urldecode($item->nilaidistribusi) : null;
            $headerdistribusi->userid = isset($item->userid) ? urldecode($item->userid) : null;
            $headerdistribusi->status = isset($item->status) ? urldecode($item->status) : null;
            if ($headerdistribusi->create()) {
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