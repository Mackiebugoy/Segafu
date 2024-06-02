<?php
require_once 'Database.php';

class Booking {
    private $conn;
    private $table_name = "bookings";

    public $id;
    public $user_id;
    public $room_id;
    public $status;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function bookRoom() {
        $query = "INSERT INTO " . $this->table_name . " (user_id, room_id, status) VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iis", $this->user_id, $this->room_id, $this->status);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getAllBookings($status) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE status = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
