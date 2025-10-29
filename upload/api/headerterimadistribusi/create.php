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
        $headerterimadistribusi->nopenerimaan = $data->nopenerimaan;
        $headerterimadistribusi->delete();

        //insert data
        $headerterimadistribusi->nopenerimaan = $data->nopenerimaan;
        $headerterimadistribusi->tanggalpenerimaan = $data->tanggalpenerimaan;
        $headerterimadistribusi->nodistribusi = $data->nodistribusi;
        $headerterimadistribusi->keterangan = $data->keterangan;
        $headerterimadistribusi->kodegudang = $data->kodegudang;
        $headerterimadistribusi->kodekirim= $data->kodekirim;
        $headerterimadistribusi->nilaipenerimaan = $data->nilaipenerimaan;
        $headerterimadistribusi->userid = $data->userid;
        $headerterimadistribusi->status = $data->status;
        if ($headerterimadistribusi->create()) {
            $success++;
        } else {
            $fail++;
        }
    } else {
        foreach ($data as $item) {
            //delete data
            $headerterimadistribusi->nopenerimaan = $item->nopenerimaan;
            $headerterimadistribusi->delete();

            //insert data
            $headerterimadistribusi->nopenerimaan = $item->nopenerimaan;
            $headerterimadistribusi->tanggalpenerimaan = $item->tanggalpenerimaan;
            $headerterimadistribusi->nodistribusi = $item->nodistribusi;
            $headerterimadistribusi->keterangan = $item->keterangan;
            $headerterimadistribusi->kodegudang = $item->kodegudang;
            $headerterimadistribusi->kodekirim= $item->kodekirim;
            $headerterimadistribusi->nilaipenerimaan = $item->nilaipenerimaan;
            $headerterimadistribusi->userid = $item->userid;
            $headerterimadistribusi->status = $item->status;
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