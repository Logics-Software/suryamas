<?php
  class StokBarang {
    // DB Stuff
    private $conn;
    private $table = 'stokbarang';

    // Properties
    public $kodegudang;
    public $kodebarang;
    public $nopembelian;
    public $nomorbatch;
    public $tanggalperolehan;
    public $expireddate;
    public $hpp;
    public $stokakhir;
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
      kodegudang = :kodegudang, kodebarang = :kodebarang, nopembelian = :nopembelian, nomorbatch = :nomorbatch, 
      tanggalperolehan = :tanggalperolehan, expireddate = :expireddate, hpp = :hpp, stokakhir = :stokakhir, status = :status';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->kodegudang = htmlspecialchars(strip_tags($this->kodegudang));
  $this->kodebarang = htmlspecialchars(strip_tags($this->kodebarang));
  $this->nopembelian = htmlspecialchars(strip_tags($this->nopembelian));
  $this->nomorbatch = htmlspecialchars(strip_tags($this->nomorbatch));
  $this->tanggalperolehan = htmlspecialchars(strip_tags($this->tanggalperolehan));
  $this->expireddate = htmlspecialchars(strip_tags($this->expireddate));
  $this->hpp = htmlspecialchars(strip_tags($this->hpp));
  $this->stokakhir = htmlspecialchars(strip_tags($this->stokakhir));
  $this->status = htmlspecialchars(strip_tags($this->status));

  // Bind data
  $stmt->bindParam(':kodegudang', $this->kodegudang);
  $stmt->bindParam(':kodebarang', $this->kodebarang);
  $stmt->bindParam(':nopembelian', $this->nopembelian);
  $stmt->bindParam(':nomorbatch', $this->nomorbatch);
  $stmt->bindParam(':tanggalperolehan', $this->tanggalperolehan);
  $stmt->bindParam(':expireddate', $this->expireddate);
  $stmt->bindParam(':hpp', $this->hpp);
  $stmt->bindParam(':stokakhir', $this->stokakhir);
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
    $query = 'DELETE FROM ' . $this->table  . 
             ' WHERE kodegudang = :kodegudang && kodebarang = :kodebarang && nopembelian = :nopembelian && nomorbatch = :nomorbatch';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->kodegudang = htmlspecialchars(strip_tags($this->kodegudang));
    $this->kodebarang = htmlspecialchars(strip_tags($this->kodebarang));
    $this->nopembelian = htmlspecialchars(strip_tags($this->nopembelian));
    $this->nomorbatch= htmlspecialchars(strip_tags($this->nomorbatch));
    
    // Bind data
    $stmt->bindParam(':kodegudang', $this->kodegudang);
    $stmt->bindParam(':kodebarang', $this->kodebarang);
    $stmt->bindParam(':nopembelian', $this->nopembelian);
    $stmt->bindParam(':nomorbatch', $this->nomorbatch);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %stmt.\n", $stmt->error);

    return false;
  }

  // Delete Category
  public function resetstok() {
    // Create query
    $query = 'UPDATE FROM ' . $this->table  . ' SET StokAkhir = 0 WHERE kodebarang = :kodebarang';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->kodebarang = htmlspecialchars(strip_tags($this->kodebarang));
    
    // Bind data
    $stmt->bindParam(':kodebarang', $this->kodebarang);
    
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
    $query = 'UPDATE ' . $this->table  . ' SET status = 1 WHERE kodegudang = :kodegudang && kodebarang = :kodebarang && nopembelian = :nopembelian && nomorbatch = :nomorbatch';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->kodegudang = htmlspecialchars(strip_tags($this->kodegudang));
    $this->kodebarang = htmlspecialchars(strip_tags($this->kodebarang));
    $this->nopembelian = htmlspecialchars(strip_tags($this->nopembelian));
    $this->nomorbatch = htmlspecialchars(strip_tags($this->nomorbatch));
    
    // Bind data
    $stmt->bindParam(':kodegudang', $this->kodegudang);
    $stmt->bindParam(':kodebarang', $this->kodebarang);
    $stmt->bindParam(':nopembelian', $this->nopembelian);
    $stmt->bindParam(':nomorbatch', $this->nomorbatch);
    
    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %stmt.\n", $stmt->error);

    return false;
  }

  // get Barang
  public function getstok() {
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
            'message' => 'Barang not found.',
            'data' => null
        ];
    }

    return [
        'status' => 200,
        'message' => 'Get Barang Successfully.',
        'data' => $data
    ];
  }
}