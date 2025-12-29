<?php
class HeaderFakturKembali {
  // DB Stuff
  private $conn;
  private $table = 'headerfakturkembali';

  // Properties
  public $kodeformulir;
  public $nokembali;
  public $tanggalkembali;
  public $kodepengirim;
  public $jumlahfaktur;
  public $jumlahitem;
  public $status;
  public $userid;
  
  // Constructor with DB
  public function __construct($db) {
    $this->conn = $db;
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . ' SET
      kodeformulir = :kodeformulir, nokembali = :nokembali, tanggalkembali = :tanggalkembali, kodepengirim = :kodepengirim,
      jumlahfaktur = :jumlahfaktur, jumlahitem = :jumlahitem, status = :status, userid = :userid';  

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->kodeformulir = htmlspecialchars(strip_tags($this->kodeformulir));
  $this->nokembali = htmlspecialchars(strip_tags($this->nokembali));
  $this->tanggalkembali = htmlspecialchars(strip_tags($this->tanggalkembali));
  $this->kodepengirim = htmlspecialchars(strip_tags($this->kodepengirim));
  $this->jumlahfaktur = htmlspecialchars(strip_tags($this->jumlahfaktur));
  $this->jumlahitem = htmlspecialchars(strip_tags($this->jumlahitem));
  $this->status = htmlspecialchars(strip_tags($this->status));
  $this->userid = htmlspecialchars(strip_tags($this->userid));

  // Bind data
  $stmt->bindParam(':kodeformulir', $this->kodeformulir);
  $stmt->bindParam(':nokembali', $this->nokembali);
  $stmt->bindParam(':tanggalkembali', $this->tanggalkembali);
  $stmt->bindParam(':kodepengirim', $this->kodepengirim);
  $stmt->bindParam(':jumlahfaktur', $this->jumlahfaktur);
  $stmt->bindParam(':jumlahitem', $this->jumlahitem);
  $stmt->bindParam(':status', $this->status);
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
    printf("Error: $stmt.\n", $stmt->error);

    return false;
    }

  // Update Status Barang
  public function updatestatus() {
    // Create query
    $query = 'UPDATE ' . $this->table  . ' SET status = 1 WHERE nokembali = :nokembali';

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
  public function getheaderfakturkembali() {
    $query = "SELECT * FROM " . $this->table;
    $query .= " WHERE status = 0 ORDER BY nokembali";

    $stmt = $this->conn->prepare($query);
    
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    if (empty($data)) {
        return [
            'status' => 404,
            'message' => 'Header Faktur Kembali not found.',
            'data' => null
        ];
    }

    return [
        'status' => 200,
        'message' => 'Get Header Faktur Kembali Successfully.',
        'data' => $data
    ];
  }    
}
