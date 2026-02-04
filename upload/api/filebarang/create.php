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
          $filebarang->kodebarang = isset($data->kodebarang) ? urldecode($data->kodebarang) : null;
          $filebarang->delete();
    
          //insert data
          $filebarang->kodebarang = isset($data->kodebarang) ? urldecode($data->kodebarang) : null;
          $filebarang->namabarang = isset($data->namabarang) ? urldecode($data->namabarang) : null;
          $filebarang->satuan = isset($data->satuan) ? urldecode($data->satuan) : null;
          $filebarang->kodepabrik = isset($data->kodepabrik) ? urldecode($data->kodepabrik) : null;
          $filebarang->kodekemasan = isset($data->kodekemasan) ? urldecode($data->kodekemasan) : null;
          $filebarang->kodelokasi = isset($data->kodelokasi) ? urldecode($data->kodelokasi) : null;
          $filebarang->kodekelasterapi = isset($data->kodekelasterapi) ? urldecode($data->kodekelasterapi) : null;
          $filebarang->kodegolongan = isset($data->kodegolongan) ? urldecode($data->kodegolongan) : null;
          $filebarang->kodesupplier = isset($data->kodesupplier) ? urldecode($data->kodesupplier) : null;
          $filebarang->farmalkes_id = isset($data->farmalkes_id) ? urldecode($data->farmalkes_id) : null;
          $filebarang->kodebko = isset($data->kodebko) ? urldecode($data->kodebko) : null;
          $filebarang->barcode = isset($data->barcode) ? urldecode($data->barcode) : null;
          $filebarang->hpp = isset($data->hpp) ? urldecode($data->hpp) : null;
          $filebarang->hargar = isset($data->hargar) ? urldecode($data->hargar) : null;
          $filebarang->discr1 = isset($data->discr1) ? urldecode($data->discr1) : null;
          $filebarang->discr2 = isset($data->discr2) ? urldecode($data->discr2) : null;
          $filebarang->hargaw1 = isset($data->hargaw1) ? urldecode($data->hargaw1) : null;
          $filebarang->disc1w1 = isset($data->disc1w1) ? urldecode($data->disc1w1) : null;
          $filebarang->disc2w1 = isset($data->disc2w1) ? urldecode($data->disc2w1) : null;
          $filebarang->hargaw2 = isset($data->hargaw2) ? urldecode($data->hargaw2) : null;
          $filebarang->disc1w2 = isset($data->disc1w2) ? urldecode($data->disc1w2) : null;
          $filebarang->disc2w2 = isset($data->disc2w2) ? urldecode($data->disc2w2) : null;
          $filebarang->kondisir = isset($data->kondisir) ? urldecode($data->kondisir) : null;
          $filebarang->kondisiw1 = isset($data->kondisiw1) ? urldecode($data->kondisiw1) : null;
          $filebarang->kondisiw2 = isset($data->kondisiw2) ? urldecode($data->kondisiw2) : null;
          $filebarang->jumlahr = isset($data->jumlahr) ? urldecode($data->jumlahr) : null;
          $filebarang->jumlahw1 = isset($data->jumlahw1) ? urldecode($data->jumlahw1) : null;
          $filebarang->jumlahw2 = isset($data->jumlahw2) ? urldecode($data->jumlahw2) : null;
          $filebarang->status = isset($data->status) ? urldecode($data->status) : null;
          if ($filebarang->create()) {
              $success++;
          } else {
              $fail++;
          }
  } else {
      foreach ($data as $item) {
          //delete data
          $filebarang->kodebarang = isset($item->kodebarang) ? urldecode($item->kodebarang) : null;
          $filebarang->delete();
    
          //insert data
          $filebarang->kodebarang = isset($item->kodebarang) ? urldecode($item->kodebarang) : null;
          $filebarang->namabarang = isset($item->namabarang) ? urldecode($item->namabarang) : null;
          $filebarang->satuan = isset($item->satuan) ? urldecode($item->satuan) : null;
          $filebarang->kodepabrik = isset($item->kodepabrik) ? urldecode($item->kodepabrik) : null;
          $filebarang->kodekemasan = isset($item->kodekemasan) ? urldecode($item->kodekemasan) : null;
          $filebarang->kodelokasi = isset($item->kodelokasi) ? urldecode($item->kodelokasi) : null;
          $filebarang->kodekelasterapi = isset($item->kodekelasterapi) ? urldecode($item->kodekelasterapi) : null;
          $filebarang->kodegolongan = isset($item->kodegolongan) ? urldecode($item->kodegolongan) : null;
          $filebarang->kodesupplier = isset($item->kodesupplier) ? urldecode($item->kodesupplier) : null;
          $filebarang->farmalkes_id = isset($item->farmalkes_id) ? urldecode($item->farmalkes_id) : null;
          $filebarang->kodebko = isset($item->kodebko) ? urldecode($item->kodebko) : null;
          $filebarang->barcode = isset($item->barcode) ? urldecode($item->barcode) : null;
          $filebarang->hpp = isset($item->hpp) ? urldecode($item->hpp) : null;
          $filebarang->hargar = isset($item->hargar) ? urldecode($item->hargar) : null;
          $filebarang->discr1 = isset($item->discr1) ? urldecode($item->discr1) : null;
          $filebarang->discr2 = isset($item->discr2) ? urldecode($item->discr2) : null;
          $filebarang->hargaw1 = isset($item->hargaw1) ? urldecode($item->hargaw1) : null;
          $filebarang->disc1w1 = isset($item->disc1w1) ? urldecode($item->disc1w1) : null;
          $filebarang->disc2w1 = isset($item->disc2w1) ? urldecode($item->disc2w1) : null;
          $filebarang->hargaw2 = isset($item->hargaw2) ? urldecode($item->hargaw2) : null;
          $filebarang->disc1w2 = isset($item->disc1w2) ? urldecode($item->disc1w2) : null;
          $filebarang->disc2w2 = isset($item->disc2w2) ? urldecode($item->disc2w2) : null;
          $filebarang->kondisir = isset($item->kondisir) ? urldecode($item->kondisir) : null;
          $filebarang->kondisiw1 = isset($item->kondisiw1) ? urldecode($item->kondisiw1) : null;
          $filebarang->kondisiw2 = isset($item->kondisiw2) ? urldecode($item->kondisiw2) : null;
          $filebarang->jumlahr = isset($item->jumlahr) ? urldecode($item->jumlahr) : null;
          $filebarang->jumlahw1 = isset($item->jumlahw1) ? urldecode($item->jumlahw1) : null;
          $filebarang->jumlahw2 = isset($item->jumlahw2) ? urldecode($item->jumlahw2) : null;
          $filebarang->status = isset($item->status) ? urldecode($item->status) : null;
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