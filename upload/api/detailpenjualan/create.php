<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/DetailPenjualan.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $detailpenjualan = new DetailPenjualan($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //delete data
    if (is_array($data)) {
      $nopenjualan = '';
      foreach ($data as $item) {
          if ($nopenjualan  !== $item->nopenjualan) {
            $detailpenjualan->nopenjualan = $item->nopenjualan;
            $detailpenjualan->delete();

            $nopenjualan = $item->nopenjualan;
          } 
      }
    } else {
        $detailpenjualan->nopenjualan = $data->nopenjualan;
        $detailpenjualan->delete();
    }

    if (!is_array($data)) {
            $success = 0;
            $fail = 0;
            //insert data
            $detailpenjualan->nopenjualan = $data->nopenjualan;
            $detailpenjualan->kodebarang = $data->kodebarang;
            $detailpenjualan->nopembelian = $data->nopembelian;
            $detailpenjualan->nomorbatch = $data->nomorbatch;
            $detailpenjualan->expireddate = $data->expireddate;
            $detailpenjualan->jumlah = $data->jumlah;
            $detailpenjualan->hargajual = $data->hargajual;
            $detailpenjualan->discount1= $data->discount1;
            $detailpenjualan->discount2= $data->discount2;
            $detailpenjualan->cn= $data->cn;
            $detailpenjualan->totalharga = $data->totalharga;
            $detailpenjualan->nourut = $data->nourut;
            if ($detailpenjualan->create()) {
                $success++;
            } else {
                $fail++;
            }
    } else {
        $success = 0;
        $fail = 0;
        foreach ($data as $item) {
            //insert data
            $detailpenjualan->nopenjualan = $item->nopenjualan;
            $detailpenjualan->kodebarang = $item->kodebarang;
            $detailpenjualan->nopembelian = $item->nopembelian;
            $detailpenjualan->nomorbatch = $item->nomorbatch;
            $detailpenjualan->expireddate = $item->expireddate;
            $detailpenjualan->jumlah = $item->jumlah;
            $detailpenjualan->hargajual = $item->hargajual;
            $detailpenjualan->discount1= $item->discount1;
            $detailpenjualan->discount2= $item->discount2;
            $detailpenjualan->cn= $item->cn;
            $detailpenjualan->totalharga = $item->totalharga;
            $detailpenjualan->nourut = $item->nourut;
            if ($detailpenjualan->create()) {
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