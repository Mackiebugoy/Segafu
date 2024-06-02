<?php
session_start();
require_once 'Booking.php';

if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
}

if (isset($_GET['room_id'])) {
    $booking = new Booking();
    $booking->user_id = $_SESSION['user_id'];
    $booking->room_id = $_GET['room_id'];
    $booking->status = 'booked';

    if ($booking->bookRoom()) {
        echo "Room booked successfully!";
    } else {
        echo "Room booking failed!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Book Room</h2>
    <a href="browse_rooms.php" class="btn btn-primary">Back to Rooms</a>
</div>
</body>
</html>
