<?php
class DetailFakturKembali {
  // DB Stuff
  private $conn;
  private $table = 'detailfakturkembali';

  // Properties
  public $nokembali;
  public $nopenjualan;
  public $tanggalsp;
  public $sp;
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
      nokembali = :nokembali, nopenjualan = :nopenjualan, tanggalsp = :tanggalsp, sp = :sp, nourut = :nourut';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);
  
  // Clean data
  $this->nokembali = htmlspecialchars(strip_tags($this->nokembali));
  $this->nopenjualan = htmlspecialchars(strip_tags($this->nopenjualan));
  $this->tanggalsp = htmlspecialchars(strip_tags($this->tanggalsp));
  $this->sp = htmlspecialchars(strip_tags($this->sp));
  $this->nourut = htmlspecialchars(strip_tags($this->nourut));

  // Bind data
  $stmt->bindParam(':nokembali', $this->nokembali);
  $stmt->bindParam(':nopenjualan', $this->nopenjualan);
  $stmt->bindParam(':tanggalsp', $this->tanggalsp);
  $stmt->bindParam(':sp', $this->sp);
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
    $query = 'DELETE FROM ' . $this->table  . ' WHERE nokembali = :nokembali';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->nokembali = htmlspecialchars(strip_tags($this->nokembali));
    
    // Bind data
    $stmt->bindParam(':nokembali', $this->nokembali);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %stmt.\n", $stmt->error);

    return false;
  }

    // Update Status Barang
  public function updatesp() {
    // Create query
    $query = 'UPDATE ' . $this->table  . ' SET sp = 1 WHERE nokembali = :nokembali';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->nokembali = htmlspecialchars(strip_tags($this->nokembali));

    // Bind data
    $stmt->bindParam(':nokembali', $this->nokembali);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %stmt.\n", $stmt->error);

    return false;
    }


  // get Barang
  public function getdetailfakturkembali($nokembali) {
    $query = "SELECT * FROM " . $this->table;
    $query .= " WHERE nokembali = :nokembali ORDER BY nourut ASC";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':nokembali', $nokembali);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    if (empty($data)) {
        return [
            'status' => 404,
            'message' => 'Detail Faktur Kembali not found.',
            'data' => null
        ];
    }

    return [
        'status' => 200,
        'message' => 'Get Detail Faktur Kembali Successfully.',
        'data' => $data
    ];
  }
}