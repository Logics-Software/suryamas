<?php
class StatusApi {
    // DB Stuff
    private $conn;
    private $table = 'stokbarang';

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    //Get Status API
    public function getstatusapi() {
        // Cek koneksi database
        if (!$this->conn) {
            return [
                'status' => 500,
                'message' => 'Koneksi database gagal.',
                'data' => null
            ];
        }

        $query = "SELECT * FROM " . $this->table . " LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if (!$stmt->execute()) {
            return [
                'status' => 500,
                'message' => 'Query gagal dijalankan.',
                'data' => null
            ];
        }

        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return [
            'status' => 200,
            'message' => 'Koneksi API berhasil.',
            'data' => $data
        ];
    }
}