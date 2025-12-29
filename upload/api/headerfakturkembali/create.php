<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/HeaderFakturKembali.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $headerfakturkembali = new HeaderFakturKembali($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $success = 0;
    $fail = 0;
    if (!is_array($data)) {
        //delete data
        $headerfakturkembali->nokembali = $data->nokembali;
        $headerfakturkembali->delete();

        //insert data
        $headerfakturkembali->kodeformulir = $data->kodeformulir;
        $headerfakturkembali->nokembali = $data->nokembali;
        $headerfakturkembali->tanggalkembali = $data->tanggalkembali;
        $headerfakturkembali->kodepengirim = $data->kodepengirim;
        $headerfakturkembali->jumlahfaktur = $data->jumlahfaktur;
        $headerfakturkembali->jumlahitem= $data->jumlahitem;
        $headerfakturkembali->status = $data->status;
        $headerfakturkembali->userid = $data->userid;
        if ($headerfakturkembali->create()) {
            $success++;
        } else {
            $fail++;
        }
    } else {
        foreach ($data as $item) {
            //delete data
            $headerfakturkembali->nokembali = $item->nokembali;
            $headerfakturkembali->delete();

            //insert data
            $headerfakturkembali->kodeformulir = $item->kodeformulir;
            $headerfakturkembali->nokembali = $item->nokembali;
            $headerfakturkembali->tanggalkembali = $item->tanggalkembali;
            $headerfakturkembali->kodepengirim = $item->kodepengirim;
            $headerfakturkembali->jumlahfaktur = $item->jumlahfaktur;
            $headerfakturkembali->jumlahitem= $item->jumlahitem;
            $headerfakturkembali->status = $item->status;
            $headerfakturkembali->userid = $item->userid;
            if ($headerfakturkembali->create()) {
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