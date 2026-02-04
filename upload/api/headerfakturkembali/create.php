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
        $headerfakturkembali->nokembali = isset($data->nokembali) ? urldecode($data->nokembali) : null;
        $headerfakturkembali->delete();

        //insert data
        $headerfakturkembali->kodeformulir = isset($data->kodeformulir) ? urldecode($data->kodeformulir) : null;
        $headerfakturkembali->nokembali = isset($data->nokembali) ? urldecode($data->nokembali) : null;
        $headerfakturkembali->tanggalkembali = isset($data->tanggalkembali) ? urldecode($data->tanggalkembali) : null;
        $headerfakturkembali->kodepengirim = isset($data->kodepengirim) ? urldecode($data->kodepengirim) : null;
        $headerfakturkembali->jumlahfaktur = isset($data->jumlahfaktur) ? urldecode($data->jumlahfaktur) : null;
        $headerfakturkembali->jumlahitem= isset($data->jumlahitem) ? urldecode($data->jumlahitem) : null;
        $headerfakturkembali->status = isset($data->status) ? urldecode($data->status) : null;
        $headerfakturkembali->userid = isset($data->userid) ? urldecode($data->userid) : null;
        if ($headerfakturkembali->create()) {
            $success++;
        } else {
            $fail++;
        }
    } else {
        foreach ($data as $item) {
            //delete data
            $headerfakturkembali->nokembali = isset($item->nokembali) ? urldecode($item->nokembali) : null;
            $headerfakturkembali->delete();

            //insert data
            $headerfakturkembali->kodeformulir = isset($item->kodeformulir) ? urldecode($item->kodeformulir) : null;
            $headerfakturkembali->nokembali = isset($item->nokembali) ? urldecode($item->nokembali) : null;
            $headerfakturkembali->tanggalkembali = isset($item->tanggalkembali) ? urldecode($item->tanggalkembali) : null;
            $headerfakturkembali->kodepengirim = isset($item->kodepengirim) ? urldecode($item->kodepengirim) : null;
            $headerfakturkembali->jumlahfaktur = isset($item->jumlahfaktur) ? urldecode($item->jumlahfaktur) : null;
            $headerfakturkembali->jumlahitem= isset($item->jumlahitem) ? urldecode($item->jumlahitem) : null;
            $headerfakturkembali->status = isset($item->status) ? urldecode($item->status) : null;
            $headerfakturkembali->userid = isset($item->userid) ? urldecode($item->userid) : null;
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