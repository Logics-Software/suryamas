<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/DetailFakturKembali.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $detailfakturkembali = new DetailFakturKembali($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //delete data
    if (is_array($data)) {
      $nokembali = '';
      foreach ($data as $item) {
          if ($nokembali  !== $item->nokembali) {
            $detailfakturkembali->nokembali = $item->nokembali;
            $detailfakturkembali->delete();

            $nokembali = $item->nokembali;
          } 
      }
    } else {
        $detailfakturkembali->nokembali = $data->nokembali;
        $detailfakturkembali->delete();
    }

    if (!is_array($data)) {
            $success = 0;
            $fail = 0;
            //insert data
            $detailfakturkembali->nokembali = $data->nokembali;
            $detailfakturkembali->nopenjualan = $data->nopenjualan;
            $detailfakturkembali->tanggalsp = $data->tanggalsp;
            $detailfakturkembali->sp = $data->sp;
            $detailfakturkembali->nourut = $data->nourut;
            if ($detailfakturkembali->create()) {
                $success++;
            } else {
                $fail++;
            }
    } else {
        $success = 0;
        $fail = 0;
        foreach ($data as $item) {
            //insert data
            $detailfakturkembali->nokembali = $item->nokembali;
            $detailfakturkembali->nopenjualan = $item->nopenjualan;
            $detailfakturkembali->tanggalsp = $item->tanggalsp;
            $detailfakturkembali->sp = $item->sp;
            $detailfakturkembali->nourut = $item->nourut;
            if ($detailfakturkembali->create()) {
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