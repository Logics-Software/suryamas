<?php
class HeaderPenjualan {
  // DB Stuff
  private $conn;
  private $table = 'headerpenjualan';

  // Properties
  public $kodeformulir;
  public $nopenjualan;
  public $tanggalpenjualan;
  public $kodetermin;
  public $tanggaljatuhtempo;
  public $nopo;
  public $keterangan;
  public $kodecustomer;
  public $kodesalesman;
  public $kodepengirim;
  public $dpp;
  public $ppn;
  public $nilaipenjualan;
  public $saldopenjualan;
  public $cnpenjualan;
  public $userid;
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
      kodeformulir = :kodeformulir, nopenjualan = :nopenjualan, tanggalpenjualan = :tanggalpenjualan, kodetermin = :kodetermin,
      tanggaljatuhtempo = :tanggaljatuhtempo, nopo = :nopo, keterangan = :keterangan, kodecustomer = :kodecustomer, 
      kodesalesman = :kodesalesman, kodepengirim = :kodepengirim, dpp = :dpp, ppn = :ppn, nilaipenjualan = :nilaipenjualan, 
      saldopenjualan = :saldopenjualan, cnpenjualan = :cnpenjualan, userid = :userid, status = :status';  

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->kodeformulir = htmlspecialchars(strip_tags($this->kodeformulir));
  $this->nopenjualan = htmlspecialchars(strip_tags($this->nopenjualan));
  $this->tanggalpenjualan = htmlspecialchars(strip_tags($this->tanggalpenjualan));
  $this->kodetermin = htmlspecialchars(strip_tags($this->kodetermin));
  $this->tanggaljatuhtempo = htmlspecialchars(strip_tags($this->tanggaljatuhtempo));
  $this->nopo = htmlspecialchars(strip_tags($this->nopo));
  $this->kodecustomer = htmlspecialchars(strip_tags($this->kodecustomer));
  $this->kodesalesman = htmlspecialchars(strip_tags($this->kodesalesman));
  $this->kodepengirim = htmlspecialchars(strip_tags($this->kodepengirim));
  $this->dpp = htmlspecialchars(strip_tags($this->dpp));
  $this->ppn = htmlspecialchars(strip_tags($this->ppn));
  $this->nilaipenjualan = htmlspecialchars(strip_tags($this->nilaipenjualan));
  $this->saldopenjualan = htmlspecialchars(strip_tags($this->saldopenjualan));
  $this->cnpenjualan = htmlspecialchars(strip_tags($this->cnpenjualan));
  $this->userid = htmlspecialchars(strip_tags($this->userid));
  $this->status = htmlspecialchars(strip_tags($this->status));

  // Bind data
  $stmt->bindParam(':kodeformulir', $this->kodeformulir);
  $stmt->bindParam(':nopenjualan', $this->nopenjualan);
  $stmt->bindParam(':tanggalpenjualan', $this->tanggalpenjualan);
  $stmt->bindParam(':kodetermin', $this->kodetermin);
  $stmt->bindParam(':tanggaljatuhtempo', $this->tanggaljatuhtempo);
  $stmt->bindParam(':nopo', $this->nopo);
  $stmt->bindParam(':keterangan', $this->keterangan);
  $stmt->bindParam(':kodecustomer', $this->kodecustomer);
  $stmt->bindParam(':kodesalesman', $this->kodesalesman);
  $stmt->bindParam(':kodepengirim', $this->kodepengirim);
  $stmt->bindParam(':dpp', $this->dpp);
  $stmt->bindParam(':ppn', $this->ppn);
  $stmt->bindParam(':nilaipenjualan', $this->nilaipenjualan);
  $stmt->bindParam(':saldopenjualan', $this->saldopenjualan);
  $stmt->bindParam(':cnpenjualan', $this->cnpenjualan);
  $stmt->bindParam(':userid', $this->userid);
  $stmt->bindParam(':status', $this->status);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $stmt.\n", $stmt->error);

  return false;
  }

  // Delete Category
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table  . ' WHERE nopenjualan = :nopenjualan';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->nopenjualan = htmlspecialchars(strip_tags($this->nopenjualan));
    
    // Bind data
    $stmt->bindParam(':nopenjualan', $this->nopenjualan);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $stmt.\n", $stmt->error);

    return false;
    }

  // Update Status Barang
  public function updatestatus() {
    // Create query
    $query = 'UPDATE ' . $this->table  . ' SET status = 1 WHERE nopenjualan = :nopenjualan';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->nopenjualan = htmlspecialchars(strip_tags($this->nopenjualan));
    
    // Bind data
    $stmt->bindParam(':nopenjualan', $this->nopenjualan);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %stmt.\n", $stmt->error);

    return false;
    }

  // Update Status Barang
  public function getheaderpenjualan() {
    $query = "SELECT * FROM " . $this->table . " WHERE status = 0 ORDER BY nopenjualan";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    if (empty($data)) {
        return [
            'status' => 404,
            'message' => 'Data Penjualan not found.',
            'data' => null
        ];
    }

    return [
        'status' => 200,
        'message' => 'Get Data Penjualan Successfully.',
        'data' => $data
    ];
  }    
}
