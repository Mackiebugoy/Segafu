<?php
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $user = new User();
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if ($user->login()) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['role'] = $user->role;

        if ($user->role == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
    } else {
        echo "Login failed!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
            max-width: 400px;
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
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="post" action="login.php">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
         <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div>
            <h6><center><a href="register.php">Don't have an account? register</h6></center>
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>
