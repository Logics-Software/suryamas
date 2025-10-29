<?php
class DetailTerimaDistribusi {
  // DB Stuff
  private $conn;
  private $table = 'detailterimadistribusi';

  // Properties
  public $nopenerimaan;
  public $kodebarang;
  public $nopembelian;
  public $nomorbatch;
  public $expireddate;
  public $jumlah;
  public $hpp;
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
      nopenerimaan = :nopenerimaan, kodebarang = :kodebarang, nopembelian = :nopembelian, nomorbatch = :nomorbatch, 
      expireddate = :expireddate, jumlah = :jumlah, hpp = :hpp, totalharga = :totalharga, nourut = :nourut';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);
  
  // Clean data
  $this->nopenerimaan = htmlspecialchars(strip_tags($this->nopenerimaan));
  $this->kodebarang = htmlspecialchars(strip_tags($this->kodebarang));
  $this->nopembelian = htmlspecialchars(strip_tags($this->nopembelian));
  $this->nomorbatch = htmlspecialchars(strip_tags($this->nomorbatch));
  $this->expireddate = htmlspecialchars(strip_tags($this->expireddate));
  $this->jumlah = htmlspecialchars(strip_tags($this->jumlah));
  $this->hpp = htmlspecialchars(strip_tags($this->hpp));
  $this->totalharga = htmlspecialchars(strip_tags($this->totalharga));
  $this->nourut = htmlspecialchars(strip_tags($this->nourut));

  // Bind data
  $stmt->bindParam(':nopenerimaan', $this->nopenerimaan);
  $stmt->bindParam(':kodebarang', $this->kodebarang);
  $stmt->bindParam(':nopembelian', $this->nopembelian);
  $stmt->bindParam(':nomorbatch', $this->nomorbatch);
  $stmt->bindParam(':expireddate', $this->expireddate);
  $stmt->bindParam(':jumlah', $this->jumlah);
  $stmt->bindParam(':hpp', $this->hpp);
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
    $query = 'DELETE FROM ' . $this->table  . ' WHERE nopenerimaan = :nopenerimaan';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->nopenerimaan = htmlspecialchars(strip_tags($this->nopenerimaan));
    
    // Bind data
    $stmt->bindParam(':nopenerimaan', $this->nopenerimaan);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %stmt.\n", $stmt->error);

    return false;
  }

  // get Barang
  public function getdetaildetaildistribusi($nopenerimaan) {
    $query = "SELECT * FROM " . $this->table;
    $query .= " WHERE nopenerimaan = :nopenerimaan ORDER BY nourut ASC";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':nopenerimaan', $nopenerimaan);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    if (empty($data)) {
        return [
            'status' => 404,
            'message' => 'Detail Penerimaan Distribusi not found.',
            'data' => null
        ];
    }

    return [
        'status' => 200,
        'message' => 'Get Detail Penerimaan Distribusi Successfully.',
        'data' => $data
    ];
  }
}