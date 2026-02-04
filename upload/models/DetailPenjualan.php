<?php
class DetailPenjualan {
  // DB Stuff
  private $conn;
  private $table = 'detailpenjualan';

  // Properties
  public $nopenjualan;
  public $kodebarang;
  public $nopembelian;
  public $nomorbatch;
  public $expireddate;
  public $jumlah;
  public $hargajual;
  public $discount1;
  public $discount2;
  public $cn;
  public $totalharga;
  public $nourut;
  
  // Constructor with DB
  public function __construct($db) {
    $this->conn = $db;
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . ' SET
      nopenjualan = :nopenjualan, kodebarang = :kodebarang, nopembelian = :nopembelian, nomorbatch = :nomorbatch, 
      expireddate = :expireddate, jumlah = :jumlah, hargajual = :hargajual, discount1 = :discount1, 
      discount2 = :discount2, cn = :cn, totalharga = :totalharga, nourut = :nourut';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);
  
  // Clean data
  $this->nopenjualan = strip_tags($this->nopenjualan);
  $this->kodebarang = strip_tags($this->kodebarang);
  $this->nopembelian = strip_tags($this->nopembelian);
  $this->nomorbatch = strip_tags($this->nomorbatch);
  $this->expireddate = strip_tags($this->expireddate);
  $this->jumlah = strip_tags($this->jumlah);
  $this->hargajual = strip_tags($this->hargajual);
  $this->discount1 = strip_tags($this->discount1);
  $this->discount2 = strip_tags($this->discount2);
  $this->cn = strip_tags($this->cn);
  $this->totalharga = strip_tags($this->totalharga);
  $this->nourut = strip_tags($this->nourut);

  // Bind data
  $stmt->bindParam(':nopenjualan', $this->nopenjualan);
  $stmt->bindParam(':kodebarang', $this->kodebarang);
  $stmt->bindParam(':nopembelian', $this->nopembelian);
  $stmt->bindParam(':nomorbatch', $this->nomorbatch);
  $stmt->bindParam(':expireddate', $this->expireddate);
  $stmt->bindParam(':jumlah', $this->jumlah);
  $stmt->bindParam(':hargajual', $this->hargajual);
  $stmt->bindParam(':discount1', $this->discount1);
  $stmt->bindParam(':discount2', $this->discount2);
  $stmt->bindParam(':cn', $this->cn);
  $stmt->bindParam(':totalharga', $this->totalharga);
  $stmt->bindParam(':nourut', $this->nourut);
  
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
    $query = 'DELETE FROM ' . $this->table  . ' WHERE nopenjualan = :nopenjualan';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->nopenjualan = strip_tags($this->nopenjualan);
    
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

  // get Barang
  public function getdetailpenjualan($nopenjualan) {
    $query = "SELECT * FROM " . $this->table;
    $query .= " WHERE nopenjualan = :nopenjualan ORDER BY nourut ASC";

    $stmt = $this->conn->prepare($query);
    // $this->nopenjualan = strip_tags($this->nopenjualan));
    $stmt->bindParam(':nopenjualan', $nopenjualan);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    if (empty($data)) {
        return [
            'status' => 404,
            'message' => 'Detail Penjualan not found.',
            'data' => null
        ];
    }

    return [
        'status' => 200,
        'message' => 'Get Detail Penjualan Successfully.',
        'data' => $data
    ];
  }
}