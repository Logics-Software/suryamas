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
        $headerdistribusi->nodistribusi = $data->nodistribusi;
        $headerdistribusi->delete();

        //insert data
        $headerdistribusi->nodistribusi = $data->nodistribusi;
        $headerdistribusi->tanggaldistribusi = $data->tanggaldistribusi;
        $headerdistribusi->keterangan = $data->keterangan;
        $headerdistribusi->kodegudang = $data->kodegudang;
        $headerdistribusi->kodeterima= $data->kodeterima;
        $headerdistribusi->nilaidistribusi = $data->nilaidistribusi;
        $headerdistribusi->userid = $data->userid;
        $headerdistribusi->status = $data->status;
        if ($headerdistribusi->create()) {
            $success++;
        } else {
            $fail++;
        }
    } else {
        foreach ($data as $item) {
            //delete data
            $headerdistribusi->nodistribusi = $item->nodistribusi;
            $headerdistribusi->delete();

            //insert data
            $headerdistribusi->nodistribusi = $item->nodistribusi;
            $headerdistribusi->tanggaldistribusi = $item->tanggaldistribusi;
            $headerdistribusi->keterangan = $item->keterangan;
            $headerdistribusi->kodegudang = $item->kodegudang;
            $headerdistribusi->kodeterima= $item->kodeterima;
            $headerdistribusi->nilaidistribusi = $item->nilaidistribusi;
            $headerdistribusi->userid = $item->userid;
            $headerdistribusi->status = $item->status;
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