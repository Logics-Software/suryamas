<?php
  class TabelPabrik {
    // DB Stuff
    private $conn;
    private $table = 'tabelpabrik';

    // Properties
    public $kodepabrik;
    public $namapabrik;
    public $inisialkodebarang;
    public $status;
    public $kodeif;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . ' SET
      kodepabrik = :kodepabrik, namapabrik = :namapabrik, inisialkodebarang = :inisialkodebarang, 
      status = :status, kodeif = :kodeif';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->kodepabrik = htmlspecialchars(strip_tags($this->kodepabrik));
  $this->namapabrik = htmlspecialchars(strip_tags($this->namapabrik));
  $this->inisialkodebarang = htmlspecialchars(strip_tags($this->inisialkodebarang));
  $this->status = htmlspecialchars(strip_tags($this->status));
  $this->kodeif = htmlspecialchars(strip_tags($this->kodeif));

  // Bind data
  $stmt->bindParam(':kodepabrik', $this->kodepabrik);
  $stmt->bindParam(':namapabrik', $this->namapabrik);
  $stmt->bindParam(':inisialkodebarang', $this->inisialkodebarang);
  $stmt->bindParam(':status', $this->status);
  $stmt->bindParam(':kodeif', $this->kodeif);

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
    $query = 'DELETE FROM ' . $this->table  . ' WHERE kodepabrik = :kodepabrik';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->kodepabrik = htmlspecialchars(strip_tags($this->kodepabrik));
    
    // Bind data
    $stmt->bindParam(':kodepabrik', $this->kodepabrik);
    
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
    $query = 'UPDATE ' . $this->table  . ' SET status = 1 WHERE kodepabrik = :kodepabrik';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->kodepabrik = htmlspecialchars(strip_tags($this->kodepabrik));
    
    // Bind data
    $stmt->bindParam(':kodepabrik', $this->kodepabrik);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %stmt.\n", $stmt->error);

    return false;
    }

  // Update Status Barang
  public function getpabrik() {
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
            'message' => 'Pabrik not found.',
            'data' => null
        ];
    }

    return [
        'status' => 200,
        'message' => 'Get Pabrik Successfully.',
        'data' => $data
    ];
  }
}