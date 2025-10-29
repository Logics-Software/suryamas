<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/DetailDistribusi.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $detaildistribusi = new DetailDistribusi($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //delete data
    if (is_array($data)) {
      $nodistribusi = '';
      foreach ($data as $item) {
          if ($nodistribusi  !== $item->nodistribusi) {
            $detaildistribusi->nodistribusi = $item->nodistribusi;
            $detaildistribusi->delete();

            $nodistribusi = $item->nodistribusi;
          } 
      }
    } else {
        $detaildistribusi->nodistribusi = $data->nodistribusi;
        $detaildistribusi->delete();
    }

    if (!is_array($data)) {
            $success = 0;
            $fail = 0;
            //insert data
            $detaildistribusi->nodistribusi = $data->nodistribusi;
            $detaildistribusi->kodebarang = $data->kodebarang;
            $detaildistribusi->nopembelian = $data->nopembelian;
            $detaildistribusi->nomorbatch = $data->nomorbatch;
            $detaildistribusi->expireddate = $data->expireddate;
            $detaildistribusi->jumlah = $data->jumlah;
            $detaildistribusi->hpp = $data->hpp;
            $detaildistribusi->totalharga = $data->totalharga;
            $detaildistribusi->nourut = $data->nourut;
            if ($detaildistribusi->create()) {
                $success++;
            } else {
                $fail++;
            }
    } else {
        $success = 0;
        $fail = 0;
        foreach ($data as $item) {
            //insert data
            $detaildistribusi->nodistribusi = $item->nodistribusi;
            $detaildistribusi->kodebarang = $item->kodebarang;
            $detaildistribusi->nopembelian = $item->nopembelian;
            $detaildistribusi->nomorbatch = $item->nomorbatch;
            $detaildistribusi->expireddate = $item->expireddate;
            $detaildistribusi->jumlah = $item->jumlah;
            $detaildistribusi->hpp = $item->hpp;
            $detaildistribusi->totalharga = $item->totalharga;
            $detaildistribusi->nourut = $item->nourut;
            if ($detaildistribusi->create()) {
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