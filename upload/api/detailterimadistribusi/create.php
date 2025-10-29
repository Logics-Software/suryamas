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
            $detailterimadistribusi->nopenerimaan = $item->nopenerimaan;
            $detailterimadistribusi->delete();

            $nopenerimaan = $item->nopenerimaan;
          } 
      }
    } else {
        $detailterimadistribusi->nopenerimaan = $data->nopenerimaan;
        $detailterimadistribusi->delete();
    }

    if (!is_array($data)) {
            $success = 0;
            $fail = 0;
            //insert data
            $detailterimadistribusi->nopenerimaan = $data->nopenerimaan;
            $detailterimadistribusi->kodebarang = $data->kodebarang;
            $detailterimadistribusi->nopembelian = $data->nopembelian;
            $detailterimadistribusi->nomorbatch = $data->nomorbatch;
            $detailterimadistribusi->expireddate = $data->expireddate;
            $detailterimadistribusi->jumlah = $data->jumlah;
            $detailterimadistribusi->hpp = $data->hpp;
            $detailterimadistribusi->totalharga = $data->totalharga;
            $detailterimadistribusi->nourut = $data->nourut;
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
            $detailterimadistribusi->nopenerimaan = $item->nopenerimaan;
            $detailterimadistribusi->kodebarang = $item->kodebarang;
            $detailterimadistribusi->nopembelian = $item->nopembelian;
            $detailterimadistribusi->nomorbatch = $item->nomorbatch;
            $detailterimadistribusi->expireddate = $item->expireddate;
            $detailterimadistribusi->jumlah = $item->jumlah;
            $detailterimadistribusi->hpp = $item->hpp;
            $detailterimadistribusi->totalharga = $item->totalharga;
            $detailterimadistribusi->nourut = $item->nourut;
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