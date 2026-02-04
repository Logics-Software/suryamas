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
            $detailpenjualan->nopenjualan = isset($item->nopenjualan) ? urldecode($item->nopenjualan) : null;
            $detailpenjualan->delete();

            $nopenjualan = isset($item->nopenjualan) ? urldecode($item->nopenjualan) : null;
          } 
      }
    } else {
        $detailpenjualan->nopenjualan = isset($data->nopenjualan) ? urldecode($data->nopenjualan) : null;
        $detailpenjualan->delete();
    }

    if (!is_array($data)) {
            $success = 0;
            $fail = 0;
            //insert data
            $detailpenjualan->nopenjualan = isset($data->nopenjualan) ? urldecode($data->nopenjualan) : null;
            $detailpenjualan->kodebarang = isset($data->kodebarang) ? urldecode($data->kodebarang) : null;
            $detailpenjualan->nopembelian = isset($data->nopembelian) ? urldecode($data->nopembelian) : null;
            $detailpenjualan->nomorbatch = isset($data->nomorbatch) ? urldecode($data->nomorbatch) : null;
            $detailpenjualan->expireddate = isset($data->expireddate) ? urldecode($data->expireddate) : null;
            $detailpenjualan->jumlah = isset($data->jumlah) ? urldecode($data->jumlah) : null;
            $detailpenjualan->hargajual = isset($data->hargajual) ? urldecode($data->hargajual) : null;
            $detailpenjualan->discount1= isset($data->discount1) ? urldecode($data->discount1) : null;
            $detailpenjualan->discount2= isset($data->discount2) ? urldecode($data->discount2) : null;
            $detailpenjualan->cn= isset($data->cn) ? urldecode($data->cn) : null;
            $detailpenjualan->totalharga = isset($data->totalharga) ? urldecode($data->totalharga) : null;
            $detailpenjualan->nourut = isset($data->nourut) ? urldecode($data->nourut) : null;
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
            $detailpenjualan->nopenjualan = isset($item->nopenjualan) ? urldecode($item->nopenjualan) : null;
            $detailpenjualan->kodebarang = isset($item->kodebarang) ? urldecode($item->kodebarang) : null;
            $detailpenjualan->nopembelian = isset($item->nopembelian) ? urldecode($item->nopembelian) : null;
            $detailpenjualan->nomorbatch = isset($item->nomorbatch) ? urldecode($item->nomorbatch) : null;
            $detailpenjualan->expireddate = isset($item->expireddate) ? urldecode($item->expireddate) : null;
            $detailpenjualan->jumlah = isset($item->jumlah) ? urldecode($item->jumlah) : null;
            $detailpenjualan->hargajual = isset($item->hargajual) ? urldecode($item->hargajual) : null;
            $detailpenjualan->discount1= isset($item->discount1) ? urldecode($item->discount1) : null;
            $detailpenjualan->discount2= isset($item->discount2) ? urldecode($item->discount2) : null;
            $detailpenjualan->cn= isset($item->cn) ? urldecode($item->cn) : null;
            $detailpenjualan->totalharga = isset($item->totalharga) ? urldecode($item->totalharga) : null;
            $detailpenjualan->nourut = isset($item->nourut) ? urldecode($item->nourut) : null;
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