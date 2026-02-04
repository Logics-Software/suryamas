<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/HeaderTerimaDistribusi.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $headerterimadistribusi = new HeaderTerimaDistribusi($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $success = 0;
    $fail = 0;
    if (!is_array($data)) {
        //delete data
        $headerterimadistribusi->nopenerimaan = isset($data->nopenerimaan) ? urldecode($data->nopenerimaan) : null;
        $headerterimadistribusi->delete();

        //insert data
        $headerterimadistribusi->nopenerimaan = isset($data->nopenerimaan) ? urldecode($data->nopenerimaan) : null;
        $headerterimadistribusi->tanggalpenerimaan = isset($data->tanggalpenerimaan) ? urldecode($data->tanggalpenerimaan) : null;
        $headerterimadistribusi->nodistribusi = isset($data->nodistribusi) ? urldecode($data->nodistribusi) : null;
        $headerterimadistribusi->keterangan = isset($data->keterangan) ? urldecode($data->keterangan) : null;
        $headerterimadistribusi->kodegudang = isset($data->kodegudang) ? urldecode($data->kodegudang) : null;
        $headerterimadistribusi->kodekirim= isset($data->kodekirim) ? urldecode($data->kodekirim) : null;
        $headerterimadistribusi->nilaipenerimaan = isset($data->nilaipenerimaan) ? urldecode($data->nilaipenerimaan) : null;
        $headerterimadistribusi->userid = isset($data->userid) ? urldecode($data->userid) : null;
        $headerterimadistribusi->status = isset($data->status) ? urldecode($data->status) : null;
        if ($headerterimadistribusi->create()) {
            $success++;
        } else {
            $fail++;
        }
    } else {
        foreach ($data as $item) {
            //delete data
            $headerterimadistribusi->nopenerimaan = isset($item->nopenerimaan) ? urldecode($item->nopenerimaan) : null;
            $headerterimadistribusi->delete();

            //insert data
            $headerterimadistribusi->nopenerimaan = isset($item->nopenerimaan) ? urldecode($item->nopenerimaan) : null;
            $headerterimadistribusi->tanggalpenerimaan = isset($item->tanggalpenerimaan) ? urldecode($item->tanggalpenerimaan) : null;
            $headerterimadistribusi->nodistribusi = isset($item->nodistribusi) ? urldecode($item->nodistribusi) : null;
            $headerterimadistribusi->keterangan = isset($item->keterangan) ? urldecode($item->keterangan) : null;
            $headerterimadistribusi->kodegudang = isset($item->kodegudang) ? urldecode($item->kodegudang) : null;
            $headerterimadistribusi->kodekirim= isset($item->kodekirim) ? urldecode($item->kodekirim) : null;
            $headerterimadistribusi->nilaipenerimaan = isset($item->nilaipenerimaan) ? urldecode($item->nilaipenerimaan) : null;
            $headerterimadistribusi->userid = isset($item->userid) ? urldecode($item->userid) : null;
            $headerterimadistribusi->status = isset($item->status) ? urldecode($item->status) : null;
            if ($headerterimadistribusi->create()) {
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