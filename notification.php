<?php
include 'auth.php';
checkLogin();

$userId = $_SESSION['userId'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Train Schedule - NexRail</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <div class="brand"><a href="index.php" style="text-decoration: none; color: inherit;">NexRail</div>
        <div class="nav-links">
            <a href="schedule.php">Train Schedule</a>
            <span class="current-page">Notification</span>
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
            <span class="current-page">Notification</span>
            <a href="arrival_depart.php">Arrival/Depart</a>
            <a href="seat_selection.php">Seat Selection</a>
            <a href="customersupport.php">Customer Support</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div>
        <h1>You got 0 notification</h1>
        <!--Add your contents here-->
    </div>
    <div class="footer">
        <p>&copy; 2024 NexRail. All rights reserved.</p>
    </div>
    <script src="javascript/script.js"></script>
</body>
</html>