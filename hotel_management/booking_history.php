<?php
session_start();
require_once 'Booking.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
}

$booking = new Booking();
$bookings = $booking->getAllBookings('booked');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="admin_dashboard.php" class="btn btn-primary">Back</a>
<div class="container">
    <h2>Booking History</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Room ID</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $bookings->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['room_id']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>