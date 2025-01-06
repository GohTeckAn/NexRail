<?php
include 'auth.php';
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
    <div class="container">
        <?php
        $conn = new mysqli("localhost", "root", "", "railsys");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        function fetch_announcements() {
            global $conn; 

            $stmt = $conn->prepare("SELECT * FROM announcements ORDER BY created_at DESC"); 
            $stmt->execute();
            $result = $stmt->get_result();

            return $result;
        }

        $announcements = fetch_announcements();

        echo "<h3>Announcements</h3>";

        if ($announcements->num_rows > 0) {
            echo "<ul>";
            while ($row = $announcements->fetch_assoc()) {
                echo "<li><strong>" . $row["title"] . "</strong><br>" . $row["content"] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No announcements found.</p>";
        }

        $conn->close();
        ?>
    </div>
    <div class="footer">
        <p>&copy; 2024 NexRail. All rights reserved.</p>
    </div>
    <script src="javascript/script.js"></script>
</body>
</html>
