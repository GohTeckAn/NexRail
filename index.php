<?php
// filepath: /c:/xampp/htdocs/railsystemNexRail/seat_selection_next.php
include 'auth.php';
checkLogin();

$userId = $_SESSION['userId']; // Retrieve user ID from session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to NexRail</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <div class="brand"><a href="index.php" style="text-decoration: none; color: inherit;">NexRail</div>
        <div class="nav-links">
            <a href="schedule.php">Train Schedule</a>
            <a href="notification.php">Notification</a>
            <a href="arrival_depart.php">Arrival/Depart</a>
            <a href="seat_selection.php">Seat Selection</a>
            <a href="customersupport.php">Customer Support</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="hamburger" onclick="toggleDropdown()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="dropdown" id="dropdown">
            <a href="schedule.php">Train Schedule</a>
            <a href="notification.php">Notification</a>
            <a href="arrival_depart.php">Arrival/Depart</a>
            <a href="seat_selection.php">Seat Selection</a>
            <a href="customersupport.php">Customer Support</a>
            <a href="logout.php">Logout</a> <!-- Add Logout Button -->
        </div>
    </div>
    <div>
        <h1>Hello World</h1>
        <!--Add your contents here-->
    </div>
    <div class="footer">
        <p>&copy; 2024 NexRail. All rights reserved.</p>
    </div>
    <script src="javascript/script.js"></script>
    <script>
        let userId = <?php echo json_encode($userId); ?>;
        console.log('User ID: ', userId);
    </script>
</body>
</html>