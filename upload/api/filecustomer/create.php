<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/FileCustomer.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $filecustomer = new FileCustomer($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $success = 0;
  $fail = 0;

  if (!is_array($data)) {
    //delete data
    $filecustomer->kodecustomer = isset($data->kodecustomer) ? urldecode($data->kodecustomer) : null;
    $filecustomer->delete();

    //insert data
    $filecustomer->kodecustomer = isset($data->kodecustomer) ? urldecode($data->kodecustomer) : null;
    $filecustomer->kodebadanusaha = isset($data->kodebadanusaha) ? urldecode($data->kodebadanusaha) : null;
    $filecustomer->namabadanusaha = isset($data->namabadanusaha) ? urldecode($data->namabadanusaha) : null;
    $filecustomer->namacustomer = isset($data->namacustomer) ? urldecode($data->namacustomer) : null;
    $filecustomer->alamatcustomer = isset($data->alamatcustomer) ? urldecode($data->alamatcustomer) : null;
    $filecustomer->kota = isset($data->kota) ? urldecode($data->kota) : null;
    $filecustomer->notelepon = isset($data->notelepon) ? urldecode($data->notelepon) : null;
    $filecustomer->nofaximili = isset($data->nofaximili) ? urldecode($data->nofaximili) : null;
    $filecustomer->kontakperson = isset($data->kontakperson) ? urldecode($data->kontakperson) : null;
    $filecustomer->namawp = isset($data->namawp) ? urldecode($data->namawp) : null;
    $filecustomer->alamatwp = isset($data->alamatwp) ? urldecode($data->alamatwp) : null;
    $filecustomer->npwp = isset($data->npwp) ? urldecode($data->npwp) : null;
    $filecustomer->tipecustomer = isset($data->tipecustomer) ? urldecode($data->tipecustomer) : null;
    $filecustomer->jenisproteksi = isset($data->jenisproteksi) ? urldecode($data->jenisproteksi) : null;
    $filecustomer->plafonkredit = isset($data->plafonkredit) ? urldecode($data->plafonkredit) : null;
    $filecustomer->jumlahfaktur = isset($data->jumlahfaktur) ? urldecode($data->jumlahfaktur) : null;
    $filecustomer->kodesalesman = isset($data->kodesalesman) ? urldecode($data->kodesalesman) : null;
    $filecustomer->kodepengirim = isset($data->kodepengirim) ? urldecode($data->kodepengirim) : null;
    $filecustomer->kodetermin = isset($data->kodetermin) ? urldecode($data->kodetermin) : null;
    $filecustomer->kodearea = isset($data->kodearea) ? urldecode($data->kodearea) : null;
    $filecustomer->kodeformulir = isset($data->kodeformulir) ? urldecode($data->kodeformulir) : null;
    $filecustomer->kodebank = isset($data->kodebank) ? urldecode($data->kodebank) : null;
    $filecustomer->userid = isset($data->userid) ? urldecode($data->userid) : null;
    $filecustomer->status = isset($data->status) ? urldecode($data->status) : null;
    $filecustomer->cabang = isset($data->cabang) ? urldecode($data->cabang) : null;
    if ($filecustomer->create()) {
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
        $filecustomer->kodecustomer = isset($item->kodecustomer) ? urldecode($item->kodecustomer) : null;
        $filecustomer->delete();

        //insert data
        $filecustomer->kodecustomer = isset($item->kodecustomer) ? urldecode($item->kodecustomer) : null;
        $filecustomer->kodebadanusaha = isset($item->kodebadanusaha) ? urldecode($item->kodebadanusaha) : null;
        $filecustomer->namabadanusaha = isset($item->namabadanusaha) ? urldecode($item->namabadanusaha) : null;
        $filecustomer->namacustomer = isset($item->namacustomer) ? urldecode($item->namacustomer) : null;
        $filecustomer->alamatcustomer = isset($item->alamatcustomer) ? urldecode($item->alamatcustomer) : null;
        $filecustomer->kota = isset($item->kota) ? urldecode($item->kota) : null;
        $filecustomer->notelepon = isset($item->notelepon) ? urldecode($item->notelepon) : null;
        $filecustomer->nofaximili = isset($item->nofaximili) ? urldecode($item->nofaximili) : null;
        $filecustomer->kontakperson = isset($item->kontakperson) ? urldecode($item->kontakperson) : null;
        $filecustomer->namawp = isset($item->namawp) ? urldecode($item->namawp) : null;
        $filecustomer->alamatwp = isset($item->alamatwp) ? urldecode($item->alamatwp) : null;
        $filecustomer->npwp = isset($item->npwp) ? urldecode($item->npwp) : null;
        $filecustomer->tipecustomer = isset($item->tipecustomer) ? urldecode($item->tipecustomer) : null;
        $filecustomer->jenisproteksi = isset($item->jenisproteksi) ? urldecode($item->jenisproteksi) : null;
        $filecustomer->plafonkredit = isset($item->plafonkredit) ? urldecode($item->plafonkredit) : null;
        $filecustomer->jumlahfaktur = isset($item->jumlahfaktur) ? urldecode($item->jumlahfaktur) : null;
        $filecustomer->kodesalesman = isset($item->kodesalesman) ? urldecode($item->kodesalesman) : null;
        $filecustomer->kodepengirim = isset($item->kodepengirim) ? urldecode($item->kodepengirim) : null;
        $filecustomer->kodetermin = isset($item->kodetermin) ? urldecode($item->kodetermin) : null;
        $filecustomer->kodearea = isset($item->kodearea) ? urldecode($item->kodearea) : null;
        $filecustomer->kodeformulir = isset($item->kodeformulir) ? urldecode($item->kodeformulir) : null;
        $filecustomer->kodebank = isset($item->kodebank) ? urldecode($item->kodebank) : null;
        $filecustomer->userid = isset($item->userid) ? urldecode($item->userid) : null;
        $filecustomer->status = isset($item->status) ? urldecode($item->status) : null;
        $filecustomer->cabang = isset($item->cabang) ? urldecode($item->cabang) : null;
        if ($filecustomer->create()) {
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