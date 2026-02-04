<?php
  class FileBarang {
    // DB Stuff
    private $conn;
    private $table = 'filebarang';

    // Properties
    public $kodebarang;
    public $namabarang;
    public $satuan;
    public $kodepabrik;
    public $kodekemasan;
    public $kodelokasi;
    public $kodekelasterapi;
    public $kodegolongan;
    public $kodesupplier;
    public $farmalkes_id;
    public $kodebko;
    public $barcode;
    public $hpp;
    public $hargar;
    public $discr1;
    public $discr2;
    public $hargaw1;
    public $disc1w1;
    public $disc2w1;
    public $hargaw2;
    public $disc1w2;
    public $disc2w2;
    public $kondisir;
    public $kondisiw1;
    public $kondisiw2;
    public $jumlahr;
    public $jumlahw1;
    public $jumlahw2;
    public $status;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . ' SET
      kodebarang = :kodebarang, namabarang = :namabarang, satuan = :satuan, kodepabrik = :kodepabrik, kodekemasan = :kodekemasan, 
      kodelokasi = :kodelokasi, kodekelasterapi = :kodekelasterapi, kodegolongan = :kodegolongan, kodesupplier = :kodesupplier, 
      farmalkes_id = :farmalkes_id, kodebko = :kodebko, barcode = :barcode, hpp = :hpp, hargar = :hargar, discr1 = :discr1, 
      discr2 = :discr2, hargaw1 = :hargaw1, disc1w1 = :disc1w1, disc2w1 = :disc2w1, hargaw2 = :hargaw2, disc1w2 = :disc1w2, 
      disc2w2 = :disc2w2, kondisir = :kondisir, kondisiw1 = :kondisiw1, kondisiw2 = :kondisiw2, jumlahr = :jumlahr, 
      jumlahw1 = :jumlahw1, jumlahw2 = :jumlahw2, status = :status';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data - hanya strip tags untuk keamanan, tanpa htmlspecialchars
  // htmlspecialchars tidak diperlukan karena data disimpan ke database, bukan untuk output HTML
  // PDO prepared statement sudah aman dari SQL injection
  $this->kodebarang = strip_tags($this->kodebarang);
  $this->namabarang = strip_tags($this->namabarang);
  $this->satuan = strip_tags($this->satuan);
  $this->kodepabrik = strip_tags($this->kodepabrik);
  $this->kodekemasan = strip_tags($this->kodekemasan);
  $this->kodegolongan = strip_tags($this->kodegolongan);
  $this->kodelokasi = strip_tags($this->kodelokasi);
  $this->kodekelasterapi = strip_tags($this->kodekelasterapi);
  $this->kodesupplier = strip_tags($this->kodesupplier);
  $this->farmalkes_id = strip_tags($this->farmalkes_id);
  $this->kodebko = strip_tags($this->kodebko);
  $this->barcode = strip_tags($this->barcode);
  $this->hpp = strip_tags($this->hpp);
  $this->hargar = strip_tags($this->hargar);
  $this->discr1 = strip_tags($this->discr1);
  $this->discr2 = strip_tags($this->discr2);
  $this->hargaw1 = strip_tags($this->hargaw1);
  $this->disc1w1 = strip_tags($this->disc1w1);
  $this->disc2w1 = strip_tags($this->disc2w1);
  $this->hargaw2 = strip_tags($this->hargaw2);
  $this->disc1w2 = strip_tags($this->disc1w2);
  $this->disc2w2 = strip_tags($this->disc2w2);
  $this->kondisir = strip_tags($this->kondisir);
  $this->kondisiw1 = strip_tags($this->kondisiw1);
  $this->kondisiw2 = strip_tags($this->kondisiw2);
  $this->jumlahr = strip_tags($this->jumlahr);
  $this->jumlahw1 = strip_tags($this->jumlahw1);
  $this->jumlahw2 = strip_tags($this->jumlahw2);
  $this->status = strip_tags($this->status);

  // Bind data
  $stmt->bindParam(':kodebarang', $this->kodebarang);
  $stmt->bindParam(':namabarang', $this->namabarang);
  $stmt->bindParam(':satuan', $this->satuan);
  $stmt->bindParam(':kodepabrik', $this->kodepabrik);
  $stmt->bindParam(':kodekemasan', $this->kodekemasan);
  $stmt->bindParam(':kodegolongan', $this->kodegolongan);
  $stmt->bindParam(':kodelokasi', $this->kodelokasi);
  $stmt->bindParam(':kodekelasterapi', $this->kodekelasterapi);
  $stmt->bindParam(':kodesupplier', $this->kodesupplier);
  $stmt->bindParam(':farmalkes_id', $this->farmalkes_id);
  $stmt->bindParam(':kodebko', $this->kodebko);
  $stmt->bindParam(':barcode', $this->barcode);
  $stmt->bindParam(':hpp', $this->hpp);
  $stmt->bindParam(':hargar', $this->hargar);
  $stmt->bindParam(':discr1', $this->discr1);
  $stmt->bindParam(':discr2', $this->discr2);
  $stmt->bindParam(':hargaw1', $this->hargaw1);
  $stmt->bindParam(':disc1w1', $this->disc1w1);
  $stmt->bindParam(':disc2w1', $this->disc2w1);
  $stmt->bindParam(':hargaw2', $this->hargaw2);
  $stmt->bindParam(':disc1w2', $this->disc1w2);
  $stmt->bindParam(':disc2w2', $this->disc2w2);
  $stmt->bindParam(':kondisir', $this->kondisir);
  $stmt->bindParam(':kondisiw1', $this->kondisiw1);
  $stmt->bindParam(':kondisiw2', $this->kondisiw2);
  $stmt->bindParam(':jumlahr', $this->jumlahr);
  $stmt->bindParam(':jumlahw1', $this->jumlahw1);
  $stmt->bindParam(':jumlahw2', $this->jumlahw2);
  $stmt->bindParam(':status', $this->status);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: %stmt.\n", $stmt->error);

  return false;
  }

  // Delete Category
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table  . ' WHERE kodebarang = :kodebarang';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->kodebarang = strip_tags($this->kodebarang);
    
    // Bind data
    $stmt->bindParam(':kodebarang', $this->kodebarang);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %stmt.\n", $stmt->error);

    return false;
  }

  // Update Status Barang
  public function updatestatus() {
    // Create query
    $query = 'UPDATE ' . $this->table  . ' SET status = 1 WHERE kodebarang = :kodebarang';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->kodebarang = strip_tags($this->kodebarang);
    
    // Bind data
    $stmt->bindParam(':kodebarang', $this->kodebarang);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %stmt.\n", $stmt->error);

    return false;
  }

  // get Barang
  public function getbarang() {
    $query = "SELECT * FROM " . $this->table . " WHERE status = 0 LIMIT 100";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    if (empty($data)) {
        return [
            'status' => 404,
            'message' => 'Barang not found.',
            'data' => null
        ];
    }

    return [
        'status' => 200,
        'message' => 'Get Barang Successfully.',
        'data' => $data
    ];
  }
}