<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/HeaderPenjualan.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $headerpenjualan = new HeaderPenjualan($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $success = 0;
    $fail = 0;
    if (!is_array($data)) {
        //delete data
        $headerpenjualan->nopenjualan = isset($data->nopenjualan) ? urldecode($data->nopenjualan) : null;
        $headerpenjualan->delete();

        //insert data
        $headerpenjualan->kodeformulir = isset($data->kodeformulir) ? urldecode($data->kodeformulir) : null;
        $headerpenjualan->nopenjualan = isset($data->nopenjualan) ? urldecode($data->nopenjualan) : null;
        $headerpenjualan->tanggalpenjualan = isset($data->tanggalpenjualan) ? urldecode($data->tanggalpenjualan) : null;
        $headerpenjualan->kodetermin = isset($data->kodetermin) ? urldecode($data->kodetermin) : null;
        $headerpenjualan->tanggaljatuhtempo = isset($data->tanggaljatuhtempo) ? urldecode($data->tanggaljatuhtempo) : null;
        $headerpenjualan->nopo = isset($data->nopo) ? urldecode($data->nopo) : null;
        $headerpenjualan->keterangan = isset($data->keterangan) ? urldecode($data->keterangan) : null;
        $headerpenjualan->kodecustomer = isset($data->kodecustomer) ? urldecode($data->kodecustomer) : null;
        $headerpenjualan->kodesalesman= isset($data->kodesalesman) ? urldecode($data->kodesalesman) : null;
        $headerpenjualan->kodepengirim = isset($data->kodepengirim) ? urldecode($data->kodepengirim) : null;
        $headerpenjualan->dpp = isset($data->dpp) ? urldecode($data->dpp) : null;
        $headerpenjualan->ppn = isset($data->ppn) ? urldecode($data->ppn) : null;
        $headerpenjualan->nilaipenjualan = isset($data->nilaipenjualan) ? urldecode($data->nilaipenjualan) : null;
        $headerpenjualan->saldopenjualan = isset($data->saldopenjualan) ? urldecode($data->saldopenjualan) : null;
        $headerpenjualan->cnpenjualan = isset($data->cnpenjualan) ? urldecode($data->cnpenjualan) : null;
        $headerpenjualan->userid = isset($data->userid) ? urldecode($data->userid) : null;
        $headerpenjualan->status = isset($data->status) ? urldecode($data->status) : null;
        if ($headerpenjualan->create()) {
            $success++;
        } else {
            $fail++;
        }
    } else {
        foreach ($data as $item) {
            //delete data
            $headerpenjualan->nopenjualan = isset($item->nopenjualan) ? urldecode($item->nopenjualan) : null;
            $headerpenjualan->delete();

            //insert data
            $headerpenjualan->kodeformulir = isset($item->kodeformulir) ? urldecode($item->kodeformulir) : null;
            $headerpenjualan->nopenjualan = isset($item->nopenjualan) ? urldecode($item->nopenjualan) : null;
            $headerpenjualan->tanggalpenjualan = isset($item->tanggalpenjualan) ? urldecode($item->tanggalpenjualan) : null;
            $headerpenjualan->kodetermin = isset($item->kodetermin) ? urldecode($item->kodetermin) : null;
            $headerpenjualan->tanggaljatuhtempo = isset($item->tanggaljatuhtempo) ? urldecode($item->tanggaljatuhtempo) : null;
            $headerpenjualan->nopo = isset($item->nopo) ? urldecode($item->nopo) : null;
            $headerpenjualan->keterangan = isset($item->keterangan) ? urldecode($item->keterangan) : null;
            $headerpenjualan->kodecustomer = isset($item->kodecustomer) ? urldecode($item->kodecustomer) : null;
            $headerpenjualan->kodesalesman= isset($item->kodesalesman) ? urldecode($item->kodesalesman) : null;
            $headerpenjualan->kodepengirim = isset($item->kodepengirim) ? urldecode($item->kodepengirim) : null;
            $headerpenjualan->dpp = isset($item->dpp) ? urldecode($item->dpp) : null;
            $headerpenjualan->ppn = isset($item->ppn) ? urldecode($item->ppn) : null;
            $headerpenjualan->nilaipenjualan = isset($item->nilaipenjualan) ? urldecode($item->nilaipenjualan) : null;
            $headerpenjualan->saldopenjualan = isset($item->saldopenjualan) ? urldecode($item->saldopenjualan) : null;
            $headerpenjualan->cnpenjualan = isset($item->cnpenjualan) ? urldecode($item->cnpenjualan) : null;
            $headerpenjualan->userid = isset($item->userid) ? urldecode($item->userid) : null;
            $headerpenjualan->status = isset($item->status) ? urldecode($item->status) : null;
            if ($headerpenjualan->create()) {
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