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
          $stokbarang->kodegudang = $data->kodegudang;
          $stokbarang->kodebarang = $data->kodebarang;
          $stokbarang->nopembelian = $data->nopembelian;
          $stokbarang->nomorbatch = $data->nomorbatch;
          $stokbarang->delete();
    
          //insert data
          $stokbarang->kodegudang = $data->kodegudang;
          $stokbarang->kodebarang = $data->kodebarang;
          $stokbarang->nopembelian = $data->nopembelian;
          $stokbarang->nomorbatch = $data->nomorbatch;
          $stokbarang->tanggalperolehan = $data->tanggalperolehan;
          $stokbarang->expireddate = $data->expireddate;
          $stokbarang->hpp = $data->hpp;
          $stokbarang->stokakhir = $data->stokakhir;
          $stokbarang->status = $data->status;
          if ($stokbarang->create()) {
              $success++;
          } else {
              $fail++;
          }
  } else {
      foreach ($data as $item) {
          //delete data
          $stokbarang->kodegudang = $item->kodegudang;
          $stokbarang->kodebarang = $item->kodebarang;
          $stokbarang->nopembelian = $item->nopembelian;
          $stokbarang->nomorbatch = $item->nomorbatch;
          $stokbarang->delete();
    
          //insert data
          $stokbarang->kodegudang = $item->kodegudang;
          $stokbarang->kodebarang = $item->kodebarang;
          $stokbarang->nopembelian = $item->nopembelian;
          $stokbarang->nomorbatch = $item->nomorbatch;
          $stokbarang->tanggalperolehan = $item->tanggalperolehan;
          $stokbarang->expireddate = $item->expireddate;
          $stokbarang->hpp = $item->hpp;
          $stokbarang->stokakhir = $item->stokakhir;
          $stokbarang->status = $item->status;
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