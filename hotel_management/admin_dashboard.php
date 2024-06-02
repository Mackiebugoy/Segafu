<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 500px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 30px;
            text-align: center;
        }
        .btn {
            width: 100%;
            margin-bottom: 15px;
        }
        .btn:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<div class="container text-center">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
    <a href="add_room.php" class="btn btn-primary">Add Room</a>
    <a href="booking_history.php" class="btn btn-primary">Booking History</a>
    <a href="reserved_history.php" class="btn btn-primary">Reserved Rooms History</a>
    <a href="view_users.php" class="btn btn-primary">Users</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>
