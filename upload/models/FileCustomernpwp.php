<?php
  class FileCustomerNpwp {
    // DB Stuff
    private $conn;
    private $table = 'filecustomernpwp';

    // Properties
    public $kodecustomer;
    public $npwp;
    public $jeniswp;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . ' SET
      kodecustomer = :kodecustomer, npwp = :npwp, jeniswp = :jeniswp';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->kodecustomer = strip_tags($this->kodecustomer);
  $this->npwp = strip_tags($this->npwp);
  $this->jeniswp = strip_tags($this->jeniswp);

  // Bind data
  $stmt->bindParam(':kodecustomer', $this->kodecustomer);
  $stmt->bindParam(':npwp', $this->npwp);
  $stmt->bindParam(':jeniswp', $this->jeniswp);

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
  public function getcustomer($kodecustomer) {
    $query = "SELECT * FROM " . $this->table . " WHERE kodecustomer = :kodecustomer";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':kodecustomer', $kodecustomer);
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