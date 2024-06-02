<?php
require_once 'Database.php';

class Room {
    private $conn;
    private $table_name = "rooms";

    public $id;
    public $photo;
    public $price;
    public $description;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addRoom() {
        $query = "INSERT INTO " . $this->table_name . " (photo, price, description) VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $this->photo, $this->price, $this->description);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getAllRooms() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
