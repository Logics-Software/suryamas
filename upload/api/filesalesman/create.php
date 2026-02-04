<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/FileSalesman.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $filesalesman = new FileSalesman($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $success = 0;
  $fail = 0;

  if (!is_array($data)) {
      //delete data
      $filesalesman->kodesalesman = isset($data->kodesalesman) ? urldecode($data->kodesalesman) : null;
      $filesalesman->delete();

      //insert data
      $filesalesman->kodesalesman = isset($data->kodesalesman) ? urldecode($data->kodesalesman) : null;
      $filesalesman->namasalesman = isset($data->namasalesman) ? urldecode($data->namasalesman) : null;
      $filesalesman->alamatsalesman = isset($data->alamatsalesman) ? urldecode($data->alamatsalesman) : null;
      $filesalesman->notelepon = isset($data->notelepon) ? urldecode($data->notelepon) : null;
      $filesalesman->kodearea = isset($data->kodearea) ? urldecode($data->kodearea) : null;
      $filesalesman->userid = isset($data->userid) ? urldecode($data->userid) : null;
      $filesalesman->status = isset($data->status) ? urldecode($data->status) : null;
      if ($filesalesman->create()) {
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
        $filesalesman->kodesalesman = isset($item->kodesalesman) ? urldecode($item->kodesalesman) : null;
        $filesalesman->delete();

        //insert data
        $filesalesman->kodesalesman = isset($item->kodesalesman) ? urldecode($item->kodesalesman) : null;
        $filesalesman->namasalesman = isset($item->namasalesman) ? urldecode($item->namasalesman) : null;
        $filesalesman->alamatsalesman = isset($item->alamatsalesman) ? urldecode($item->alamatsalesman) : null;
        $filesalesman->notelepon = isset($item->notelepon) ? urldecode($item->notelepon) : null;
        $filesalesman->kodearea = isset($item->kodearea) ? urldecode($item->kodearea) : null;
        $filesalesman->userid = isset($item->userid) ? urldecode($item->userid) : null;
        $filesalesman->status = isset($item->status) ? urldecode($item->status) : null;
        if ($filesalesman->create()) {
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