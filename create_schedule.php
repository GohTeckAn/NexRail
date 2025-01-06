<?php
$conn = new mysqli("localhost", "root", "", "railsys");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tripNo = $_POST["tripNo"];
    $trainNo = $_POST["trainNo"];
    $trainName = $_POST["trainName"];
    $stationName = $_POST["stationName"];
    $arrivalTime = $_POST["arrivalTime"];

    $stmt = $conn->prepare("INSERT INTO trainschedule (tripNo, trainNo, trainName, stationName, arrivalTime) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issis", $tripNo, $trainNo, $trainName, $stationName, $arrivalTime);

    if ($stmt->execute()) {
        header("Location: admin_fetch_train_schedule.php?success=Schedule created successfully!");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Train Schedule</title>
</head>
<body>

    <h2>Create New Schedule</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="tripNo">Trip No:</label>
        <input type="text" name="tripNo" required><br><br>

        <label for="trainNo">Train No:</label>
        <input type="text" name="trainNo" required><br><br>

        <label for="trainName">Train Name:</label>
        <input type="text" name="trainName" required><br><br>

        <label for="stationName">Station Name:</label>
        <input type="text" name="stationName" required><br><br>

        <label for="arrivalTime">Arrival Time:</label>
        <input type="time" name="arrivalTime" required><br><br>

        <button type="submit">Create Schedule</button>
    </form>

</body>
</html>