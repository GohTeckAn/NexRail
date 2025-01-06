<?php
$conn = new mysqli("localhost", "root", "", "railsys");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $scheduleId = $_GET["id"];

    $stmt = $conn->prepare("DELETE FROM trainschedule WHERE scheduleId = ?"); 
    $stmt->bind_param("i", $scheduleId);

    if ($stmt->execute()) {
        header("Location: admin_fetch_train_schedule.php?success=Schedule deleted successfully!");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>