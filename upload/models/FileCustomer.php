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

  // Clean data
  $this->kodecustomer = htmlspecialchars(strip_tags($this->kodecustomer));
  $this->kodebadanusaha = htmlspecialchars(strip_tags($this->kodebadanusaha));
  $this->namabadanusaha = htmlspecialchars(strip_tags($this->namabadanusaha));
  $this->namacustomer = htmlspecialchars(strip_tags($this->namacustomer));
  $this->alamatcustomer = htmlspecialchars(strip_tags($this->alamatcustomer));
  $this->kota = htmlspecialchars(strip_tags($this->kota));
  $this->notelepon = htmlspecialchars(strip_tags($this->notelepon));
  $this->nofaximili = htmlspecialchars(strip_tags($this->nofaximili));
  $this->kontakperson = htmlspecialchars(strip_tags($this->kontakperson));
  $this->namawp = htmlspecialchars(strip_tags($this->namawp));
  $this->alamatwp = htmlspecialchars(strip_tags($this->alamatwp));
  $this->npwp = htmlspecialchars(strip_tags($this->npwp));
  $this->tipecustomer = htmlspecialchars(strip_tags($this->tipecustomer));
  $this->jenisproteksi = htmlspecialchars(strip_tags($this->jenisproteksi));
  $this->plafonkredit = htmlspecialchars(strip_tags($this->plafonkredit));
  $this->jumlahfaktur = htmlspecialchars(strip_tags($this->jumlahfaktur));
  $this->kodesalesman = htmlspecialchars(strip_tags($this->kodesalesman));
  $this->kodepengirim = htmlspecialchars(strip_tags($this->kodepengirim));
  $this->kodetermin = htmlspecialchars(strip_tags($this->kodetermin));
  $this->kodearea = htmlspecialchars(strip_tags($this->kodearea));
  $this->kodeformulir = htmlspecialchars(strip_tags($this->kodeformulir));
  $this->kodebank = htmlspecialchars(strip_tags($this->kodebank));
  $this->userid = htmlspecialchars(strip_tags($this->userid));
  $this->status = htmlspecialchars(strip_tags($this->status));
  $this->cabang = htmlspecialchars(strip_tags($this->cabang));

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
    $this->kodecustomer = htmlspecialchars(strip_tags($this->kodecustomer));
    
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
    $this->kodecustomer = htmlspecialchars(strip_tags($this->kodecustomer));
    
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