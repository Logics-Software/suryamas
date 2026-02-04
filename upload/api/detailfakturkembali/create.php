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
            $detailfakturkembali->nokembali = isset($item->nokembali) ? urldecode($item->nokembali) : null;
            $detailfakturkembali->delete();

            $nokembali = isset($item->nokembali) ? urldecode($item->nokembali) : null;
          } 
      }
    } else {
        $detailfakturkembali->nokembali = isset($data->nokembali) ? urldecode($data->nokembali) : null;
        $detailfakturkembali->delete();
    }

    if (!is_array($data)) {
            $success = 0;
            $fail = 0;
            //insert data
            $detailfakturkembali->nokembali = isset($data->nokembali) ? urldecode($data->nokembali) : null;
            $detailfakturkembali->nopenjualan = isset($data->nopenjualan) ? urldecode($data->nopenjualan) : null;
            $detailfakturkembali->tanggalsp = isset($data->tanggalsp) ? urldecode($data->tanggalsp) : null;
            $detailfakturkembali->sp = isset($data->sp) ? urldecode($data->sp) : null;
            $detailfakturkembali->nourut = isset($data->nourut) ? urldecode($data->nourut) : null;
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
            $detailfakturkembali->nokembali = isset($item->nokembali) ? urldecode($item->nokembali) : null;
            $detailfakturkembali->nopenjualan = isset($item->nopenjualan) ? urldecode($item->nopenjualan) : null;
            $detailfakturkembali->tanggalsp = isset($item->tanggalsp) ? urldecode($item->tanggalsp) : null;
            $detailfakturkembali->sp = isset($item->sp) ? urldecode($item->sp) : null;
            $detailfakturkembali->nourut = isset($item->nourut) ? urldecode($item->nourut) : null;
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