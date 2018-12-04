<?php class Departments {

	private $conn;
    private $table_name = "departments";
    
    public $dep_id;
    public $dep_name;
    public $dep_status;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    function create() {

        $query = "INSERT INTO " . $this->table_name . " (dep_name) VALUES (:dep_name)";

        $stmt = $this->conn->prepare($query);

        $this->dep_name = htmlspecialchars(strip_tags($this->dep_name));

        $stmt->bindParam(":dep_name", $this->dep_name);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    function read() {
        
        $query = "SELECT a.dep_id, a.dep_name, a.dep_status FROM " . $this->table_name . " a";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

} ?>