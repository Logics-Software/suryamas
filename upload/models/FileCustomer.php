<?php
  class FileCustomer {
    // DB Stuff
    private $conn;
    private $table = 'filecustomer';

    // Properties
    public $kodecustomer;
    public $kodebadanusaha;
    public $namabadanusaha;
    public $namacustomer;
    public $alamatcustomer;
    public $kota;
    public $notelepon;
    public $nofaximili;
    public $kontakperson;
    public $namawp;
    public $alamatwp;
    public $npwp;
    public $tipecustomer;
    public $jenisproteksi;
    public $plafonkredit;
    public $jumlahfaktur;
    public $kodesalesman;
    public $kodepengirim;
    public $kodetermin;
    public $kodearea;
    public $kodeformulir;
    public $kodebank;
    public $userid;
    public $status;
    public $cabang;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . ' SET
      kodecustomer = :kodecustomer, kodebadanusaha = :kodebadanusaha, namabadanusaha = :namabadanusaha, namacustomer = :namacustomer, 
      alamatcustomer = :alamatcustomer, kota = :kota, notelepon = :notelepon, nofaximili = :nofaximili, kontakperson = :kontakperson, 
      namawp = :namawp, alamatwp = :alamatwp, npwp = :npwp, tipecustomer = :tipecustomer, jenisproteksi = :jenisproteksi,
      plafonkredit = :plafonkredit, jumlahfaktur = :jumlahfaktur, kodesalesman = :kodesalesman, kodepengirim = :kodepengirim, 
      kodetermin = :kodetermin, kodearea = :kodearea, kodeformulir = :kodeformulir, kodebank = :kodebank, userid = :userid, 
      status = :status, cabang = :cabang';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data - hanya strip tags untuk keamanan, tanpa htmlspecialchars
  // htmlspecialchars tidak diperlukan karena data disimpan ke database, bukan untuk output HTML
  // PDO prepared statement sudah aman dari SQL injection
  $this->kodecustomer = strip_tags($this->kodecustomer);
  $this->kodebadanusaha = strip_tags($this->kodebadanusaha);
  $this->namabadanusaha = strip_tags($this->namabadanusaha);
  $this->namacustomer = strip_tags($this->namacustomer);
  $this->alamatcustomer = strip_tags($this->alamatcustomer);
  $this->kota = strip_tags($this->kota);
  $this->notelepon = strip_tags($this->notelepon);
  $this->nofaximili = strip_tags($this->nofaximili);
  $this->kontakperson = strip_tags($this->kontakperson);
  $this->namawp = strip_tags($this->namawp);
  $this->alamatwp = strip_tags($this->alamatwp);
  $this->npwp = strip_tags($this->npwp);
  $this->tipecustomer = strip_tags($this->tipecustomer);
  $this->jenisproteksi = strip_tags($this->jenisproteksi);
  $this->plafonkredit = strip_tags($this->plafonkredit);
  $this->jumlahfaktur = strip_tags($this->jumlahfaktur);
  $this->kodesalesman = strip_tags($this->kodesalesman);
  $this->kodepengirim = strip_tags($this->kodepengirim);
  $this->kodetermin = strip_tags($this->kodetermin);
  $this->kodearea = strip_tags($this->kodearea);
  $this->kodeformulir = strip_tags($this->kodeformulir);
  $this->kodebank = strip_tags($this->kodebank);
  $this->userid = strip_tags($this->userid);
  $this->status = strip_tags($this->status);
  $this->cabang = strip_tags($this->cabang);

  // Bind data
  $stmt->bindParam(':kodecustomer', $this->kodecustomer);
  $stmt->bindParam(':kodebadanusaha', $this->kodebadanusaha);
  $stmt->bindParam(':namabadanusaha', $this->namabadanusaha);
  $stmt->bindParam(':namacustomer', $this->namacustomer);
  $stmt->bindParam(':alamatcustomer', $this->alamatcustomer);
  $stmt->bindParam(':kota', $this->kota);
  $stmt->bindParam(':notelepon', $this->notelepon);
  $stmt->bindParam(':nofaximili', $this->nofaximili);
  $stmt->bindParam(':kontakperson', $this->kontakperson);
  $stmt->bindParam(':namawp', $this->namawp);
  $stmt->bindParam(':alamatwp', $this->alamatwp);
  $stmt->bindParam(':npwp', $this->npwp);
  $stmt->bindParam(':tipecustomer', $this->tipecustomer);
  $stmt->bindParam(':jenisproteksi', $this->jenisproteksi);
  $stmt->bindParam(':plafonkredit', $this->plafonkredit);
  $stmt->bindParam(':jumlahfaktur', $this->jumlahfaktur);
  $stmt->bindParam(':kodesalesman', $this->kodesalesman);
  $stmt->bindParam(':kodepengirim', $this->kodepengirim);
  $stmt->bindParam(':kodetermin', $this->kodetermin);
  $stmt->bindParam(':kodearea', $this->kodearea);
  $stmt->bindParam(':kodeformulir', $this->kodeformulir);
  $stmt->bindParam(':kodebank', $this->kodebank);
  $stmt->bindParam(':userid', $this->userid);
  $stmt->bindParam(':status', $this->status);
  $stmt->bindParam(':cabang', $this->cabang);

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
    $query = 'DELETE FROM ' . $this->table  . ' WHERE kodecustomer = :kodecustomer';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->kodecustomer = strip_tags($this->kodecustomer);
    
    // Bind data
    $stmt->bindParam(':kodecustomer', $this->kodecustomer);
    
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
    $query = 'UPDATE ' . $this->table  . ' SET status = 1 WHERE kodecustomer = :kodecustomer';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->kodecustomer = strip_tags($this->kodecustomer);
    
    // Bind data
    $stmt->bindParam(':kodecustomer', $this->kodecustomer);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %stmt.\n", $stmt->error);

    return false;
    }

  // Update Status Barang
  public function getcustomer() {
    $query = "SELECT * FROM " . $this->table . " WHERE status = 0";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    if (empty($data)) {
        return [
            'status' => 404,
            'message' => 'Customer not found.',
            'data' => null
        ];
    }

    return [
        'status' => 200,
        'message' => 'Get Customer Successfully.',
        'data' => $data
    ];
  }
}