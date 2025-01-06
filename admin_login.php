<?php
session_start();

// If already logged in, redirect to admin main page
if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check hardcoded credentials
    if ($username === "admin" && $password === "123456") {
        // Success - Start session
        $_SESSION['admin_id'] = 1;
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_permission'] = 'admin';
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - NexRail</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            color: #ffffff;
            font-weight: bold;
        }

        .form-group input {
            padding: 10px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #2c2c2c;
            color: #ffffff;
        }

        .login-btn {
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #ff4444;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">NexRail Admin</div>
    </div>

    <div class="login-container">
        <h2 style="color: #ffffff; text-align: center; margin-bottom: 20px;">Admin Login</h2>
        
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form class="login-form" method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2024 NexRail. All rights reserved.</p>
    </div>
</body>
</html>
