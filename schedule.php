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
    <title>Choose Train Schedule - NexRail</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/schedule.css">
</head>
<body>
    <div class="header">
        <div class="brand"><a href="index.php" style="text-decoration: none; color: inherit;">NexRail</div>
        <div class="nav-links">
            <span class="current-page">Train Schedule</span>
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
            <span class="current-page">Train Schedule</span>
            <a href="notification.php">Notification</a>
            <a href="arrival_depart.php">Arrival/Depart</a>
            <a href="seat_selection.php">Seat Selection</a>
            <a href="customersupport.php">Customer Support</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="title">
            <h1>Train Schedule</h1>
            <p>Plan your journey</p>
        </div>
        <div class="train-box" style="background-image: url('image/komuter.jpg');">
            <h2>KTM Komuter</h2>
            <p>Efficient and affordable for daily commutes. Connecting cities and suburbs seamlessly.</p>
            <button onclick="window.location.href='komuter_schedule.php'">View Schedule</button>
        </div>
        <div class="train-box" style="background-image: url('image/ets.jpg');">
            <h2>Electric Train Service (ETS)</h2>
            <p>Fast, comfortable, and modern. Perfect for long-distance travel across Malaysia.</p>
            <button onclick="window.location.href='ets_schedule.php'">View Schedule</button>
        </div>
        <div class="train-box" style="background-image: url('image/intercity.jpg');">
            <h2>KTM Intercity</h2>
            <p>Scenic long-distance journeys with overnight options. Explore Malaysia at your pace.</p>
            <button onclick="window.location.href='intercity_schedule.php'">View Schedule</button>
        </div>
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