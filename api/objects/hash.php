<?php class Churches {

	private $conn;
    private $table_name = "hash";
    
    public $has_id;
    public $usu_id;
    public $has_hash;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    function create() {

        $query = "INSERT INTO " . $this->table_name . " (usu_id, has_hash) VALUES (:usu_id, :has_hash)";

        $stmt = $this->conn->prepare($query);

        $this->usu_id = htmlspecialchars(strip_tags($this->usu_id));
        $this->has_hash = htmlspecialchars(strip_tags($this->has_hash));

        $stmt->bindParam(":usu_id", $this->usu_id);
        $stmt->bindParam(":has_hash", $this->has_hash);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    function read() {
        
        $query = "SELECT a.chu_id, a.chu_name, a.chu_status FROM " . $this->table_name . " a";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

} ?>