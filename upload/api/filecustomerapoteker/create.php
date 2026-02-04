<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/FileCustomerApoteker.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $filecustomerapoteker = new FileCustomerApoteker($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $success = 0;
  $fail = 0;

  if (!is_array($data)) {
    //delete data
    $filecustomerapoteker->kodecustomer = isset($data->kodecustomer) ? urldecode($data->kodecustomer) : null;
    $filecustomerapoteker->delete();

    //insert data
    $filecustomerapoteker->kodecustomer = isset($data->kodecustomer) ? urldecode($data->kodecustomer) : null;
    $filecustomerapoteker->namaapoteker = isset($data->namaapoteker) ? urldecode($data->namaapoteker) : null;
    $filecustomerapoteker->alamatapoteker = isset($data->alamatapoteker) ? urldecode($data->alamatapoteker) : null;
    $filecustomerapoteker->noijin = isset($data->noijin) ? urldecode($data->noijin) : null;
    $filecustomerapoteker->tanggaled = isset($data->tanggaled) ? urldecode($data->tanggaled) : null;
    $filecustomerapoteker->noijinusaha = isset($data->noijinusaha) ? urldecode($data->noijinusaha) : null;
    $filecustomerapoteker->tgledijinusaha = isset($data->tgledijinusaha) ? urldecode($data->tgledijinusaha) : null;
    $filecustomerapoteker->nocdob = isset($data->nocdob) ? urldecode($data->nocdob) : null;
    $filecustomerapoteker->tanggalcdob = isset($data->tanggalcdob) ? urldecode($data->tanggalcdob) : null;
    if ($filecustomerapoteker->create()) {
        $success++;
    } else {
        $fail++;
    }
    $response = [
        'status' => $fail === 0 ? 200 : 207,
        'inserted' => "$success",
        'failed' => "$fail",
        'message' => "Inserted: $success, Failed: $fail"
    ];
  } else {
    foreach ($data as $item) {
        //delete data
        $filecustomerapoteker->kodecustomer = isset($item->kodecustomer) ? urldecode($item->kodecustomer) : null;
        $filecustomerapoteker->delete();

        //insert data
        $filecustomerapoteker->kodecustomer = isset($item->kodecustomer) ? urldecode($item->kodecustomer) : null;
        $filecustomerapoteker->namaapoteker = isset($item->namaapoteker) ? urldecode($item->namaapoteker) : null;
        $filecustomerapoteker->alamatapoteker = isset($item->alamatapoteker) ? urldecode($item->alamatapoteker) : null;
        $filecustomerapoteker->noijin = isset($item->noijin) ? urldecode($item->noijin) : null;
        $filecustomerapoteker->tanggaled = isset($item->tanggaled) ? urldecode($item->tanggaled) : null;
        $filecustomerapoteker->noijinusaha = isset($item->noijinusaha) ? urldecode($item->noijinusaha) : null;
        $filecustomerapoteker->tgledijinusaha = isset($item->tgledijinusaha) ? urldecode($item->tgledijinusaha) : null;
        $filecustomerapoteker->nocdob = isset($item->nocdob) ? urldecode($item->nocdob) : null;
        $filecustomerapoteker->tanggalcdob = isset($item->tanggalcdob) ? urldecode($item->tanggalcdob) : null;
        if ($filecustomerapoteker->create()) {
            $success++;
        } else {
            $fail++;
        }
    }
    $response = [
        'status' => $fail === 0 ? 200 : 207,
        'inserted' => "$success",
        'failed' => "$fail",
        'message' => "Inserted: $success, Failed: $fail"
    ];
  }
  echo json_encode($response);