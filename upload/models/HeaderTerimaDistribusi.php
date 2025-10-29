<?php
class HeaderTerimaDistribusi {
  // DB Stuff
  private $conn;
  private $table = 'headerterimadistribusi';

  // Properties
  public $nopenerimaan;
  public $tanggalpenerimaan;
  public $nodistribusi;
  public $keterangan;
  public $kodegudang;
  public $kodekirim;
  public $nilaipenerimaan;
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
      nopenerimaan = :nopenerimaan, tanggalpenerimaan = :tanggalpenerimaan, nodistribusi = :nodistribusi,
      keterangan = :keterangan, kodegudang = :kodegudang, kodekirim = :kodekirim, nilaipenerimaan = :nilaipenerimaan, 
      userid = :userid, status = 0';  

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->nopenerimaan = htmlspecialchars(strip_tags($this->nopenerimaan));
  $this->tanggalpenerimaan = htmlspecialchars(strip_tags($this->tanggalpenerimaan));
  $this->nodistribusi = htmlspecialchars(strip_tags($this->nodistribusi));
  $this->keterangan = htmlspecialchars(strip_tags($this->keterangan));
  $this->kodegudang = htmlspecialchars(strip_tags($this->kodegudang));
  $this->kodekirim = htmlspecialchars(strip_tags($this->kodekirim));
  $this->nilaipenerimaan = htmlspecialchars(strip_tags($this->nilaipenerimaan));
  $this->userid = htmlspecialchars(strip_tags($this->userid));

  // Bind data
  $stmt->bindParam(':nopenerimaan', $this->nopenerimaan);
  $stmt->bindParam(':tanggalpenerimaan', $this->tanggalpenerimaan);
  $stmt->bindParam(':nodistribusi', $this->nodistribusi);
  $stmt->bindParam(':keterangan', $this->keterangan);
  $stmt->bindParam(':kodegudang', $this->kodegudang);
  $stmt->bindParam(':kodekirim', $this->kodekirim);
  $stmt->bindParam(':nilaipenerimaan', $this->nilaipenerimaan);
  $stmt->bindParam(':userid', $this->userid);

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
    printf("Error: $stmt.\n", $stmt->error);

    return false;
    }

  // Update Status Barang
  public function updatestatus() {
    // Create query
    $query = 'UPDATE ' . $this->table  . ' SET status = 1 WHERE nopenerimaan = :nopenerimaan';

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

  // Update Status Barang
  public function getheaderterimadistribusi($kodekirim) {
    $query = "SELECT * FROM " . $this->table;
    $query .= " WHERE status = 0 AND kodekirim = :kodekirim ORDER BY nopenerimaan";

    $stmt = $this->conn->prepare($query);
    
    $stmt->bindParam(':kodekirim', $kodekirim);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    if (empty($data)) {
        return [
            'status' => 404,
            'message' => 'Header Penerimaan Distribusi not found.',
            'data' => null
        ];
    }

    return [
        'status' => 200,
        'message' => 'Get Header Penerimaan Distribusi Successfully.',
        'data' => $data
    ];
  }    
}
