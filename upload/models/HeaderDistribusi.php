<?php
class HeaderDistribusi {
  // DB Stuff
  private $conn;
  private $table = 'headerdistribusi';

  // Properties
  public $nodistribusi;
  public $tanggaldistribusi;
  public $keterangan;
  public $kodegudang;
  public $kodeterima;
  public $nilaidistribusi;
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
      nodistribusi = :nodistribusi, tanggaldistribusi = :tanggaldistribusi, keterangan = :keterangan, 
      kodegudang = :kodegudang, kodeterima = :kodeterima, nilaidistribusi = :nilaidistribusi, 
      userid = :userid, status = :status';  

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->nodistribusi = htmlspecialchars(strip_tags($this->nodistribusi));
  $this->tanggaldistribusi = htmlspecialchars(strip_tags($this->tanggaldistribusi));
  $this->keterangan = htmlspecialchars(strip_tags($this->keterangan));
  $this->kodegudang = htmlspecialchars(strip_tags($this->kodegudang));
  $this->kodeterima = htmlspecialchars(strip_tags($this->kodeterima));
  $this->nilaidistribusi = htmlspecialchars(strip_tags($this->nilaidistribusi));
  $this->userid = htmlspecialchars(strip_tags($this->userid));
  $this->status = htmlspecialchars(strip_tags($this->status));

  // Bind data
  $stmt->bindParam(':nodistribusi', $this->nodistribusi);
  $stmt->bindParam(':tanggaldistribusi', $this->tanggaldistribusi);
  $stmt->bindParam(':keterangan', $this->keterangan);
  $stmt->bindParam(':kodegudang', $this->kodegudang);
  $stmt->bindParam(':kodeterima', $this->kodeterima);
  $stmt->bindParam(':nilaidistribusi', $this->nilaidistribusi);
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
    $query = 'DELETE FROM ' . $this->table  . ' WHERE nodistribusi = :nodistribusi';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->nodistribusi = htmlspecialchars(strip_tags($this->nodistribusi));
    
    // Bind data
    $stmt->bindParam(':nodistribusi', $this->nodistribusi);
    
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
    $query = 'UPDATE ' . $this->table  . ' SET status = 1 WHERE nodistribusi = :nodistribusi';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->nodistribusi = htmlspecialchars(strip_tags($this->nodistribusi));
    
    // Bind data
    $stmt->bindParam(':nodistribusi', $this->nodistribusi);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %stmt.\n", $stmt->error);

    return false;
    }

  // Update Status Barang
  public function getheaderdistribusi($kodeterima) {
    $query = "SELECT * FROM " . $this->table;
    $query .= " WHERE status = 0 AND kodegudang = :kodeterima ORDER BY nodistribusi";

    $stmt = $this->conn->prepare($query);
    // $this->nopenjualan = htmlspecialchars(strip_tags($this->nopenjualan));
    $stmt->bindParam(':kodeterima', $kodeterima);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    if (empty($data)) {
        return [
            'status' => 404,
            'message' => 'Header Distribusi not found.',
            'data' => null
        ];
    }

    return [
        'status' => 200,
        'message' => 'Get Header Distribusi Successfully.',
        'data' => $data
    ];
  }    
}