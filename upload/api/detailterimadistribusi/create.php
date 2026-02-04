<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/DetailTerimaDistribusi.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $detailterimadistribusi = new DetailTerimaDistribusi($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //delete data
    if (is_array($data)) {
      $nopenerimaan = '';
      foreach ($data as $item) {
          if ($nopenerimaan  !== $item->nopenerimaan) {
            $detailterimadistribusi->nopenerimaan = isset($item->nopenerimaan) ? urldecode($item->nopenerimaan) : null;
            $detailterimadistribusi->delete();

            $nopenerimaan = isset($item->nopenerimaan) ? urldecode($item->nopenerimaan) : null;
          } 
      }
    } else {
        $detailterimadistribusi->nopenerimaan = isset($data->nopenerimaan) ? urldecode($data->nopenerimaan) : null;
        $detailterimadistribusi->delete();
    }

    if (!is_array($data)) {
            $success = 0;
            $fail = 0;
            //insert data
            $detailterimadistribusi->nopenerimaan = isset($data->nopenerimaan) ? urldecode($data->nopenerimaan) : null;
            $detailterimadistribusi->kodebarang = isset($data->kodebarang) ? urldecode($data->kodebarang) : null;
            $detailterimadistribusi->nopembelian = isset($data->nopembelian) ? urldecode($data->nopembelian) : null;
            $detailterimadistribusi->nomorbatch = isset($data->nomorbatch) ? urldecode($data->nomorbatch) : null;
            $detailterimadistribusi->expireddate = isset($data->expireddate) ? urldecode($data->expireddate) : null;
            $detailterimadistribusi->jumlah = isset($data->jumlah) ? urldecode($data->jumlah) : null;
            $detailterimadistribusi->hpp = isset($data->hpp) ? urldecode($data->hpp) : null;
            $detailterimadistribusi->totalharga = isset($data->totalharga) ? urldecode($data->totalharga) : null;
            $detailterimadistribusi->nourut = isset($data->nourut) ? urldecode($data->nourut) : null;
            if ($detailterimadistribusi->create()) {
                $success++;
            } else {
                $fail++;
            }
    } else {
        $success = 0;
        $fail = 0;
        foreach ($data as $item) {
            //insert data
            $detailterimadistribusi->nopenerimaan = isset($item->nopenerimaan) ? urldecode($item->nopenerimaan) : null;
            $detailterimadistribusi->kodebarang = isset($item->kodebarang) ? urldecode($item->kodebarang) : null;
            $detailterimadistribusi->nopembelian = isset($item->nopembelian) ? urldecode($item->nopembelian) : null;
            $detailterimadistribusi->nomorbatch = isset($item->nomorbatch) ? urldecode($item->nomorbatch) : null;
            $detailterimadistribusi->expireddate = isset($item->expireddate) ? urldecode($item->expireddate) : null;
            $detailterimadistribusi->jumlah = isset($item->jumlah) ? urldecode($item->jumlah) : null;
            $detailterimadistribusi->hpp = isset($item->hpp) ? urldecode($item->hpp) : null;
            $detailterimadistribusi->totalharga = isset($item->totalharga) ? urldecode($item->totalharga) : null;
            $detailterimadistribusi->nourut = isset($item->nourut) ? urldecode($item->nourut) : null;
            if ($detailterimadistribusi->create()) {
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