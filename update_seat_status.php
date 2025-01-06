<?php
// filepath: /c:/xampp/htdocs/railsystemNexRail/update_seat_status.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trainNo = $_POST['trainNo'];
    $seats = json_decode($_POST['seats'], true);
    $userId = $_POST['userId'];

    // Database connection
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "railsys";

    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Update seat status to 'occupied' and set userId
    foreach ($seats as $seat) {
        $updateQuery = "UPDATE seat SET status = 'occupied', userId = ? WHERE trainNo = ? AND seatNumber = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("iis", $userId, $trainNo, $seat);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    echo "Seats updated successfully.";
}
?>