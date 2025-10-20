<?php
  class FileSalesman {
    // DB Stuff
    private $conn;
    private $table = 'filesalesman';

    // Properties
    public $kodesalesman;
    public $namasalesman;
    public $alamatsalesman;
    public $notelepon;
    public $kodearea;
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
      kodesalesman = :kodesalesman, namasalesman = :namasalesman, alamatsalesman = :alamatsalesman, notelepon = :notelepon, 
      kodearea = :kodearea, userid = :userid, status = :status';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->kodesalesman = htmlspecialchars(strip_tags($this->kodesalesman));
  $this->namasalesman = htmlspecialchars(strip_tags($this->namasalesman));
  $this->alamatsalesman = htmlspecialchars(strip_tags($this->alamatsalesman));
  $this->notelepon = htmlspecialchars(strip_tags($this->notelepon));
  $this->kodearea = htmlspecialchars(strip_tags($this->kodearea));
  $this->userid = htmlspecialchars(strip_tags($this->userid));
  $this->status = htmlspecialchars(strip_tags($this->status));

  // Bind data
  $stmt->bindParam(':kodesalesman', $this->kodesalesman);
  $stmt->bindParam(':namasalesman', $this->namasalesman);
  $stmt->bindParam(':alamatsalesman', $this->alamatsalesman);
  $stmt->bindParam(':notelepon', $this->notelepon);
  $stmt->bindParam(':kodearea', $this->kodearea);
  $stmt->bindParam(':userid', $this->userid);
  $stmt->bindParam(':status', $this->status);

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
    $query = 'DELETE FROM ' . $this->table  . ' WHERE kodesalesman = :kodesalesman';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->kodesalesman = htmlspecialchars(strip_tags($this->kodesalesman));
    
    // Bind data
    $stmt->bindParam(':kodesalesman', $this->kodesalesman);
    
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
    $query = 'UPDATE ' . $this->table  . ' SET status = 1 WHERE kodesalesman = :kodesalesman';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->kodesalesman = htmlspecialchars(strip_tags($this->kodesalesman));
    
    // Bind data
    $stmt->bindParam(':kodesalesman', $this->kodesalesman);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %stmt.\n", $stmt->error);

    return false;
    }

  // Update Status Barang
  public function getsalesman() {
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
            'message' => 'Salesman not found.',
            'data' => null
        ];
    }

    return [
        'status' => 200,
        'message' => 'Get Salesman Successfully.',
        'data' => $data
    ];
  }
}