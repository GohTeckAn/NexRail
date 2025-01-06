<?php
$conn = new mysqli("localhost", "root", "", "railsys");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $scheduleId = $_GET["id"];

    $stmt = $conn->prepare("SELECT * FROM trainschedule WHERE scheduleId = ?"); 
    $stmt->bind_param("i", $scheduleId);
    $stmt->execute();
    $result = $stmt->get_result();
    $schedule = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scheduleId = $_POST["scheduleId"];
    $tripNo = $_POST["tripNo"];
    $trainNo = $_POST["trainNo"];
    $trainName = $_POST["trainName"];
    $stationName = $_POST["stationName"];
    $arrivalTime = $_POST["arrivalTime"];

    $stmt = $conn->prepare("UPDATE trainschedule SET tripNo=?, trainNo=?, trainName=?, stationName=?, arrivalTime=? WHERE scheduleId=?");
    $stmt->bind_param("issisi", $tripNo, $trainNo, $trainName, $stationName, $arrivalTime, $scheduleId);

    if ($stmt->execute()) {
        header("Location: admin_fetch_train_schedule.php?success=Schedule updated successfully!");
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
    <title>Edit Schedule</title>
</head>
<body>

    <h2>Edit Schedule</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="scheduleId" value="<?php echo $schedule['scheduleId']; ?>">

        <label for="tripNo">Trip No:</label>
        <input type="text" name="tripNo" value="<?php echo $schedule['tripNo']; ?>" required><br><br>

        <label for="trainNo">Train No:</label>
        <input type="text" name="trainNo" value="<?php echo $schedule['trainNo']; ?>" required><br><br>

        <label for="trainName">Train Name:</label>
        <input type="text" name="trainName" value="<?php echo $schedule['trainName']; ?>" required><br><br>

        <label for="stationName">Station Name:</label>
        <input type="text" name="stationName" value="<?php echo $schedule['stationName']; ?>" required><br><br>

        <label for="arrivalTime">Arrival Time:</label>
        <input type="time" name="arrivalTime" value="<?php echo $schedule['arrivalTime']; ?>" required><br><br>

        <button type="submit">Update Schedule</button>
    </form>

</body>
</html>