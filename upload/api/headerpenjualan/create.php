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
        $headerpenjualan->nopenjualan = $data->nopenjualan;
        $headerpenjualan->delete();

        //insert data
        $headerpenjualan->kodeformulir = $data->kodeformulir;
        $headerpenjualan->nopenjualan = $data->nopenjualan;
        $headerpenjualan->tanggalpenjualan = $data->tanggalpenjualan;
        $headerpenjualan->kodetermin = $data->kodetermin;
        $headerpenjualan->tanggaljatuhtempo = $data->tanggaljatuhtempo;
        $headerpenjualan->nopo = $data->nopo;
        $headerpenjualan->keterangan = $data->keterangan;
        $headerpenjualan->kodecustomer = $data->kodecustomer;
        $headerpenjualan->kodesalesman= $data->kodesalesman;
        $headerpenjualan->kodepengirim = $data->kodepengirim;
        $headerpenjualan->dpp = $data->dpp;
        $headerpenjualan->ppn = $data->ppn;
        $headerpenjualan->nilaipenjualan = $data->nilaipenjualan;
        $headerpenjualan->saldopenjualan = $data->saldopenjualan;
        $headerpenjualan->cnpenjualan = $data->cnpenjualan;
        $headerpenjualan->userid = $data->userid;
        $headerpenjualan->status = $data->status;
        if ($headerpenjualan->create()) {
            $success++;
        } else {
            $fail++;
        }
    } else {
        foreach ($data as $item) {
            //delete data
            $headerpenjualan->nopenjualan = $item->nopenjualan;
            $headerpenjualan->delete();

            //insert data
            $headerpenjualan->kodeformulir = $item->kodeformulir;
            $headerpenjualan->nopenjualan = $item->nopenjualan;
            $headerpenjualan->tanggalpenjualan = $item->tanggalpenjualan;
            $headerpenjualan->kodetermin = $item->kodetermin;
            $headerpenjualan->tanggaljatuhtempo = $item->tanggaljatuhtempo;
            $headerpenjualan->nopo = $item->nopo;
            $headerpenjualan->keterangan = $item->keterangan;
            $headerpenjualan->kodecustomer = $item->kodecustomer;
            $headerpenjualan->kodesalesman= $item->kodesalesman;
            $headerpenjualan->kodepengirim = $item->kodepengirim;
            $headerpenjualan->dpp = $item->dpp;
            $headerpenjualan->ppn = $item->ppn;
            $headerpenjualan->nilaipenjualan = $item->nilaipenjualan;
            $headerpenjualan->saldopenjualan = $item->saldopenjualan;
            $headerpenjualan->cnpenjualan = $item->cnpenjualan;
            $headerpenjualan->userid = $item->userid;
            $headerpenjualan->status = $item->status;
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