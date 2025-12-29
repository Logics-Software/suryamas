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
    $filecustomerapoteker->kodecustomer = $data->kodecustomer;
    $filecustomerapoteker->delete();

    //insert data
    $filecustomerapoteker->kodecustomer = $data->kodecustomer;
    $filecustomerapoteker->namaapoteker = $data->namaapoteker;
    $filecustomerapoteker->alamatapoteker = $data->alamatapoteker;
    $filecustomerapoteker->noijin = $data->noijin;
    $filecustomerapoteker->tanggaled = $data->tanggaled;
    $filecustomerapoteker->noijinusaha = $data->noijinusaha;
    $filecustomerapoteker->tgledijinusaha = $data->tgledijinusaha;
    $filecustomerapoteker->nocdob = $data->nocdob;
    $filecustomerapoteker->tanggalcdob = $data->tanggalcdob;
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
        $filecustomerapoteker->kodecustomer = $item->kodecustomer;
        $filecustomerapoteker->delete();

        //insert data
        $filecustomerapoteker->kodecustomer = $item->kodecustomer;
        $filecustomerapoteker->namaapoteker = $item->namaapoteker;
        $filecustomerapoteker->alamatapoteker = $item->alamatapoteker;
        $filecustomerapoteker->noijin = $item->noijin;
        $filecustomerapoteker->tanggaled = $item->tanggaled;
        $filecustomerapoteker->noijinusaha = $item->noijinusaha;
        $filecustomerapoteker->tgledijinusaha = $item->tgledijinusaha;
        $filecustomerapoteker->nocdob = $item->nocdob;
        $filecustomerapoteker->tanggalcdob = $item->tanggalcdob;
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