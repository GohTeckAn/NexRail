<?php
$conn = new mysqli("localhost", "root", "", "railsys");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $stmt = $conn->prepare("INSERT INTO announcements (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?success=Announcement created successfully!");
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
    <title>Create Announcement</title>
</head>
<body>

    <h2>Create New Announcement</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br><br>

        <label for="content">Content:</label>
        <textarea name="content" rows="5" required></textarea><br><br>

        <button type="submit">Create Announcement</button>
    </form>

</body>
</html>