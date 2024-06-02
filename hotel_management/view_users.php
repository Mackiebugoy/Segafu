<?php
session_start();
require_once 'User.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
}

$user = new User();

$message = '';
if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];
    if ($user->removeUser($remove_id)) {
        $message = "User removed successfully.";
    } else {
        $message = "Failed to remove user.";
    }
}

$users = $user->getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
        }
        h2 {
            margin-bottom: 30px;
            text-align: center;
        }
        .table {
            margin-top: 20px;
        }
        thead th {
            background-color: #343a40;
            color: #ffffff;
        }
        tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #e9ecef;
        }
        .alert {
            text-align: center;
        }
        .btn-remove {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="admin_dashboard.php" class="btn btn-primary">Back</a>
    <h2>All Users</h2>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                    <td>
                        <a href="view_users.php?remove_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-remove">Remove</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
