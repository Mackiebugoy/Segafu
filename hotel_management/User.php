<?php
require_once 'Database.php';

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;
    public $role;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function register() {
        $query = "INSERT INTO " . $this->table_name . " (username, password, role) VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $this->username, password_hash($this->password, PASSWORD_BCRYPT), $this->role);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function login() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($this->password, $row['password'])) {
            $this->id = $row['id'];
            $this->role = $row['role'];
            return true;
        }

        return false;
    }

     public function getAllUsers() {
        $query = "SELECT id, username, role FROM " . $this->table_name . " WHERE role != 'admin'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function removeUser($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
