<?php
$conn = new mysqli("localhost", "root", "", "railsys");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT COUNT(*) AS total_users FROM user");
$stmt->execute();
$stmt->bind_result($total_users);
$stmt->fetch();
$stmt->close();

echo "<h3>Total Train Users</h3>";
echo "<p>Total Users: " . $total_users . "</p>";

$stmt = $conn->prepare("SELECT COUNT(DISTINCT trainNO) AS total_trains FROM trainschedule");
$stmt->execute();
$stmt->bind_result($total_trains);
$stmt->fetch();
$stmt->close();

echo "<h3>Total Trains</h3>";
echo "<p>Total Trains: " . $total_trains . "</p>";
$conn->close();
?>