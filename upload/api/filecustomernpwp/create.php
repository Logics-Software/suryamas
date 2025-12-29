<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/FileCustomerNpwp.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $filecustomernpwp = new FileCustomerNpwp($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $success = 0;
  $fail = 0;

  if (!is_array($data)) {
    //delete data
    $filecustomernpwp->kodecustomer = $data->kodecustomer;
    $filecustomernpwp->delete();

    //insert data
    $filecustomernpwp->kodecustomer = $data->kodecustomer;
    $filecustomernpwp->npwp = $data->npwp;
    $filecustomernpwp->jeniswp = $data->jeniswp;
    if ($filecustomernpwp->create()) {
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
        $filecustomernpwp->kodecustomer = $item->kodecustomer;
        $filecustomernpwp->delete();

        //insert data
        $filecustomernpwp->kodecustomer = $item->kodecustomer;
        $filecustomernpwp->npwp = $item->npwp;
        $filecustomernpwp->jeniswp = $item->jeniswp;
        if ($filecustomernpwp->create()) {
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