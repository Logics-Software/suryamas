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
      $filesalesman->kodesalesman = $data->kodesalesman;
      $filesalesman->delete();

      //insert data
      $filesalesman->kodesalesman = $data->kodesalesman;
      $filesalesman->namasalesman = $data->namasalesman;
      $filesalesman->alamatsalesman = $data->alamatsalesman;
      $filesalesman->notelepon = $data->notelepon;
      $filesalesman->kodearea = $data->kodearea;
      $filesalesman->userid = $data->userid;
      $filesalesman->status = $data->status;
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
        $filesalesman->kodesalesman = $item->kodesalesman;
        $filesalesman->delete();

        //insert data
        $filesalesman->kodesalesman = $item->kodesalesman;
        $filesalesman->namasalesman = $item->namasalesman;
        $filesalesman->alamatsalesman = $item->alamatsalesman;
        $filesalesman->notelepon = $item->notelepon;
        $filesalesman->kodearea = $item->kodearea;
        $filesalesman->userid = $item->userid;
        $filesalesman->status = $item->status;
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