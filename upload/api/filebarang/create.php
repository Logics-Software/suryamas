<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/FileBarang.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $filebarang = new FileBarang($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $success = 0;
  $fail = 0;

  if (!is_array($data)) {
          //delete data
          $filebarang->kodebarang = $data->kodebarang;
          $filebarang->delete();
    
          //insert data
          $filebarang->kodebarang = $data->kodebarang;
          $filebarang->namabarang = $data->namabarang;
          $filebarang->satuan = $data->satuan;
          $filebarang->kodepabrik = $data->kodepabrik;
          $filebarang->kodekemasan = $data->kodekemasan;
          $filebarang->kodelokasi = $data->kodelokasi;
          $filebarang->kodekelasterapi = $data->kodekelasterapi;
          $filebarang->kodegolongan = $data->kodegolongan;
          $filebarang->kodesupplier = $data->kodesupplier;
          $filebarang->farmalkes_id = $data->farmalkes_id;
          $filebarang->kodebko = $data->kodebko;
          $filebarang->barcode = $data->barcode;
          $filebarang->hpp = $data->hpp;
          $filebarang->hargar = $data->hargar;
          $filebarang->discr1 = $data->discr1;
          $filebarang->discr2 = $data->discr2;
          $filebarang->hargaw1 = $data->hargaw1;
          $filebarang->disc1w1 = $data->disc1w1;
          $filebarang->disc2w1 = $data->disc2w1;
          $filebarang->hargaw2 = $data->hargaw2;
          $filebarang->disc1w2 = $data->disc1w2;
          $filebarang->disc2w2 = $data->disc2w2;
          $filebarang->kondisir = $data->kondisir;
          $filebarang->kondisiw1 = $data->kondisiw1;
          $filebarang->kondisiw2 = $data->kondisiw2;
          $filebarang->jumlahr = $data->jumlahr;
          $filebarang->jumlahw1 = $data->jumlahw1;
          $filebarang->jumlahw2 = $data->jumlahw2;
          $filebarang->status = $data->status;
          if ($filebarang->create()) {
              $success++;
          } else {
              $fail++;
          }
  } else {
      foreach ($data as $item) {
          //delete data
          $filebarang->kodebarang = $item->kodebarang;
          $filebarang->delete();
    
          //insert data
          $filebarang->kodebarang = $item->kodebarang;
          $filebarang->namabarang = $item->namabarang;
          $filebarang->satuan = $item->satuan;
          $filebarang->kodepabrik = $item->kodepabrik;
          $filebarang->kodekemasan = $item->kodekemasan;
          $filebarang->kodelokasi = $item->kodelokasi;
          $filebarang->kodekelasterapi = $item->kodekelasterapi;
          $filebarang->kodegolongan = $item->kodegolongan;
          $filebarang->kodesupplier = $item->kodesupplier;
          $filebarang->farmalkes_id = $item->farmalkes_id;
          $filebarang->kodebko = $item->kodebko;
          $filebarang->barcode = $item->barcode;
          $filebarang->hpp = $item->hpp;
          $filebarang->hargar = $item->hargar;
          $filebarang->discr1 = $item->discr1;
          $filebarang->discr2 = $item->discr2;
          $filebarang->hargaw1 = $item->hargaw1;
          $filebarang->disc1w1 = $item->disc1w1;
          $filebarang->disc2w1 = $item->disc2w1;
          $filebarang->hargaw2 = $item->hargaw2;
          $filebarang->disc1w2 = $item->disc1w2;
          $filebarang->disc2w2 = $item->disc2w2;
          $filebarang->kondisir = $item->kondisir;
          $filebarang->kondisiw1 = $item->kondisiw1;
          $filebarang->kondisiw2 = $item->kondisiw2;
          $filebarang->jumlahr = $item->jumlahr;
          $filebarang->jumlahw1 = $item->jumlahw1;
          $filebarang->jumlahw2 = $item->jumlahw2;
          $filebarang->status = $item->status;
          if ($filebarang->create()) {
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