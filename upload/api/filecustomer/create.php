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
    $filecustomer->kodecustomer = $data->kodecustomer;
    $filecustomer->delete();

    //insert data
    $filecustomer->kodecustomer = $data->kodecustomer;
    $filecustomer->kodebadanusaha = $data->kodebadanusaha;
    $filecustomer->namabadanusaha = $data->namabadanusaha;
    $filecustomer->namacustomer = $data->namacustomer;
    $filecustomer->alamatcustomer = $data->alamatcustomer;
    $filecustomer->kota = $data->kota;
    $filecustomer->notelepon = $data->notelepon;
    $filecustomer->nofaximili = $data->nofaximili;
    $filecustomer->kontakperson = $data->kontakperson;
    $filecustomer->namawp = $data->namawp;
    $filecustomer->alamatwp = $data->alamatwp;
    $filecustomer->npwp = $data->npwp;
    $filecustomer->tipecustomer = $data->tipecustomer;
    $filecustomer->jenisproteksi = $data->jenisproteksi;
    $filecustomer->plafonkredit = $data->plafonkredit;
    $filecustomer->jumlahfaktur = $data->jumlahfaktur;
    $filecustomer->kodesalesman = $data->kodesalesman;
    $filecustomer->kodepengirim = $data->kodepengirim;
    $filecustomer->kodetermin = $data->kodetermin;
    $filecustomer->kodearea = $data->kodearea;
    $filecustomer->kodeformulir = $data->kodeformulir;
    $filecustomer->kodebank = $data->kodebank;
    $filecustomer->userid = $data->userid;
    $filecustomer->status = $data->status;
    $filecustomer->cabang = $data->cabang;
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
        $filecustomer->kodecustomer = $item->kodecustomer;
        $filecustomer->delete();

        //insert data
        $filecustomer->kodecustomer = $item->kodecustomer;
        $filecustomer->kodebadanusaha = $item->kodebadanusaha;
        $filecustomer->namabadanusaha = $item->namabadanusaha;
        $filecustomer->namacustomer = $item->namacustomer;
        $filecustomer->alamatcustomer = $item->alamatcustomer;
        $filecustomer->kota = $item->kota;
        $filecustomer->notelepon = $item->notelepon;
        $filecustomer->nofaximili = $item->nofaximili;
        $filecustomer->kontakperson = $item->kontakperson;
        $filecustomer->namawp = $item->namawp;
        $filecustomer->alamatwp = $item->alamatwp;
        $filecustomer->npwp = $item->npwp;
        $filecustomer->tipecustomer = $item->tipecustomer;
        $filecustomer->jenisproteksi = $item->jenisproteksi;
        $filecustomer->plafonkredit = $item->plafonkredit;
        $filecustomer->jumlahfaktur = $item->jumlahfaktur;
        $filecustomer->kodesalesman = $item->kodesalesman;
        $filecustomer->kodepengirim = $item->kodepengirim;
        $filecustomer->kodetermin = $item->kodetermin;
        $filecustomer->kodearea = $item->kodearea;
        $filecustomer->kodeformulir = $item->kodeformulir;
        $filecustomer->kodebank = $item->kodebank;
        $filecustomer->userid = $item->userid;
        $filecustomer->status = $item->status;
        $filecustomer->cabang = $item->cabang;
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