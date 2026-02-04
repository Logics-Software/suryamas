<?php
  class FileCustomerApoteker {
    // DB Stuff
    private $conn;
    private $table = 'filecustomerapoteker';

    // Properties
    public $kodecustomer;
    public $namaapoteker;
    public $alamatapoteker;
    public $noijin;
    public $tanggaled;
    public $noijinusaha;
    public $tgledijinusaha;
    public $nocdob;
    public $tanggalcdob;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . ' SET
      kodecustomer = :kodecustomer, namaapoteker = :namaapoteker, alamatapoteker = :alamatapoteker, noijin = :noijin, 
      tanggaled = :tanggaled, noijinusaha = :noijinusaha, tgledijinusaha = :tgledijinusaha, nocdob = :nocdob, tanggalcdob = :tanggalcdob';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->kodecustomer = strip_tags($this->kodecustomer);
  $this->namaapoteker = strip_tags($this->namaapoteker);
  $this->alamatapoteker = strip_tags($this->alamatapoteker);
  $this->noijin = strip_tags($this->noijin);
  $this->tanggaled = strip_tags($this->tanggaled);
  $this->noijinusaha = strip_tags($this->noijinusaha);
  $this->tgledijinusaha = strip_tags($this->tgledijinusaha);
  $this->nocdob = strip_tags($this->nocdob);
  $this->tanggalcdob = strip_tags($this->tanggalcdob);

  // Bind data
  $stmt->bindParam(':kodecustomer', $this->kodecustomer);
  $stmt->bindParam(':namaapoteker', $this->namaapoteker);
  $stmt->bindParam(':alamatapoteker', $this->alamatapoteker);
  $stmt->bindParam(':noijin', $this->noijin);
  $stmt->bindParam(':tanggaled', $this->tanggaled);
  $stmt->bindParam(':noijinusaha', $this->noijinusaha);
  $stmt->bindParam(':tgledijinusaha', $this->tgledijinusaha);
  $stmt->bindParam(':nocdob', $this->nocdob);
  $stmt->bindParam(':tanggalcdob', $this->tanggalcdob);

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