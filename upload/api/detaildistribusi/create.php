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
            $detaildistribusi->nodistribusi = isset($item->nodistribusi) ? urldecode($item->nodistribusi) : null;
            $detaildistribusi->delete();

            $nodistribusi = isset($item->nodistribusi) ? urldecode($item->nodistribusi) : null;
          } 
      }
    } else {
        $detaildistribusi->nodistribusi = isset($data->nodistribusi) ? urldecode($data->nodistribusi) : null;
        $detaildistribusi->delete();
    }

    if (!is_array($data)) {
            $success = 0;
            $fail = 0;
            //insert data
            $detaildistribusi->nodistribusi = isset($data->nodistribusi) ? urldecode($data->nodistribusi) : null;
            $detaildistribusi->kodebarang = isset($data->kodebarang) ? urldecode($data->kodebarang) : null;
            $detaildistribusi->nopembelian = isset($data->nopembelian) ? urldecode($data->nopembelian) : null;
            $detaildistribusi->nomorbatch = isset($data->nomorbatch) ? urldecode($data->nomorbatch) : null;
            $detaildistribusi->expireddate = isset($data->expireddate) ? urldecode($data->expireddate) : null;
            $detaildistribusi->jumlah = isset($data->jumlah) ? urldecode($data->jumlah) : null;
            $detaildistribusi->hpp = isset($data->hpp) ? urldecode($data->hpp) : null;
            $detaildistribusi->totalharga = isset($data->totalharga) ? urldecode($data->totalharga) : null;
            $detaildistribusi->nourut = isset($data->nourut) ? urldecode($data->nourut) : null;
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
            $detaildistribusi->nodistribusi = isset($item->nodistribusi) ? urldecode($item->nodistribusi) : null;
            $detaildistribusi->kodebarang = isset($item->kodebarang) ? urldecode($item->kodebarang) : null;
            $detaildistribusi->nopembelian = isset($item->nopembelian) ? urldecode($item->nopembelian) : null;
            $detaildistribusi->nomorbatch = isset($item->nomorbatch) ? urldecode($item->nomorbatch) : null;
            $detaildistribusi->expireddate = isset($item->expireddate) ? urldecode($item->expireddate) : null;
            $detaildistribusi->jumlah = isset($item->jumlah) ? urldecode($item->jumlah) : null;
            $detaildistribusi->hpp = isset($item->hpp) ? urldecode($item->hpp) : null;
            $detaildistribusi->totalharga = isset($item->totalharga) ? urldecode($item->totalharga) : null;
            $detaildistribusi->nourut = isset($item->nourut) ? urldecode($item->nourut) : null;
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