<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/StokBarang.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $stokbarang = new StokBarang($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $success = 0;
  $fail = 0;
  if (!is_array($data)) {
          //delete data
          $stokbarang->kodegudang = isset($data->kodegudang) ? urldecode($data->kodegudang) : null;
          $stokbarang->kodebarang = isset($data->kodebarang) ? urldecode($data->kodebarang) : null;
          $stokbarang->nopembelian = isset($data->nopembelian) ? urldecode($data->nopembelian) : null;
          $stokbarang->nomorbatch = isset($data->nomorbatch) ? urldecode($data->nomorbatch) : null;
          $stokbarang->delete();
    
          //insert data
          $stokbarang->kodegudang = isset($data->kodegudang) ? urldecode($data->kodegudang) : null;
          $stokbarang->kodebarang = isset($data->kodebarang) ? urldecode($data->kodebarang) : null;
          $stokbarang->nopembelian = isset($data->nopembelian) ? urldecode($data->nopembelian) : null;
          $stokbarang->nomorbatch = isset($data->nomorbatch) ? urldecode($data->nomorbatch) : null;
          $stokbarang->tanggalperolehan = isset($data->tanggalperolehan) ? urldecode($data->tanggalperolehan) : null;
          $stokbarang->expireddate = isset($data->expireddate) ? urldecode($data->expireddate) : null;
          $stokbarang->hpp = isset($data->hpp) ? urldecode($data->hpp) : null;
          $stokbarang->stokakhir = isset($data->stokakhir) ? urldecode($data->stokakhir) : null;
          $stokbarang->status = isset($data->status) ? urldecode($data->status) : null;
          if ($stokbarang->create()) {
              $success++;
          } else {
              $fail++;
          }
  } else {
      foreach ($data as $item) {
          //delete data
          $stokbarang->kodegudang = isset($item->kodegudang) ? urldecode($item->kodegudang) : null;
          $stokbarang->kodebarang = isset($item->kodebarang) ? urldecode($item->kodebarang) : null;
          $stokbarang->nopembelian = isset($item->nopembelian) ? urldecode($item->nopembelian) : null;
          $stokbarang->nomorbatch = isset($item->nomorbatch) ? urldecode($item->nomorbatch) : null;
          $stokbarang->delete();
    
          //insert data
          $stokbarang->kodegudang = isset($item->kodegudang) ? urldecode($item->kodegudang) : null;
          $stokbarang->kodebarang = isset($item->kodebarang) ? urldecode($item->kodebarang) : null;
          $stokbarang->nopembelian = isset($item->nopembelian) ? urldecode($item->nopembelian) : null;
          $stokbarang->nomorbatch = isset($item->nomorbatch) ? urldecode($item->nomorbatch) : null;
          $stokbarang->tanggalperolehan = isset($item->tanggalperolehan) ? urldecode($item->tanggalperolehan) : null;
          $stokbarang->expireddate = isset($item->expireddate) ? urldecode($item->expireddate) : null;
          $stokbarang->hpp = isset($item->hpp) ? urldecode($item->hpp) : null;
          $stokbarang->stokakhir = isset($item->stokakhir) ? urldecode($item->stokakhir) : null;
          $stokbarang->status = isset($item->status) ? urldecode($item->status) : null;
          if ($stokbarang->create()) {
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