<?php
session_start();
require_once 'Room.php';

if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
}

$room = new Room();
$rooms = $room->getAllRooms();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            margin-bottom: 30px;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-title {
            margin-bottom: 15px;
        }
        .card-text {
            flex-grow: 1;
        }
        .btn-group {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <a href="user_dashboard.php" class="btn btn-primary">Back</a>
<div class="container">
    <h2 class="text-center">Available Rooms</h2>
    <div class="row">
        <?php while ($row = $rooms->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="image<?php echo $row['photo']; ?>" class="card-img-top" alt="Room Photo">
                    <div class="card-body">
                        <h5 class="card-title">Price: $<?php echo $row['price']; ?></h5>
                        <p class="card-text"><?php echo $row['description']; ?></p>
                        <div class="btn-group">
                            <a href="book_room.php?room_id=<?php echo $row['id']; ?>" class="btn btn-primary">Book</a>
                            <a href="reserve_room.php?room_id=<?php echo $row['id']; ?>" class="btn btn-secondary">Reserve</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
