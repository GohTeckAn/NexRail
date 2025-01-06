<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - NexRail</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .dashboard-container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .action-btn {
            padding: 30px 20px;
            background-color: #2c2c2c;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .action-btn:hover {
            background-color: #007bff;
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .action-btn i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            float: right;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        .welcome-section {
            color: #ffffff;
            text-align: center;
            margin-bottom: 40px;
        }

        .welcome-section h1 {
            margin-bottom: 10px;
        }

        .welcome-section p {
            color: #888;
            font-size: 1.1em;
        }
    </style>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="header">
        <div class="brand">NexRail Admin</div>
        <a href="admin_logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="dashboard-container">
        <div class="welcome-section">
            <h1>Welcome to Admin Dashboard</h1>
            <p>Manage your train system settings and view customer complaints</p>
        </div>

        <div class="action-buttons">
            <a href="modifyprice.php" class="action-btn">
                <i class="fas fa-dollar-sign"></i>
                Modify Price
            </a>
            <a href="Notificationpage.php" class="action-btn">
                <i class="fas fa-comments"></i>
                View Complaints
            </a>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 NexRail. All rights reserved.</p>
    </div>
</body>
</html>
