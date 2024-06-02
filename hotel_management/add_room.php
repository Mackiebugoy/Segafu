<?php
session_start();
require_once 'Room.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "image";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $room = new Room();
        $room->photo = basename($_FILES["photo"]["name"]);
        $room->price = $_POST['price'];
        $room->description = $_POST['description'];

        if ($room->addRoom()) {
            echo "Room added successfully!";
        } else {
            echo "Room addition failed!";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <a href="admin_dashboard.php" class="btn btn-primary">Back</a>
    <meta charset="UTF-8">
    <title>Add Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Add Room</h2>
    <form method="post" action="add_room.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" class="form-control" id="photo" name="photo" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Room</button>
    </form>
</div>
</body>
</html>
