<?php
$conn = new mysqli("localhost", "root", "", "railsys");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function fetch_train_schedules() {
    global $conn; 

    $stmt = $conn->prepare("SELECT * FROM trainschedule");
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

// ... (Other functions: create_schedule, update_schedule, delete_schedule) ...

// Fetch all schedules
$schedules = fetch_train_schedules();

echo "<h3>Train Schedules</h3>";
echo "<a href='create_schedule.php'>Create New Schedule</a><br><br>";
echo "<table border='1'>";
echo "<tr><th>Schedule ID</th><th>Trip No</th><th>Train Name</th><th>Station Name</th><th>Arrival Time</th><th>Actions</th></tr>";

while ($row = $schedules->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["scheduleId"] . "</td>"; 
    echo "<td>" . $row["tripNo"] . "</td>"; 
    echo "<td>" . $row["trainName"] . "</td>"; 
    echo "<td>" . $row["stationName"] . "</td>"; 
    echo "<td>" . $row["arrivalTime"] . "</td>"; 
    echo "<td>";
    echo "<a href='edit_schedule.php?id=" . $row["scheduleId"] . "'>Edit</a> | "; // Use scheduleId for editing/deleting
    echo "<a href='delete_schedule.php?id=" . $row["scheduleId"] . "'>Delete</a>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();
?>