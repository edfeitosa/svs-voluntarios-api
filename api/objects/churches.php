<?php class Churches {

	private $conn;
    private $table_name = "churches";
    
    public $chu_id;
    public $chu_name;
    public $chu_status;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    function create() {

        $query = "INSERT INTO " . $this->table_name . " (chu_name) VALUES (:chu_name)";

        $stmt = $this->conn->prepare($query);

        $this->chu_name = htmlspecialchars(strip_tags($this->chu_name));

        $stmt->bindParam(":chu_name", $this->chu_name);

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