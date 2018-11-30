<?php class Users {
 
    private $conn;
    private $table_name = "users";
 
    public $usu_id;
    public $usu_name;
    public $usu_email;
    public $usu_cel;
    public $usu_level;
 
    public function __construct($db) {
        $this->conn = $db;
    }
    
    function create() {

        $query = "INSERT INTO " . $this->table_name . " (usu_name, usu_email, usu_cel, usu_level) 
            VALUES (:usu_name, :usu_email, :usu_cel, :usu_level)";

        $stmt = $this->conn->prepare($query);

        $this->usu_name = htmlspecialchars(strip_tags($this->usu_name));
        $this->usu_email = htmlspecialchars(strip_tags($this->usu_email));
        $this->usu_cel = htmlspecialchars(strip_tags($this->usu_cel));
        $this->usu_level = htmlspecialchars(strip_tags($this->usu_level));

        $stmt->bindParam(":usu_name", $this->usu_name);
        $stmt->bindParam(":usu_email", $this->usu_email);
        $stmt->bindParam(":usu_cel", $this->usu_cel);
        $stmt->bindParam(":usu_level", $this->usu_level);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    function read() {
        
        $query = "SELECT a.usu_id, a.usu_name, a.usu_email, a.usu_cel, a.usu_level
            FROM " . $this->table_name . " a";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    function getEmail() {
        
        $query = "SELECT a.usu_nome, a.usu_email FROM " . $this->table_name . " a WHERE a.usu_email = :usu_email";
        
        $stmt = $this->conn->prepare($query);
        $this->usu_email = htmlspecialchars(strip_tags($this->usu_email));
        $stmt->bindParam(":usu_email", $this->usu_email);
        $stmt->execute();
        
        return $stmt;
    }
} ?>