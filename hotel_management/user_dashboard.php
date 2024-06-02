<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
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
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 30px;
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
    <a href="browse_rooms.php" class="btn btn-primary">Browse Rooms</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>
